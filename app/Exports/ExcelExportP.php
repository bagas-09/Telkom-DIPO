<?php

namespace App\Exports;

use App\Models\LaporanProcurement;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExportP implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LaporanProcurement::all();
    }
    
}
