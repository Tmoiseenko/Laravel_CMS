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
        $postsCount = Post::count();
        $newsCount = News::count();
        $commentsCount = Comment::count();
        $usersCount = User::count();
        $mostPopularPost = Post::withCount('comments')
            ->orderBy('comments_count', 'desc')
            ->first();
        $userWithMaxPost = User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->first();
        $postMaxBody = Post::select(DB::raw('*, LENGTH(content) as cnt'))
            ->orderBy('cnt', 'desc')
            ->first();
        $postMinBody = Post::select(DB::raw('*, LENGTH(content) as cnt'))
            ->orderBy('cnt', 'asc')
            ->first();

        $avgUSerPosts = User::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->get()
            ->where('posts_count', '>', 1)
            ->avg('posts_count');

        return view('admin.dashboard', compact(
            'postsCount',
            'newsCount',
            'commentsCount',
            'usersCount',
            'userWithMaxPost',
            'mostPopularPost',
            'postMaxBody',
            'postMinBody',
            'avgUSerPosts'
        ));
    }

}
