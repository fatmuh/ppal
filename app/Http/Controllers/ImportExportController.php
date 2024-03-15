<?php

namespace App\Http\Controllers;

use App\Exports\ExportKta;
use App\Exports\ExportKtaForImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function export() 
    {
        return Excel::download(new ExportKta, 'kta.xlsx');
    }

    public function exportImport() 
    {
        return Excel::download(new ExportKtaForImport, 'kta_import.xlsx');
    }
}
