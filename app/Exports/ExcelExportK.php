<?php

namespace App\Exports;

use App\Models\LaporanKonstruksi;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExportK implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LaporanKonstruksi::all();
    }
}
