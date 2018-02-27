<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\InvestRepository;
use App\Repositories\UserRepository;
use Auth;
use DB;
use App\Models\Borrow;
use App\Models\Invest;
use App\Models\Post;
use App\Models\Verified;
use App\Models\Slideshow;
use Carbon;
use App\Models\User;

class InvestController extends Controller {

	/**
	 * The InvestRepository instance.
	 *
	 * @var App\Repositories\InvestRepository
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
	 * Create a new InvestController instance.
	 *
	 * @param  App\Repositories\InvestRepository $borrow_gestion
	 * @param  App\Repositories\UserRepository $user_gestion
	 * @return void
	*/
	public function __construct(
		InvestRepository $borrow_gestion)
	{
		$this->borrow_gestion = $borrow_gestion;
		$this->nbrPages = 2;
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
		return redirect(route('invest.order', [
			'name' => 'invest.created_at',
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

		return view('back.invest.index', compact('posts', 'links', 'order'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$url = config('medias.url');
		
		return view('back.invest.create')->with(compact('url'));
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

		return redirect('invest')->with('ok', trans('back/borrow.stored'));
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
		return view('back.invest.show',  array_merge($this->borrow_gestion->show($slug)));
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


		return view('back.invest.edit',  array_merge($this->borrow_gestion->edit($post)));
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

		$this->borrow_gestion->update($request->all(), $post);

		return redirect('invest')->with('ok', trans('back/borrow.updated'));
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

		return redirect('invest')->with('ok', trans('back/borrow.destroyed'));
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
		
		return view('front.invest.index', compact('posts', 'links', 'info'));
	}

	public function createNew($idBorrow)
	{
		// tao moi xong => hien thi thong tin dia chi nguoi nhan tien (theo borrow) va quy đổi số tiền token cần chuyển theo rate hiện tại 
		// sau khi nhà đầu tư chuyển xong => focus tới phần xác nhận đã chuyển tiền => form submit
		if (Auth::user()) {
			$borrowCheck = Invest::where('borrowId', $idBorrow)->where('uid', Auth::user()->id)->first();
			if ($borrowCheck) {
				return redirect('/')->with('ok', 'Khoản đầu tư được thực hiện trước đó');
			} else {
				$data = $this->borrow_gestion->store($idBorrow);

				if (Auth::user()) {
		            $userType =  Auth::user()->usertype;
		            $uid = Auth::user()->id;
		            $borrowsExist = Invest::where('uid', $uid)->get();
		            if (count($borrowsExist)) {
		                $arrBorrow = [];
		                foreach ($borrowsExist as $exist) {
		                    $arrBorrow[] = $exist->borrowId;
		                }
		                $borrows = Borrow::where('status', 1)->whereNotIn('id', $arrBorrow)->orderBy('created_at', 'desc')->get();
		            }else {
		                $borrows = Borrow::where('status', 1)->orderBy('created_at', 'desc')->get();
		            }
		        }else {
		            $userType = 'NON';
		            $uid = 0;

		            $borrows = Borrow::where('status', 1)->orderBy('created_at', 'desc')->get();
		        }

		        $borrowsOfUser = Borrow::where('uid', $uid)->orderBy('created_at', 'desc')->get();
		        $investsOfUser = Invest::leftJoin('borrow', 'invest.borrowId','=', 'borrow.id')->where('invest.uid', $uid)->orderBy('invest.created_at', 'desc')->get(
		            ['invest.*', 'borrow.soluongthechap', 'borrow.kieuthechap', 'borrow.thoigianthechap', 'borrow.phantramlai', 'borrow.dutinhlai', 'borrow.sotiencanvay', 'borrow.ngaygiaingan', 'borrow.ngaydaohan']
		        );

		        $khoanggia = \Config::get('constants.khoanggia');
		        $blogs = Post::where('active', 1)->orderBy('updated_at', 'desc')->get();
		        $slideshows = Slideshow::where('status', 1)->orderBy('position', 'desc')->get();

				if($data != '0') {
					$okMessage = 'Khoản đầu tư đã được gửi, chờ nhà đầu tư chuyển tiền';
					$borrowData = Borrow::where('id', $idBorrow)->first();
					if($borrowData) {
						$sotien = $borrowData->sotiencanvay;
						$dataTygia = DB::table('settings')->where('name', 'ccl')->select('content')->get()[0]; 
						$dataMoney = round($sotien/$dataTygia->content, 2);
						$userData = User::where('id', $borrowData->uid)->first();
						if ($userData) {
							$dataCCL = $userData->cclAddress;
						}
						$dataId = $data->borrowId;
					}

					return view('front.index', compact('okMessage', 'dataId', 'dataMoney', 'dataCCL', 'blogs', 'userType', 'uid', 'borrows', 'borrowsOfUser', 'investsOfUser', 'khoanggia', 'slideshows'));
		            // return redirect('/')->with('ok', 'Khoản đầu tư đã được gửi, chờ nhà đầu tư chuyển tiền');
		        } 
		    }

	    } else {
	       return redirect('auth/login')->with('ok', 'Please login before invest');
        }
    }

}
