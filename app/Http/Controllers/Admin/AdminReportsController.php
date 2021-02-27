<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\TotalReportJob;
use App\Jobs\TotalReport;
use Illuminate\Http\Request;

class AdminReportsController extends Controller
{
    public function showReport($template)
    {
        return view('admin.reports.' . $template, compact('template'));
    }

    public function createReport(Request $request)
    {
        if (count($request->all()) > 2) {
            TotalReportJob::dispatch($request->all())->onQueue('reports');
            flash('Отчет будет сформирован в фоновом режиме и выслан на почту', 'info');
        } else {
            flash('Вы не выбрали данные для формирования отчета', 'danger');
        }

        return back();
    }
}
