<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        return view('posts.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, PostTagsSyncController $tagsSync)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = Auth::id();
        $post = Post::create($attributes);

        $tagsSync->sync($post, request('tags'));

        flash("Новая статья успешно создана");
        \Mail::to('tmoiseenko@laravel.skillbox')->queue(new PostCreated($post));

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.single', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post, PostTagsSyncController $tagsSync)
    {
        $post->update($request->validated());
        $tagsSync->sync($post, request('tags'));

        flash("Статья успешно обновлена");
        \Mail::to('tmoiseenko@laravel.skillbox')->queue(new PostUpdated($post));
        return redirect('/');
    }
}
