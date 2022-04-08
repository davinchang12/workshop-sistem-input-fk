<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilaiTugasExport;

class NilaiTugasExportController extends Controller
{
    public function export() {
        return Excel::download(new NilaiTugasExport, 'nilaitugas.xlsx');
    }
}
