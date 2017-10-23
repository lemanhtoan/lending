<?php

namespace App\Repositories;

use App\Models\Invest;
use Auth;

class InvestRepository extends BaseRepository {

    public function __construct(
    Invest $post) 
    {
        $this->model = $post;
    }


    private function savePost($post, $inputs, $uid)
    {
        $status = '0'; // Chờ nhà đầu tư chuyển tiền
        if ($uid == 0) {
            // save to session and after login - register => save
            $currentData = array('uid' => (int) $uid, 'borrowId' => (int) $inputs, 'status' => $status);
            \Session::put('invest.data', $currentData);
            return 0;
        } else {
            $post->uid = (int) $uid;
            $post->borrowId = (int) $inputs;
            $post->status = $status;
            $post->save();
            return $post;
        }
    }

    /**
     * Create a query for Post.
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function queryActiveWithUserOrderByDate()
    {
        return $this->model
            ->select('id', 'created_at', 'updated_at', 'title', 'slug', 'user_id', 'summary')
                        ->whereActive(true)
                        ->with('user')
                        ->latest();
    }

    /**
     * Get post collection.
     *
     * @param  int  $n
     * @return Illuminate\Support\Collection
     */
    public function indexFront($n)
    {
        $query = $this->queryActiveWithUserOrderByDate();

        return $query->paginate($n);
    }

    /**
     * Get post collection.
     *
     * @param  int  $n
     * @param  int  $id
     * @return Illuminate\Support\Collection
     */
    public function indexTag($n, $id)
    {
        $query = $this->queryActiveWithUserOrderByDate();

        return $query->whereHas('tags', function($q) use($id) {
                            $q->where('tags.id', $id);
                        })
                        ->paginate($n);
    }

    /**
     * Get search collection.
     *
     * @param  int  $n
     * @param  string  $search
     * @return Illuminate\Support\Collection
     */
    public function search($n, $search)
    {
        $query = $this->queryActiveWithUserOrderByDate();

        return $query->where(function($q) use ($search) {
                    $q->where('summary', 'like', "%$search%")
                            ->orWhere('content', 'like', "%$search%")
                            ->orWhere('title', 'like', "%$search%");
                })->paginate($n);
    }

    /**
     * Get post collection.
     *
     * @param  int     $n
     * @param  int     $user_id
     * @param  string  $orderby
     * @param  string  $direction
     * @return Illuminate\Support\Collection
     */
    public function index($n, $orderby = 'created_at', $direction = 'desc')
    {
        $query = $this->model
                ->select('invest.*', 'username', 'borrow.soluongthechap',
                    'borrow.soluongthechap',
                    'borrow.kieuthechap',
                    'borrow.thoigianthechap',
                    'borrow.phantramlai',
                    'borrow.dutinhlai',
                    'borrow.sotiencanvay',
                    'borrow.ngaydaohan',
                    'borrow.status as bStatus'
                    )
                ->join('users', 'users.id', '=', 'invest.uid')
                ->join('borrow', 'borrow.id', '=', 'invest.borrowId')
                ->orderBy($orderby, $direction);

        return $query->paginate($n);
    }

    /**
     * Get post collection.
     *
     * @param  string  $slug
     * @return array
     */
    public function show($slug)
    {
        $post = $this->model
            ->select('invest.*', 'username', 'borrow.soluongthechap',
                'borrow.soluongthechap',
                'borrow.kieuthechap',
                'borrow.thoigianthechap',
                'borrow.phantramlai',
                'borrow.dutinhlai',
                'borrow.sotiencanvay',
                'borrow.ngaydaohan',
                'borrow.status as bStatus'
            )
            ->join('users', 'users.id', '=', 'invest.uid')
            ->join('borrow', 'borrow.id', '=', 'invest.borrowId')
            ->where('invest.id', $slug)->firstOrFail();

        return compact('post');
    }

    /**
     * Get post collection.
     *
     * @param  App\Models\Post $post
     * @return array
     */
    public function edit($post)
    {
        $tags = [];

        foreach ($post->tags as $tag) {
            array_push($tags, $tag->tag);
        }

        return compact('post', 'tags');
    }

    /**
     * Get post collection.
     *
     * @param  int  $id
     * @return array
     */
    public function GetByIdWithTags($id)
    {
        return $this->model->with('tags')->findOrFail($id);
    }

    /**
     * Update a post.
     *
     * @param  array  $inputs
     * @param  App\Models\Post $post
     * @return void
     */
    public function update($inputs, $post)
    {
        $post = $this->savePost($post, $inputs);
    }

    /**
     * Update "seen" in post.
     *
     * @param  array  $inputs
     * @param  int    $id
     * @return void
     */
    public function updateSeen($inputs, $id)
    {
        $post = $this->getById($id);

        $post->seen = $inputs['seen'] == 'true';

        $post->save();
    }

    /**
     * Update "active" in post.
     *
     * @param  array  $inputs
     * @param  int    $id
     * @return void
     */
    public function updateActive($inputs, $id)
    {
        $post = $this->getById($id);

        $post->active = $inputs['active'] == 'true';

        $post->save();
    }

    /**
     * Create a post.
     *
     * @param  array  $inputs
     * @param  int    $user_id
     * @return void
     */
    public function store($inputs)
    {
        if (Auth::user()) {
            $uid = Auth::user()->id;
        }else {
            $uid = 0;
        }
        $data = $this->savePost(new $this->model, $inputs, $uid);
        return $data;
    }

    /**
     * Destroy a post.
     *
     * @param  App\Models\Post $post
     * @return void
     */
    public function destroy($post) {

        $post->delete();
    }

    /**
     * Get post slug.
     *
     * @param  int  $comment_id
     * @return string
     */
    public function getSlug($comment_id)
    {
        return $this->comment->findOrFail($comment_id)->post->slug;
    }

    /**
     * Get tag name by id.
     *
     * @param  int  $tag_id
     * @return string
     */
    public function getTagById($tag_id)
    {
        return $this->tag->findOrFail($tag_id)->tag;
    }

}
