<?php namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use App\Repositories\SlideshowRepository;

class SlideshowController extends Controller {
    
	protected $Slideshow_gestion;

	protected $nbrPages;

	public function __construct(
		SlideshowRepository $Slideshow_gestion)
	{
		$this->Slideshow_gestion = $Slideshow_gestion;
		$this->nbrPages = 2;

		$this->middleware('redac', ['except' => ['indexFront', 'show', 'tag', 'search']]);
		$this->middleware('admin', ['only' => 'updateSeen']);
		$this->middleware('ajax', ['only' => ['updateSeen', 'updateActive']]);
	}	

	public function index()
	{
		return redirect(route('Slideshow.order', [
			'name' => 'slideshow.created_at',
			'sens' => 'asc'
		]));
	}

	public function indexOrder(Request $request)
	{
		$slideshow = $this->Slideshow_gestion->index(
			10, 
			$request->name,
			$request->sens
		);
		
		$links = $slideshow->appends([
				'name' => $request->name, 
				'sens' => $request->sens
			]);

		if($request->ajax()) {
			return response()->json([
				'view' => view('back.slideshow.table', compact('slideshow'))->render(),
				'links' => e($links->setPath('order')->render())
			]);		
		}

		$links->setPath('')->render();

		$order = (object)[
			'name' => $request->name, 
			'sens' => 'sort-' . $request->sens			
		];

		return view('back.slideshow.index', compact('slideshow', 'links', 'order'));
	}

	public function create()
	{
		$url = config('medias.url');
		
		return view('back.slideshow.create')->with(compact('url'));
	}

	public function store(Request $request)
	{
		$this->Slideshow_gestion->store($request->all(), $request->user()->id);

		return redirect('slideshow')->with('ok', trans('back.slideshow.stored'));
	}

	public function edit(
		$id)
	{
		$post = $this->Slideshow_gestion->getById($id);

		return view('back.slideshow.edit',  array_merge($this->Slideshow_gestion->edit($post)));
	}

	public function update(
		Request $request,
		$id)
	{
		$post = $this->Slideshow_gestion->getById($id);

		$this->Slideshow_gestion->update($request->all(), $post , 'up');

		return redirect('slideshow')->with('ok', trans('back.slideshow.updated'));		
	}

	public function destroy($id)
	{
		$post = $this->Slideshow_gestion->getById($id);

		$this->Slideshow_gestion->destroy($post);

		return redirect('slideshow')->with('ok', trans('back.slideshow.destroyed'));		
	}
    }
