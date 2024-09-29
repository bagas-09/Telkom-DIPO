<?php

namespace App\Exports;
use App\Models\LaporanMaintenance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExportM implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID SAP',
            'PID',
            'NO PR',
            'Tanggal PR',
            'Keterangan',
            
        ];
    }

    public function query()
    {
        return LaporanMaintenance::query()
            ->select(
                'laporan_maintenance.ID_SAP_maintenance',
                'laporan_maintenance.PID_maintenance',
                'laporan_maintenance.NO_PR_maintenance',
                'laporan_maintenance.tanggal_PR',
                'laporan_maintenance.keterangan',
                
            );
    }

    public function map($row): array
    {
        return [
            $row->ID_SAP_maintenance,
            $row->PID_maintenance,
            $row->NO_PR_maintenance,
            $row->tanggal_PR,
            $row->keterangan,
            
        ];
    }
}