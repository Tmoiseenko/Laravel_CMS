<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag)
    {
        $news = Cache::tags(['tags', 'posts'])->remember('news_tags', 3600, fn() => $tag->news()->published()->get());
        $posts = Cache::tags(['tasgs', 'posts'])->remember('posts_tags', 3600, fn() => $tag->posts()->published()->get());

        return view('tags', compact('tag'));
    }

}
