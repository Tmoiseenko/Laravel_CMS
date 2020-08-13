<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedback()
    {
        $feedbacks = Feedback::get();
        $title = 'Обращения';

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
