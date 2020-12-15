<?php

namespace App\Http\Controllers;


use App\Comment;
use App\Http\Requests\CommentRequest;
use App\News;
use App\Post;


class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function storeNews(CommentRequest $request)
    {
        $validated = $request->validated();
        $newComment = new Comment($validated);
        $news = News::find($request->post('postId'));
        $news->comments()->save($newComment);

        return redirect()->back();
    }

    public function storePost(CommentRequest $request)
    {
        $validated = $request->validated();
        $newComment = new Comment($validated);
        $post = Post::find($request->post('postId'));
        $post->comments()->save($newComment);

        return redirect()->back();
    }

}
