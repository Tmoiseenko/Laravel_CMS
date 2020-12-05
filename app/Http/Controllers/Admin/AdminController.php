<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\News;
use App\Post;
use App\User;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $news = News::all();
        $comments = Comment::all();
        $users = User::all();
        $maxComentablePost = DB::table('comments')
            ->select(DB::raw('commentable_id, count(*) as cnt'))
            ->where('commentable_type', 'like', '%Post')
            ->groupBy('commentable_id')
            ->orderBy('cnt', 'desc')
            ->limit(1)
            ->first();
        $mostPopularPost = DB::table('posts')->find($maxComentablePost->commentable_id);
        $maxCommentCount = $maxComentablePost->cnt;
        $maxPostUserId = DB::table('posts')
            ->select(DB::raw('user_id, count(*) as cnt'))
            ->groupBy('user_id')
            ->orderBy('cnt', 'desc')
            ->limit(1)
            ->first();
        $maxPostCount = $maxPostUserId->cnt;
        $userWithMaxPost = User::find($maxPostUserId->user_id);
        $postsWithLength = DB::table('posts')
            ->select(DB::raw('*, length(content) as length'))
            ->orderBy('length', 'desc')
            ->get();
        $mostFicklePostRaw = DB::table('post_histories')
            ->select(DB::raw('post_id, count(post_id) as cnt'))
            ->groupBy('post_id')
            ->orderBy('cnt', 'desc')
            ->limit(1)
            ->first();
        $mostFicklePost = $mostFicklePostRaw ? Post::find($mostFicklePostRaw->post_id) : null;
        $avgPostCount = DB::table('posts')
            ->leftJoin('users', 'users.id', '=', 'posts.user_id')
            ->select(DB::raw('users.name, avg(posts.id) as cnt'))
            ->groupBy('user_id')
            ->having('cnt', '>', 1)
            ->orderByDesc('cnt')
            ->get();
//        dd($avgPostCountRaw);
        return view('admin.dashboard', compact(
            'posts',
            'news',
            'comments',
            'users',
            'maxPostCount',
            'userWithMaxPost',
            'mostPopularPost',
            'maxCommentCount',
            'postsWithLength',
            'mostFicklePostRaw',
            'mostFicklePost',
            'avgPostCount'
        ));
    }

}
