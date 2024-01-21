<?php

namespace App\Exports;

use App\Models\LaporanCommerce;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExcelExportC implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Nomor PO',
            'Tanggal PO',
            'Nomor SP',
            'Tanggal SP',
            'TOC',
            'Nomor BAUT',
            'Tanggal BAUT',
            'Nomor BAR',
            'Tanggal BAR',
            'Nomor BAST',
            'Tanggal BAST',
            'Material Aktual',
            'Jasa Aktual',
            'Total Aktual',
            'Status',
            'ID SAP Konstruksi',
            'ID Tiket',
            'Lokasi',
            

        ];
    }

    public function query()
    {
        return LaporanCommerce::query()
        ->join('status', 'laporan_commerce.status_id', '=', 'status.id')
            ->select(
                'laporan_commerce.no_PO',
                'laporan_commerce.tanggal_PO',
                'laporan_commerce.No_SP',
                'laporan_commerce.tanggal_SP',
                'laporan_commerce.TOC',
                'laporan_commerce.No_BAUT',
                'laporan_commerce.tanggal_BAUT',
                'laporan_commerce.NO_BAR',
                'laporan_commerce.tanggal_BAR',
                'laporan_commerce.NO_BAST',
                'laporan_commerce.tanggal_BAST',
                'laporan_commerce.material_aktual',
                'laporan_commerce.jasa_aktual',
                'laporan_commerce.total_aktual',
                'status.nama_status',
                'laporan_commerce.ID_SAP_konstruksi_id',
                'laporan_commerce.ID_tiket_id',
                'laporan_commerce.lokasi',
                
            );
    }

    public function map($row): array
    {
        return [
            $row->no_PO,
            $row->tanggal_PO,
            $row->No_SP,
            $row->tanggal_SP,
            $row->TOC,
            $row->No_BAUT,
            $row->tanggal_BAUT,
            $row->NO_BAR,
            $row->tanggal_BAR,
            $row->NO_BAST,
            $row->tanggal_BAST,
            $row->material_aktual,
            $row->jasa_aktual,
            $row->total_aktual,
            $row->nama_status,
            $row->ID_SAP_konstruksi_id,
            $row->ID_tiket_id,
            $row->lokasi,
            
        ];
    }
}