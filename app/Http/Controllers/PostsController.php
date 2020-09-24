<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Post;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::published()->latest()->get();
        $title = 'Блог Laravel-Skillbox';

        return view('posts.index', compact('posts', 'title'));
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

        Post::create($request->all());

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
        $post->delete();
        return redirect('/');
    }
}
