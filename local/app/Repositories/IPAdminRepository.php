<?php

namespace App\Repositories;

use App\Models\IPAdmin;

class IPAdminRepository extends BaseRepository {

    public function __construct(
    IPAdmin $post)
    {
        $this->model = $post;
    }

    private function saveIPAdmin($post, $inputs)
    {
        $post->ip = $inputs['ip'];
        $post->status = $inputs['status'];
        $post->save();
        return $post;
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

    public function update($inputs, $post)
    {
        $this->saveIPAdmin($post, $inputs);
    }

    public function updateActive($inputs, $id)
    {
        $post = $this->getById($id);

        $post->status = $inputs['status'] == 1;

        $post->save();
    }

    public function store($inputs, $user_id)
    {
        $this->saveIPAdmin(new $this->model, $inputs);
    }

    public function destroy($post) {
        $post->delete();
    }
}
