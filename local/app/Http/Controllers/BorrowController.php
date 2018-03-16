<?php namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\BorrowRepository;
use App\Repositories\UserRepository;
use Carbon;
use App\Models\User;
use App\Models\Invest;
use Auth;
use App\Models\Checkout;
use DB;

class BorrowController extends Controller {

	/**
	 * The BorrowRepository instance.
	 *
	 * @var App\Repositories\BorrowRepository
	 */
	protected $borrow_gestion;

	/**
	 * The UserRepository instance.
	 *
	 * @var App\Repositories\UserRepository
	 */
	protected $user_gestion;

	/**
	 * The pagination number.
	 *
	 * @var int
	 */
	protected $nbrPages;

	/**
	 * Create a new BorrowController instance.
	 *
	 * @param  App\Repositories\BorrowRepository $borrow_gestion
	 * @param  App\Repositories\UserRepository $user_gestion
	 * @return void
	*/
	public function __construct(
		BorrowRepository $borrow_gestion)
	{
		$this->borrow_gestion = $borrow_gestion;
		$this->nbrPages = 10;
	}	

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexFront()
	{
		$posts = $this->borrow_gestion->indexFront($this->nbrPages);
		$links = $posts->render();

		return view('front.borrow.index', compact('posts', 'links'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Redirection
	 */
	public function index()
	{
		return redirect(route('borrow.order', [
			'name' => 'borrow.created_at',
			'sens' => 'asc'
		]));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param  Illuminate\Http\Request $request
	 * @return Response
	 */
	public function indexOrder(Request $request)
	{
		$posts = $this->borrow_gestion->index(
			10, 
			$request->name,
			$request->sens
		);
		
		$links = $posts->appends([
				'name' => $request->name, 
				'sens' => $request->sens
			]);


		$links->setPath('')->render();

		$order = (object)[
			'name' => $request->name, 
			'sens' => 'sort-' . $request->sens			
		];

		return view('back.borrow.index', compact('posts', 'links', 'order'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$url = config('medias.url');
		
		return view('back.borrow.create')->with(compact('url'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  App\Http\Requests\PostRequest $request
	 * @return Response
	 */
	public function store(PostRequest $request)
	{
		$this->borrow_gestion->store($request->all(), $request->user()->id);

		return redirect('borrow')->with('ok', trans('back/borrow.stored'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Illuminate\Contracts\Auth\Guard $auth	 
	 * @param  string $slug
	 * @return Response
	 */
	public function show(
		$slug)
	{
		return view('back.borrow.show',  array_merge($this->borrow_gestion->show($slug)));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  App\Repositories\UserRepository $user_gestion
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(
		UserRepository $user_gestion, 
		$id)
	{
		$post = $this->borrow_gestion->getByIdWithTags($id);

		$this->authorize('change', $post);

		$url = config('medias.url');

		return view('back.borrow.edit',  array_merge($this->borrow_gestion->edit($post), compact('url')));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  App\Http\Requests\PostUpdateRequest $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update(
		PostRequest $request,
		$id)
	{
		$post = $this->borrow_gestion->getById($id);

		$this->authorize('change', $post);

		$this->borrow_gestion->update($request->all(), $post);

		return redirect('borrow')->with('ok', trans('back/borrow.updated'));		
	}

	/**
	 * Update "vu" for the specified resource in storage.
	 *
	 * @param  Illuminate\Http\Request $request
	 * @param  int  $id
	 * @return Response
	 */
	public function updateSeen(
		Request $request, 
		$id)
	{
		$this->borrow_gestion->updateSeen($request->all(), $id);

		return response()->json();
	}

	/**
	 * Update "active" for the specified resource in storage.
	 *
	 * @param  Illuminate\Http\Request $request
	 * @param  int  $id
	 * @return Response
	 */
	public function updateActive(
		Request $request, 
		$id)
	{
		$post = $this->borrow_gestion->getById($id);

		$this->authorize('change', $post);
		
		$this->borrow_gestion->updateActive($request->all(), $id);

		return response()->json();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$post = $this->borrow_gestion->getById($id);

		$this->borrow_gestion->destroy($post);

		return redirect('borrow')->with('ok', trans('back/borrow.destroyed'));		
	}

	/**
	 * Get tagged posts
	 * 
	 * @param  Illuminate\Http\Request $request
	 * @return Response
	 */
	public function tag(Request $request)
	{
		$tag = $request->input('tag');
		$posts = $this->borrow_gestion->indexTag($this->nbrPages, $tag);
		$links = $posts->appends(compact('tag'))->render();
		$info = trans('front/borrow.info-tag') . '<strong>' . $this->borrow_gestion->getTagById($tag) . '</strong>';
		
		return view('front.borrow.index', compact('posts', 'links', 'info'));
	}

	/**
	 * Find search in borrow
	 *
	 * @param  App\Http\Requests\SearchRequest $request
	 * @return Response
	 */
	public function search(SearchRequest $request)
	{
		$search = $request->input('search');
		$posts = $this->borrow_gestion->search($this->nbrPages, $search);
		$links = $posts->appends(compact('search'))->render();
		$info = trans('front/borrow.info-search') . '<strong>' . $search . '</strong>';
		
		return view('front.borrow.index', compact('posts', 'links', 'info'));
	}

    public function getSaveData($type, $uid) {
        $checkoutData = Checkout::all();
        $checkOutArr = array();
        if(count($checkoutData)) {
            foreach ($checkoutData as $checkout) {
                array_push($checkOutArr, $checkout->dataId);
            }
        }
        $saveData = Borrow::where('uid', $uid)->where('status', 4)->where('kieuthechap', $type)->whereNotIn('id', $checkOutArr)->get();
        $sum = 0;
        if(count($saveData)) {
            foreach ($saveData as $save) {
                $sum += $save->soluongthechap;
            }
        }
        return $sum;
    }

    public function getSaveIDs($type, $uid) {
        $checkoutData = Checkout::all();
        $checkOutArr = array();
        if(count($checkoutData)) {
            foreach ($checkoutData as $checkout) {
                array_push($checkOutArr, $checkout->dataId);
            }
        }
        $saveData = Borrow::where('uid', $uid)->where('status', 4)->where('kieuthechap', $type)->whereNotIn('id', $checkOutArr)->get();
        $arr = array();
        if(count($saveData)) {
            foreach ($saveData as $save) {
                array_push($arr, $save->id);
            }
        }
        return $arr;
    }

	public function createNew(Request $request)
	{
		if (Auth::user()) {
            $uCCL = Auth::user()->cclAddress;
            $uid = Auth::user()->id;
        } else {
        	$uCCL = '';
            $uid = 0;
        }
        $moneyType = $request->input('methodPay');
        $moneyTypeConf = \Config::get('constants.moneyAddress');
        $addReceived = $moneyTypeConf[$moneyType];

        $sotienvay = $request->input('cost');
        $saveBTC = $this->getSaveData($moneyType, $uid);
        $idSaveUsed = $this->getSaveIDs($moneyType, $uid);
        // convert coin to usd
        switch ($moneyType) {
            case 'BTC' :
                $url = 'https://api.coinmarketcap.com/v1/ticker/bitcoin/?ref=widget&convert=USD';
                break;
            case 'ETH' :
                $url = 'https://api.coinmarketcap.com/v1/ticker/ethereum/?ref=widget&convert=USD';
                break;
            case 'LTC' :
                $url = 'https://api.coinmarketcap.com/v1/ticker/litecoin/?ref=widget&convert=USD';
                break;
        }
        $jsonData = json_decode(file_get_contents($url));
        $dataPriceGet = $jsonData[0]->price_usd; // get from website later
        $dataTygia = DB::table('settings')->where('name', 'tygiaUV')->select('content')->get()[0];

        $dataP = DB::table('settings')->where('name', 'crate')->select('content')->get()[0];
        $tygia = isset($dataTygia) ? $dataTygia->content : 1;
        $saveValue = ($saveBTC * $dataPriceGet * $dataP->content * $tygia)/ 100;
        $vayCoint = ($sotienvay* 100)/($dataPriceGet * $dataP->content * $tygia);


        if ($sotienvay <= $saveValue) {
            $data = $this->borrow_gestion->store($request->all());
            if($data == '0') {
                return redirect('auth/login')->with('error', 'LOGIN_BORROW');
            }elseif($data == '01') {
                return redirect('/')->with('error', 'MAX_VALUE_BORROW');
            }elseif($data == '02') {
                return redirect('/')->with('error', 'MAX_MONEY_BORROW');
            }elseif($data == '10') {
                $warning = 'MAX_AUTHEN';
                return view('front.verified', compact('warning', 'uCCL'));
            }else {
                // update status to 2 - active
                Borrow::where('id', $data->id)->where('uid', $uid)->update(array('status'=>2)); // khong can the chap
                $newBorrow = new Borrow();
                $newBorrow->uid= $uid;
                $newBorrow->soluongthechap= $saveBTC - $vayCoint;
                $newBorrow->kieuthechap= $moneyType;
                $newBorrow->thoigianthechap= $data->thoigianthechap;
                $newBorrow->phantramlai= $data->phantramlai;
                $newBorrow->sotientoida= $data->sotientoida;
                $newBorrow->dutinhlai= $data->dutinhlai;
                $newBorrow->sotiencanvay=  $saveValue - $sotienvay;
                $newBorrow->ngaygiaingan= $data->ngaygiaingan;
                $newBorrow->ngaydaohan= $data->ngaydaohan;
                $newBorrow->status= 4; // da hoan thanh => con du
                $newBorrow->save();

                // cap nhat cac khoan vay cu ve da su dung => table checkout
                if(count($idSaveUsed)) {
                    foreach ($idSaveUsed as $borrowId) {
                        $checkout = new Checkout();
                        $checkout->uid = $uid;
                        $checkout->dataId = $borrowId;
                        $checkout->status = 0;
                        $checkout->type = 0;
                        $checkout->value = '';
                        $checkout->save();
                    }
                }
                $ok = 'IS_LOAN_CREATED';
                return view('front.borrowNotConfirm', compact('ok', 'data'));
            }
        } else {
            // coint thuc chu khong phai coin the chap nhu truoc day

            $coinMiss = $vayCoint - $saveBTC;
            // create  new borrow with value = $coinMiss
            $dataInsert = array(
                'uid'=>$uid,
                'sothechap'=>$coinMiss,
                'methodPay'=>$moneyType,
                'month'=>$request->input('month'),
                'percentCost'=>$request->input('percentCost'),
                'maxMoney'=>$request->input('maxMoney'),
                'pertotal'=>$request->input('pertotal'),
                'cost'=>$sotienvay,
                'status'=>0
            );

            $data = $this->borrow_gestion->store($dataInsert);

            if($data == '0') {
                return redirect('auth/login')->with('error', 'LOGIN_BORROW');
            }elseif($data == '01') {
                return redirect('/')->with('error', 'MAX_VALUE_BORROW');
            }elseif($data == '02') {
                return redirect('/')->with('error', 'MAX_MONEY_BORROW');
            }elseif($data == '10') {
                $warning = 'MAX_AUTHEN';
                return view('front.verified', compact('warning', 'uCCL'));
            }else {
                // cap nhat khoan vay cu - them checkout
                if (count($idSaveUsed)) {
                    foreach ($idSaveUsed as $borrowId) {
                        $checkout = new Checkout();
                        $checkout->uid = $uid;
                        $checkout->dataId = $borrowId;
                        $checkout->status = 0;
                        $checkout->type = 0;
                        $checkout->value = '';
                        $checkout->save();
                    }
                }

                $ok = 'IS_LOAN_CREATED';
                return view('front.borrow', compact('ok', 'data', 'addReceived', 'moneyType', 'uCCL'));
            }
        }
//        var_dump($sotienvay, $saveValue);
//        dd($request->all());
//
//        $data = $this->borrow_gestion->store($request->all());
//        if($data == '0') {
//            return redirect('auth/login')->with('error', 'LOGIN_BORROW');
//        }elseif($data == '01') {
//			return redirect('/')->with('error', 'MAX_VALUE_BORROW');
//		}elseif($data == '02') {
//            return redirect('/')->with('error', 'MAX_MONEY_BORROW');
//        }elseif($data == '10') {
//            $warning = 'MAX_AUTHEN';
//            return view('front.verified', compact('warning', 'uCCL'));
//        }else {
//            $ok = 'IS_LOAN_CREATED';
//            return view('front.borrow', compact('ok', 'data', 'addReceived', 'moneyType', 'uCCL'));
//		}
	}

	public function borrowUpdateDate($borrowId) {
		$borrowData = Borrow::where('id', $borrowId)->first();
		$giaingan = new Carbon('now');
		$daohan = Carbon::now()->addMonths($borrowData['thoigianthechap']);
		Borrow::where('id', $borrowId)->update(['ngaygiaingan' => $giaingan->toDateTimeString(), 'ngaydaohan' => $daohan->toDateTimeString()]);

		// email to V
		$userBorrowObj = User::where('id', $borrowData['uid'])->first();
		emailSend($borrowData, $userBorrowObj['email'], 'Email To Borrow - Invested Done ' .$userBorrowObj['username'], 'BORROW_INVEST_DONE');

		// email to D
		$investData = Invest::where('borrowId', $borrowId)->firstOrFail();
		if (count($investData)) {
			$userInvest =  User::where('id', $investData['uid'])->first();
			emailSend($borrowData, $userBorrowObj['email'], 'Email To Borrow - Invested Done To Invest' .$userInvest['username'], 'BORROW_INVEST_DONE_TO_INVEST');
		}

		return redirect('/')->with('ok', 'Data borrow data updated');
	}

}
