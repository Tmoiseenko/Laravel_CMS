<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelExport implements FromView
{

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * @return View
     */
    public function view(): View
    {
        return view('emails.reports.total', [
            'data' => $this->data
        ]);
    }
}
