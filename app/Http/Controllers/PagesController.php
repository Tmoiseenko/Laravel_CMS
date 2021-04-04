<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PagesController extends Controller
{
    public function about()
    {
        $title = Cache::rememberForever('feedback_title', fn() => 'О нас');
        return view('pages.about', compact('title'));
    }

    public function contact()
    {
        $title = Cache::rememberForever('feedback_title', fn() => 'Контакты');
        return view('pages.contact', compact('title'));
    }

    public function feedbacks()
    {
        $title = Cache::rememberForever('feedback_title', fn() => 'Список обращений');
        return view('pages.feedbacks', compact('title'));
    }

    public function feedbacksCreate()
    {
        $title = Cache::rememberForever('feedback_title', fn() => 'Список обращений');
        return view('pages.feedbacks', compact('title'));
    }
}
