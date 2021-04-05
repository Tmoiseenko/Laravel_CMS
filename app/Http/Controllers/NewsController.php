<?php

namespace App\Http\Controllers;

use App\News;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;


class NewsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Cache::tags(['news'])->remember('news_list', 3600, fn() => News::published()->latest()->get());

        return view('news.index', compact('posts'));
    }

    /**
     * Display the specified resource.
     *
     * @param  News $post
     * @return \Illuminate\Http\Response
     */
    public function show($news)
    {
        $news = Cache::tags(['news'])->remember(
                                        'news|' . $news,
                                        3600,
                                        fn() => News::where('slug', $news)->first()
        );
        return view('news.single', compact('news'));
    }
}
