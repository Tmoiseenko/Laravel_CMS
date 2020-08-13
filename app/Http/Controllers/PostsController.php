<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::published()->latest()->get();
        $title = 'Блог Laravel-Skillbox';

        return view('posts.index', compact('posts', 'title'));
    }

    public function single(Post $post)
    {
        $title = $post->title;
        return view('posts.single', compact('post', 'title'));
    }

    public function createGet()
    {
        $title = 'Создание статьи';
        return view('posts.create', compact('title'));
    }

    public function createPost()
    {
        $request = request();

        $this->validate($request, [
            'title' => 'required|min:5|max:100',
            'slug' => [
                'required',
                'unique:posts'
            ],
            'excerpt' => 'required|max:255',
            'content' => 'required',
        ]);

        $request->merge(array('published' => $request->has('published') ? true : false));

        Post::create($request->all());

        return redirect('/');
    }
}
