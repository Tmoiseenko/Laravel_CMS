<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminReportsController extends Controller
{
    public function showReport($template)
    {
        return view('admin.reports.' . $template, compact('template'));
    }

    public function createReport()
    {
        $request = \request();
        dd($request->all());
    }
}
