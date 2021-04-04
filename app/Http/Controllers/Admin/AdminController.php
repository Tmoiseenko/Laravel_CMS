<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use App\News;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index()
    {
        $postsCount = Cache::tags(['dashboard'])->remember('postsCount', 3600, fn() => Post::count());
        $newsCount = Cache::tags(['dashboard'])->remember('newsCount', 3600, fn() => News::count());
        $commentsCount = Cache::tags(['dashboard'])->remember('commentsCount', 3600, fn() => Comment::count());
        $usersCount = Cache::tags(['dashboard'])->remember('usersCount', 3600, fn() => User::count());
        $mostPopularPost = Cache::tags(['dashboard'])->remember('mostPopularPost',
            3600,
            fn() => Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->first()
            );
        $userWithMaxPost = Cache::tags(['dashboard'])->remember('userWithMaxPost',
            3600,
            fn() => User::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->first()
        );
        $postMaxBody = Cache::tags(['dashboard'])->remember('postMaxBody',
            3600,
            fn() => Post::select(DB::raw('*, LENGTH(content) as cnt'))
                ->orderBy('cnt', 'desc')
                ->first()
        );
        $postMinBody = Cache::tags(['dashboard'])->remember('postMinBody',
            3600,
            fn() => Post::select(DB::raw('*, LENGTH(content) as cnt'))
                ->orderBy('cnt', 'asc')
                ->first()
        );
        $avgUSerPosts = Cache::tags(['dashboard'])->remember('avgUSerPosts',
            3600,
            fn() => User::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get()
                ->where('posts_count', '>', 1)
                ->avg('posts_count')
        );

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
