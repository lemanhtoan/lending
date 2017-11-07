<?php

namespace App\Repositories;

use App\Models\Slideshow;
use File,Input;

class SlideshowRepository extends BaseRepository {

    public function __construct(
    Slideshow $post)
    {
        $this->model = $post;
    }

    private function saveSlideshow($post, $inputs, $type= null)
    {
        $img = isset($inputs['image']) ? $inputs['image'] : '';
        if ($type == 'up') {
            if ($img) {
                $df = $inputs['image'];
                $name_img = time() . '_' . $df->getClientOriginalName();
                $df->move(\Config::get('constants.pathUpload'), $name_img);

                $post->title = $inputs['title'];
                $post->image = $name_img;
                $post->position = $inputs['position'];
                $post->link = $inputs['link'];
                $post->status = $inputs['status'];
                $post->save();
                return $post;

            } else {
                $post->title = $inputs['title'];
                $post->position = $inputs['position'];
                $post->link = $inputs['link'];
                $post->status = $inputs['status'];
                $post->save();
                return $post;
            }
        } else {
            if ($img) {
                $df = $inputs['image'];
                $name_img = time() . '_' . $df->getClientOriginalName();
                $df->move(\Config::get('constants.pathUpload'), $name_img);
            } else {
                $name_img = '';
            }
            $post->title = $inputs['title'];
            $post->image = $name_img;
            $post->position = $inputs['position'];
            $post->link = $inputs['link'];
            $post->status = $inputs['status'];
            $post->save();
            return $post;
        }
    }

    private function queryActiveWithUserOrderByDate()
    {
        return $this->model
            ->select('*')->latest();
    }

    public function indexFront($n)
    {
        $query = $this->queryActiveWithUserOrderByDate();

        return $query->paginate($n);
    }

    public function search($n, $search)
    {
        $query = $this->queryActiveWithUserOrderByDate();

        return $query->where(function($q) use ($search) {
                    $q->where('ip', 'like', "%$search%");
                })->paginate($n);
    }

    public function index($n, $orderby = 'created_at', $direction = 'desc')
    {
        $query = $this->model
                ->select('*')
                ->orderBy($orderby, $direction);

        return $query->paginate($n);
    }

    public function show($slug)
    {
        $post = $this->model->firstOrFail();
        return compact('post');
    }

    public function edit($post)
    {
        return compact('post');
    }

    public function update($inputs, $post, $type=null)
    {
        $this->saveSlideshow($post, $inputs, $type);
    }

    public function updateActive($inputs, $id)
    {
        $post = $this->getById($id);

        $post->status = $inputs['status'] == 1;

        $post->save();
    }

    public function store($inputs, $user_id)
    {
        $this->saveSlideshow(new $this->model, $inputs);
    }

    public function destroy($post) {
        $post->delete();
    }
}
