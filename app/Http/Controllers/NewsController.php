<?php

namespace App\Http\Controllers;

use App\News;
use App\Http\Controllers\Controller;


class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = News::published()->latest()->get();
        return view('news.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  News $post
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.single', compact('news'));
    }
}