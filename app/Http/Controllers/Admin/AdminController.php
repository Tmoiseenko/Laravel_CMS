<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Mail\PostDeleted;
use App\Mail\PostUpdated;
use App\Post;
use App\PostTagsSync;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
            $posts = Post::all();
            return view('admin.index', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        return view('admin.editPost', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post, PostTagsSync $tagsSync)
    {
        $post->update($request->validated());
        $tagsSync->sync($post, request('tags'));

        flash("Статья успешно обновлена");
        \Mail::to(config('mail.admin_email'))->queue(new PostUpdated($post));
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Post $post)
    {
        $deletedPost = $post;
        \Mail::to(config('mail.admin_email'))->queue(new PostDeleted($deletedPost));
        $post->delete();
        flash("Статья удалена", 'warning');

        return redirect()->route('admin.index');
    }
}
