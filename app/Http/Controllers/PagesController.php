<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about()
    {
        $title = 'О нас';

        return view('pages.about', compact('title'));
    }

    public function contact()
    {
        $title = 'Контакты';

        return view('pages.contact', compact('title'));
    }

    public function feedbacks()
    {
        $title = 'Список обращений';

        return view('pages.feedbacks', compact('title'));
    }

    public function feedbacksCreate()
    {
        $title = 'Список обращений';

        return view('pages.feedbacks', compact('title'));
    }
}
