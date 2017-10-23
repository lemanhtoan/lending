<?php

namespace App\Repositories;

use App\Models\Borrow;
use Carbon\Carbon;
use DB;
class BorrowRepository extends BaseRepository {

    public function __construct(
    Borrow $post) 
    {
        $this->model = $post;
    }


    private function savePost($post, $inputs)
    {
        $uid = $inputs['uid'];
        $status = '0'; // khoi tao
        $soluongthechap = (float)$inputs['sothechap'];
        $kieuthechap = $inputs['methodPay'];
        $thoigianthechap = $inputs['month'];
        $phantramlai = $inputs['percentCost'];
        $sotientoida = (float)$inputs['maxMoney'];
        $dutinhlai = (float)($inputs['pertotal'] - $inputs['cost']);
        $sotiencanvay = (float)$inputs['cost'];
        $ngaygiaingan = Carbon::now()->addMonths($thoigianthechap);
        $ngaydaohan = $ngaygiaingan;

        if ($sotiencanvay > $sotientoida) return;

        if ($uid == 0)  {
            // save to session and after login - register => save
            $currentData = array(
                'uid' => (int) $uid, 'soluongthechap' => $soluongthechap, 'status' => $status,
                'kieuthechap' => $kieuthechap, 'thoigianthechap' => $thoigianthechap, 'phantramlai' => $phantramlai,
                'sotientoida' => $sotientoida, 'dutinhlai' => $dutinhlai, 'sotiencanvay' => $sotiencanvay,
                'ngaygiaingan' => $ngaygiaingan, 'ngaydaohan' => $ngaydaohan
            );
            \Session::put('borrow.data', $currentData);
            return 0;
        } else {
            $checkMax = Borrow::where('status', '<>', 4)->where('uid', $inputs['uid'])->get();
            $getMaxConstans = DB::table('settings')->where('name', 'dataLogo')->select('content')->get()[0];
            if (count($checkMax) > $getMaxConstans->content) {
                return 01;
            }
            $post->uid = $inputs['uid'];
            $post->soluongthechap = $soluongthechap;
            $post->kieuthechap = $kieuthechap;
            $post->thoigianthechap = $thoigianthechap;
            $post->phantramlai = $phantramlai;
            $post->sotientoida = $sotientoida;
            $post->dutinhlai = $dutinhlai;
            $post->sotiencanvay = $sotiencanvay;
            $post->ngaygiaingan = $ngaygiaingan;
            $post->ngaydaohan = $ngaydaohan;
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
                ->select('borrow.*', 'users.username')
                ->join('users', 'users.id', '=', 'borrow.uid')
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
        $post = $this->model->whereId($slug)->firstOrFail();

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

        // Tag gestion
        $tags_id = [];
        if (array_key_exists('tags', $inputs) && $inputs['tags'] != '') {

            $tags = explode(',', $inputs['tags']);

            foreach ($tags as $tag) {
                $tag_ref = $this->tag->whereTag($tag)->first();
                if (is_null($tag_ref)) {
                    $tag_ref = new $this->tag();
                    $tag_ref->tag = $tag;
                    $tag_ref->save();
                }
                array_push($tags_id, $tag_ref->id);
            }
        }

        $post->tags()->sync($tags_id);
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
        return $this->savePost(new $this->model, $inputs);
    }

    /**
     * Destroy a post.
     *
     * @param  App\Models\Post $post
     * @return void
     */
    public function destroy($post) {
        $post->tags()->detach();

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
