<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use App\Repositories\BorrowRepository;
use App\Repositories\UserRepository;

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
		BorrowRepository $borrow_gestion,
		UserRepository $user_gestion)
	{
		$this->user_gestion = $user_gestion;
		$this->borrow_gestion = $borrow_gestion;
		$this->nbrPages = 2;

		$this->middleware('redac', ['except' => ['indexFront', 'show', 'tag', 'search']]);
		$this->middleware('admin', ['only' => 'updateSeen']);
		$this->middleware('ajax', ['only' => ['updateSeen', 'updateActive']]);
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
			'name' => 'posts.created_at',
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
		$statut = $this->user_gestion->getStatut();
		$posts = $this->borrow_gestion->index(
			10, 
			$statut == 'admin' ? null : $request->user()->id,
			$request->name,
			$request->sens
		);
		
		$links = $posts->appends([
				'name' => $request->name, 
				'sens' => $request->sens
			]);

		if($request->ajax()) {
			return response()->json([
				'view' => view('back.borrow.table', compact('statut', 'posts'))->render(), 
				'links' => e($links->setPath('order')->render())
			]);		
		}

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
		Guard $auth, 
		$slug)
	{
		$user = $auth->user();

		return view('front.borrow.show',  array_merge($this->borrow_gestion->show($slug), compact('user')));
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

		$this->authorize('change', $post);

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

}
