<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

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
        $posts = $tag->posts()->with('tags')->get();
        $title = 'Блог Laravel-Skillbox';
        return view('posts.index', compact('posts', 'title'));
    }

}
