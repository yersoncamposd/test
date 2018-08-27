<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePosts;
use App\Services\Posts as PostsService;

class PostsController extends Controller{
    protected $postsService;

    public function __construct(PostsService $postsService)
    {
        $this->postsService = $postsService;
    }

    public function index(){
        return $this->postsService->all();
    }

    public function store(StorePosts $request){
        return $this->postsService->store($request->all());
    }

    public function update(StorePosts $request, $posts){
        return $this->postsService->update($request-> all(), $posts->id);
    }

    public function destroy($posts){
        return $this->postsService->delete($posts->id);
    }

    public function show($posts){
        return $posts;
    }
}