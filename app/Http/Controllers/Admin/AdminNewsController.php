<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\News;
use App\NewsTagsSync;
use App\PostTagsSync;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminNewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(News $news)
    {
        return view('admin.news.editNews', ['post' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  News $news
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, News $news, PostTagsSync $tagsSync)
    {
        $news->update($request->validated());
        $tagsSync->sync($news, request('tags'));

        flash("Статья успешно обновлена");
        return redirect()->route('admin.news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(News $news)
    {
        $deletedNews = $news;
        $news->delete();
        flash("Статья удалена", 'warning');

        return redirect()->route('admin.news');
    }
}
