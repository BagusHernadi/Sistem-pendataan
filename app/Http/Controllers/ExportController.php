<?php

namespace App\Http\Controllers;

use App\Exports\ResidentExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Resident;

class ExportController extends Controller
{
    public function exportPdf()
    {
        $residents = Resident::latest()->get();

        $pdf = Pdf::loadView('exports.resident', [
            'residents' => $residents
        ]);

        return $pdf->download('Residents.pdf');
    }

    public function excel()
    {
        return Excel::download(new ResidentExport(), 'Residents.xlsx');
    }
}