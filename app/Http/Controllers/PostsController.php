<?php

namespace App\Http\Controllers;

use App\Mail\PostCreated;
use App\Mail\PostDeleted;
use App\Mail\PostUpdated;
use App\Tag;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


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
        $title = 'Создание статьи';
        return view('posts.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = request();
        $request->merge(array('published' => $request->has('published') ? true : false));
        $request->validate([
            'title' => 'required|min:5|max:100',
            'slug' => [
                'required',
                'unique:posts'
            ],
            'excerpt' => 'required|max:255',
            'content' => 'required',
        ]);
        $request['user_id'] = Auth::id();

        $post = Post::create($request->all());
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
        $title = $post->title;
        return view('posts.single', compact('post', 'title'));
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
        $title = 'Редактирование статьи';
        return view('posts.edit', compact('post', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {


        $attributes = request()->validate([
            'title' => 'required|min:5|max:100',
            'slug' => 'required',
            'excerpt' => 'required|max:255',
            'content' => 'required',
        ]);

        $post->update($attributes);

        $postTags = $post->tags->keyBy('name');
        $tags = collect(explode(',', request('tags')))->keyBy(function ($item) { return $item; } );
        $syncIds = $postTags->intersectByKeys($tags)->pluck('id')->toArray();
        $postToAttach = $tags->diffKeys($postTags);

        foreach ($postToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $post->tags()->sync($syncIds);
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
        $post->delete();
//        dd($deletedPost->title);
        flash("Статья удалена", 'warning');
        \Mail::to('tmoiseenko@laravel.skillbox')->queue(new PostDeleted($deletedPost));
        return redirect('/');
    }
}
