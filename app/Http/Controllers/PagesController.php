<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PagesController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function feedbacks()
    {
        return view('pages.feedbacks');
    }

    public function feedbacksCreate()
    {
        return view('pages.feedbacks');
    }
}
