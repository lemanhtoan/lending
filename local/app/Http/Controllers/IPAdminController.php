<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Repositories\IPAdminRepository;

class IPAdminController extends Controller {
    
	protected $IPAdmin_gestion;

	protected $nbrPages;

	public function __construct(
		IPAdminRepository $IPAdmin_gestion)
	{
		$this->IPAdmin_gestion = $IPAdmin_gestion;
		$this->nbrPages = 2;

		$this->middleware('redac', ['except' => ['indexFront', 'show', 'tag', 'search']]);
		$this->middleware('admin', ['only' => 'updateSeen']);
		$this->middleware('ajax', ['only' => ['updateSeen', 'updateActive']]);
	}	

	public function indexFront()
	{
		$admin_ip = $this->IPAdmin_gestion->indexFront($this->nbrPages);
		$links = $admin_ip->render();

		return view('front.IPAdmin.index', compact('admin_ip', 'links'));
	}

	public function index()
	{
		return redirect(route('IPAdmin.order', [
			'name' => 'admin_ip.created_at',
			'sens' => 'asc'
		]));
	}

	public function indexOrder(Request $request)
	{
		$admin_ip = $this->IPAdmin_gestion->index(
			10, 
			$request->name,
			$request->sens
		);
		
		$links = $admin_ip->appends([
				'name' => $request->name, 
				'sens' => $request->sens
			]);

		if($request->ajax()) {
			return response()->json([
				'view' => view('back.IPAdmin.table', compact('admin_ip'))->render(),
				'links' => e($links->setPath('order')->render())
			]);		
		}

		$links->setPath('')->render();

		$order = (object)[
			'name' => $request->name, 
			'sens' => 'sort-' . $request->sens			
		];

		return view('back.IPAdmin.index', compact('admin_ip', 'links', 'order'));
	}

	public function create()
	{
		$url = config('medias.url');
		
		return view('back.IPAdmin.create')->with(compact('url'));
	}

	public function store(Request $request)
	{
		$this->IPAdmin_gestion->store($request->all(), $request->user()->id);

		return redirect('IPAdmin')->with('ok', trans('back/IPAdmin.stored'));
	}

	public function edit(
		$id)
	{
		$post = $this->IPAdmin_gestion->getById($id);

		return view('back.IPAdmin.edit',  array_merge($this->IPAdmin_gestion->edit($post)));
	}

	public function update(
		Request $request,
		$id)
	{
		$post = $this->IPAdmin_gestion->getById($id);

		$this->IPAdmin_gestion->update($request->all(), $post);

		return redirect('IPAdmin')->with('ok', trans('back/IPAdmin.updated'));		
	}

	public function updateActive(
		Request $request, 
		$id)
	{
		$post = $this->IPAdmin_gestion->getById($id);

		$this->IPAdmin_gestion->updateActive($request->all(), $id);

		return response()->json();
	}

	public function destroy($id)
	{
		$post = $this->IPAdmin_gestion->getById($id);

		$this->IPAdmin_gestion->destroy($post);

		return redirect('IPAdmin')->with('ok', trans('back/IPAdmin.destroyed'));		
	}


	public function search(SearchRequest $request)
	{
		$search = $request->input('search');
		$admin_ip = $this->IPAdmin_gestion->search($this->nbrPages, $search);
		$links = $admin_ip->appends(compact('search'))->render();
		$info = trans('front/IPAdmin.info-search') . '<strong>' . $search . '</strong>';
		
		return view('front.IPAdmin.index', compact('admin_ip', 'links', 'info'));
	}

}
