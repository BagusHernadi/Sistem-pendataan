<?php

namespace App\Exports;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\FromCollection;

class ResidentExport implements FromCollection
{
    public function collection(){
        return Resident::all();
    }
}
