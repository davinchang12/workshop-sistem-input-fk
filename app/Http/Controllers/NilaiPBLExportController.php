<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NilasPBLExport;

class NilaiPBLExportController extends Controller
{
    public function export() {
        return Excel::download(new NilasPBLExport, 'nilai.xlsx');
    }
}
