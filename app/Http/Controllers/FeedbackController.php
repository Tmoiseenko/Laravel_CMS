<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class FeedbackController extends Controller
{
    public function feedback()
    {
        $feedbacks = Cache::tags(['feedbacks'])->remember('feedback_list', 3600, fn() => Feedback::all());
        $title = Cache::rememberForever('feedback_title', fn() => 'Обращения');
        return view('admin.feedbacks', compact('feedbacks', 'title'));
    }

    public function feedbackCreate()
    {
        $request = request();

        $validator = $this->validate($request, [
            'email' => 'required',
            'text' => 'required',
        ]);

        if (!is_array($validator)) {
            return redirect('/contact');
        }

        Feedback::create($request->all());

        return redirect('/admin/feedback');
    }
}
