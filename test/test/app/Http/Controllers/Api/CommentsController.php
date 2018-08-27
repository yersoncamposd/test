<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreComments;
use App\Services\Comments as CommentsService;

class CommentsController extends Controller{
    protected $commentsService;

    public function __construct(CommentsService $commentsService)
    {
        $this->commentsService = $commentsService;
    }

    public function index(){
        return $this->commentsService->all();
    }

    public function store(StoreComments $request){
        return $this->commentsService->store($request->all());
    }

    public function update(StoreComments $request, $comments){
        return $this->commentsService->update($request-> all(), $comments->id);
    }

    public function destroy($comments){
        return $this->commentsService->delete($comments->id);
    }

    public function show($comments){
        return $comments;
    }
}