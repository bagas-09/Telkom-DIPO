<?php

namespace App\Exports;
use App\Models\LaporanMaintenance;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExportM implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LaporanMaintenance::all();
    }
}
