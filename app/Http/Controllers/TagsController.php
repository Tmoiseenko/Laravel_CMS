<?php

namespace App\Http\Controllers;

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
        if (Auth::check()) {
            $posts = $tag->posts()->where('user_id', Auth::id())->get();
        } else {
            $posts = $tag->posts()->with('tags')->get();
        }

        return view('posts.index', compact('posts'));
    }

}
