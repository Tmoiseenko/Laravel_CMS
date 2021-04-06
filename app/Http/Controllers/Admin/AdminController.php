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
        $postsCount = Cache::tags(['posts'])->remember('postsCount', 3600, fn() => Post::count());
        $newsCount = Cache::tags(['news'])->remember('newsCount', 3600, fn() => News::count());
        $commentsCount = Cache::tags(['comments'])->remember('commentsCount', 3600, fn() => Comment::count());
        $usersCount = Cache::tags(['users'])->remember('usersCount', 3600, fn() => User::count());
        $mostPopularPost = Cache::tags(['comments', 'posts'])->remember('mostPopularPost',
            3600,
            fn() => Post::withCount('comments')
                ->orderBy('comments_count', 'desc')
                ->first()
            );
        $userWithMaxPost = Cache::tags(['posts'])->remember('userWithMaxPost',
            3600,
            fn() => User::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->first()
        );
        $postMaxBody = Cache::tags(['posts'])->remember('postMaxBody',
            3600,
            fn() => Post::select(DB::raw('*, LENGTH(content) as cnt'))
                ->orderBy('cnt', 'desc')
                ->first()
        );
        $postMinBody = Cache::tags(['post'])->remember('postMinBody',
            3600,
            fn() => Post::select(DB::raw('*, LENGTH(content) as cnt'))
                ->orderBy('cnt', 'asc')
                ->first()
        );
        $avgUSerPosts = Cache::tags(['posts', 'users'])->remember('avgUSerPosts',
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
