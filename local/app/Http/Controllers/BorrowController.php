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

	public function createNew(Request $request)
	{
		if (Auth::user()) {
            $uCCL = Auth::user()->cclAddress;
        } else {
        	$uCCL = '';
        }
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
            $ok = 'IS_LOAN_CREATED';
            $moneyType="";
            $moneyType = $request->input('methodPay');
            $addReceived = "";
            if($moneyType=="BTC"){
                $addReceived = "1FhVnQeViHFd54rbRWuEskqqfY4CDJ4WPd";
            }
            if($moneyType=="ETH"){
                $addReceived = "0xc003724eb51c809b38340f91d16716ab67a0772b";
            }
            return view('front.borrow', compact('ok', 'data', 'addReceived', 'moneyType', 'uCCL'));
		}
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
