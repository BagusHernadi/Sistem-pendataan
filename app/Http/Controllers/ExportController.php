<?php

namespace App\Http\Controllers;
use App\Exports\ResidentExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Resident;
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
       public function pdf()
    {
    
        
        $genderCount = [
            'Laki-laki' => Resident::where('gender', 'male')->count(),
            'Perempuan' => Resident::where('gender', 'female')->count(),
        ];

        $statusCount = [
            'Single' => Resident::where('marital_status', 'single')->count(),
            'Married' => Resident::where('marital_status', 'married')->count(),
            'Divorced' => Resident::where('marital_status', 'divorced')->count(),
            'Widowed' => Resident::where('marital_status', 'widowed')->count(),
        ];

        return Pdf::loadView('exports.resident-pdf', compact(   'genderCount', 'statusCount'))
                ->setPaper('a4', 'portrait')
                ->download('laporan_penduduk.pdf');
    }

    public function excel()
    {
        return Excel::download(new ResidentExport(), 'Residents.xlsx');
    }
}