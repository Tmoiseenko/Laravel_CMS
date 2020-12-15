<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $news = $tag->news()->published()->get();
        $posts = $tag->posts()->published()->get();
        return view('tags', compact('tag'));
    }

}
