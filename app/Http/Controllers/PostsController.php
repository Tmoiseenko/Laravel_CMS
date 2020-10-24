<?php

namespace App\Http\Controllers;


use App\Http\Requests\PostRequest;
use App\Mail\PostCreated;
use App\Mail\PostDeleted;
use App\Mail\PostUpdated;
use App\Rules\PostContent;
use App\Rules\PostCreateSlug;
use App\Rules\PostExcerpt;
use App\Rules\PostTitle;
use App\Rules\PostUpdateSlug;
use App\Tag;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\New_;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $posts = \auth()->user()->posts()->published()->latest()->get();
        } else {
            $posts = Post::published()->latest()->get();
        }

        return view('posts.index', compact('posts'));
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
    public function store(PostRequest $request)
    {
        $attributes = $request->validated();
        $attributes['user_id'] = Auth::id();
        $post = Post::create($attributes);

        $tagsSync = app()->make('App\Http\Controllers\PostTagsSyncController');
        $tagsSync->sync($post);

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
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());

        $tagsSync = app()->make('App\Http\Controllers\PostTagsSyncController');
        $tagsSync->sync($post);

        flash("Статья успешно обновлена");
        \Mail::to('tmoiseenko@laravel.skillbox')->queue(new PostUpdated($post));
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $deletedPost = $post;
        \Mail::to('tmoiseenko@laravel.skillbox')->queue(new PostDeleted($deletedPost));
        $post->delete();
        flash("Статья удалена", 'warning');

        return redirect('/');
    }
}
