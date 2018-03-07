<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\ThrottlesLogins;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\UserRepository;
use App\Jobs\SendMail;

use App\ActivationService;

use App\Models\Invest;
use App\Models\Borrow;
use App\Models\IPAdmin;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $activationService;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        //$this->middleware($this->guestMiddleware(), ['except' => 'logout']);
        $this->activationService = $activationService;
    }


    /**
     * Handle a login request to the application.
     *
     * @param  App\Http\Requests\LoginRequest  $request
     * @param  Guard  $auth
     * @return Response
     */
    public function postLogin(
        LoginRequest $request,
        Guard $auth)
    {

        $logValue = $request->input('log');

        $logAccess = filter_var($logValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $throttles = in_array(
            ThrottlesLogins::class, class_uses_recursive(get_class($this))
        );

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return redirect('/auth/login')
                ->with('error', trans('front/login.maxattempt'))
                ->withInput($request->only('log'));
        }

        $credentials = [
            $logAccess  => $logValue,
            'password'  => $request->input('password')
        ];

        if(!$auth->validate($credentials)) {
            if ($throttles) {
                $this->incrementLoginAttempts($request);
            }

            return redirect('/auth/login')
                ->with('error', trans('front/login.credentials'))
                ->withInput($request->only('log'));
        }

        

        $user = $auth->getLastAttempted();

        $request->session()->put('user_id', $user->id);

        if($user->activated) {
            if ($throttles) {
                $this->clearLoginAttempts($request);
            }

            $auth->login($user, $request->has('memory'));

            if($request->session()->has('user_id'))	{
                $request->session()->forget('user_id');
            }

            // check if exist session invest => create new invest for uid
            if ($user->usertype == '2') {
                // nha dau tu
                if($request->session()->has('invest'))
                {
                    $dataInvest = $request->session()->get('invest.data');
                    $invest = new Invest();
                    $invest->uid = $user->id;
                    $invest->borrowId = $dataInvest['borrowId'];
                    $invest->status = $dataInvest['status'];
                    $invest->save();

                    // remove session
                    $request->session()->forget('invest');

                    return redirect('/')->with('ok', 'Your invest was created');
                }
            }

            // check if exist session borrow => create new borrow for uid
            if ($user->usertype == '3') {
                // nha dau tu
                if($request->session()->has('borrow'))
                {
                    $dataBorrow = $request->session()->get('borrow.data');

                    $checkMax = Borrow::where('status', '<>', 4)->where('uid', $user->id)->get();
                    $getMaxConstans = DB::table('settings')->where('name', 'dataLogo')->select('content')->get()[0];
                    if (count($checkMax) > $getMaxConstans->content) {
                        return redirect('/')->with('ok', 'Bạn vượt quá số lượng khoản vay cho phép');
                    }

                    $post = new Borrow();
                    $post->uid = $user->id;
                    $post->soluongthechap = $dataBorrow['soluongthechap'];
                    $post->kieuthechap = $dataBorrow['kieuthechap'];
                    $post->thoigianthechap = $dataBorrow['thoigianthechap'];
                    $post->phantramlai = $dataBorrow['phantramlai'];
                    $post->sotientoida = $dataBorrow['sotientoida'];
                    $post->dutinhlai = $dataBorrow['dutinhlai'];
                    $post->sotiencanvay = $dataBorrow['sotiencanvay'];
                    $post->ngaygiaingan = $dataBorrow['ngaygiaingan'];
                    $post->ngaydaohan = $dataBorrow['ngaydaohan'];
                    $post->status = $dataBorrow['status'];
                    $post->save();

                    // remove session
                    $request->session()->forget('borrow');

                    return redirect('/')->with('ok', 'Your borrow was created');
                }
            }


            return redirect('/');
        }
        return redirect('/auth/login')->with('error', trans('front/verify.again'));
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  App\Http\Requests\RegisterRequest  $request
     * @param  App\Repositories\UserRepository $user_gestion
     * @return Response
     */
    public function postRegister(
        RegisterRequest $request,
        UserRepository $user_gestion)
    {
        /*
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        */
        $user = $user_gestion->store($request->all());

        $this->activationService->sendActivationMail($user);

        return redirect('/')->with('status', 'We sent you an activation code. Check your email.');
        /*

        $user = $user_gestion->store(
            $request->all(),
            $confirmation_code = str_random(30)
        );

        $this->dispatch(new SendMail($user));

        return redirect('/')->with('ok', trans('front/verify.message'));

        */
    }

    /**
     * Handle a confirmation request.
     *
     * @param  App\Repositories\UserRepository $user_gestion
     * @param  string  $confirmation_code
     * @return Response
     */
    public function getConfirm(
        UserRepository $user_gestion,
        $confirmation_code)
    {
        $user = $user_gestion->confirm($confirmation_code);

        return redirect('/')->with('ok', trans('front/verify.success'));
    }

    /**
     * Handle a resend request.
     *
     * @param  App\Repositories\UserRepository $user_gestion
     * @param  Illuminate\Http\Request $request
     * @return Response
     */
    public function getResend(
        UserRepository $user_gestion,
        Request $request)
    {
        if($request->session()->has('user_id'))	{
            $user = $user_gestion->getById($request->session()->get('user_id'));

            $this->dispatch(new SendMail($user));

            return redirect('/')->with('ok', trans('front/verify.resend'));
        }

        return redirect('/');
    }


    public function authenticated(Request $request, $user)
    {
        if (!$user->activated) {
            $this->activationService->sendActivationMail($user);
            auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return redirect()->intended($this->redirectPath());
    }

    public function activateUser($token)
    {
        if ($user = $this->activationService->activateUser($token)) {
            auth()->login($user);
            return redirect('/')->with('ok', 'Your account activated');
        }
        abort(404);
    }

    public function getAdmin()
    {
        return view('back.login');
    }

    public function postAdmin(
        LoginRequest $request,
        Guard $auth)
    {

        $logValue = $request->input('log');

        $ipPost = $request->input('ipaddress');

        $ipadmin = IPAdmin::all();
        $iparr = [];
        if (count ($ipadmin)) {
            foreach ($ipadmin as $ip) {
                $iparr[] = $ip['ip'];
            }
        }
        // if (!in_array($ipPost, $iparr)) {
        //     return redirect('/administrator')
        //         ->with('error', 'Your IP address not right');
        // }

        $logAccess = filter_var($logValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $throttles = in_array(
            ThrottlesLogins::class, class_uses_recursive(get_class($this))
        );

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return redirect('/administrator')
                ->with('error', trans('front/login.maxattempt'))
                ->withInput($request->only('log'));
        }

        $credentials = [
            $logAccess  => $logValue,
            'password'  => $request->input('password')
        ];

        if(!$auth->validate($credentials)) {
            if ($throttles) {
                $this->incrementLoginAttempts($request);
            }

            return redirect('/administrator')
                ->with('error', trans('front/login.credentials'))
                ->withInput($request->only('log'));
        }

        $user = $auth->getLastAttempted();

        if ($user->usertype != '0') {
            return redirect('/administrator')
                ->with('error', 'Wrong information login');
        }

        $request->session()->put('user_id', $user->id);

        if($user->confirmed) {
            if ($throttles) {
                $this->clearLoginAttempts($request);
            }

            $auth->login($user, $request->has('memory'));

            if($request->session()->has('user_id'))	{
                $request->session()->forget('user_id');
            }
            return redirect('/admin');
        }
        return redirect('/administrator')->with('error', trans('front/verify.again'));
    }

}
