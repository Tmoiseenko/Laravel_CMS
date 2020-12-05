<?php

namespace App\Http\Controllers;


use App\Comment;
use App\Http\Requests\CommentRequest;


class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $class = $request->post('postType');
        $validated = $request->validated();
        $newComment = new Comment($validated);
        $model = $class::find($request->post('postId'));
        $model->comments()->save($newComment);

        return redirect()->back();
    }

}