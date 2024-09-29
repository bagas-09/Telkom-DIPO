<?php

namespace App\Exports;

use App\Models\LaporanProcurement;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExcelExportP implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'PR SAP',
            'PO SAP',
            'Tanggal PO SAP',
            'Material DRM',
            'Jasa DRM',
            'Total DRM',
            'Material Aktual',
            'Jasa Aktual',
            'Total Aktual',
            'Status Tagihan',
            'Keterangan',
            'ID Tiket',
            'ID SAP Konstruksi',
            'Lokasi',
            
        ];
    }

    public function query()
    {
        return LaporanProcurement::query()
        ->join('status_tagihan', 'laporan_procurement.status_tagihan_id', '=', 'status_tagihan.id')
            ->select(
                'laporan_procurement.PR_SAP',
                'laporan_procurement.PO_SAP',
                'laporan_procurement.tanggal_PO_SAP',
                'laporan_procurement.material_DRM',
                'laporan_procurement.jasa_DRM',
                'laporan_procurement.total_DRM',
                'laporan_procurement.material_aktual',
                'laporan_procurement.jasa_aktual',
                'laporan_procurement.total_aktual',
                'status_tagihan.nama_status_tagihan',
                'laporan_procurement.keterangan',
                'laporan_procurement.ID_SAP_konstruksi_id',
                'laporan_procurement.ID_tiket_id',
                'laporan_procurement.lokasi',
                
            );
    }

    public function map($row): array
    {
        return [
            $row->PR_SAP,
            $row->PO_SAP,
            $row->tanggal_PO_SAP,
            $row->material_DRM,
            $row->jasa_DRM,
            $row->total_DRM,
            $row->material_aktual,
            $row->jasa_aktual,
            $row->total_aktual,
            $row->nama_status_tagihan,
            $row->keterangan,
            $row->ID_SAP_konstruksi_id,
            $row->ID_tiket_id,
            $row->lokasi,
            
        ];
    }
}