<?php

namespace App\Exports;

use App\Models\LaporanKonstruksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExportK implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'PID',
            'ID SAP',
            'NO PR',
            'Tanggal PR',
            'Status Pekerjaan',
            'Mitra',
            'Tipe Kemitraan',
            'Jenis Order',
            'Tipe Provisoning',
            'Lokasi',
            'Material DRM',
            'Jasa DRM',
            'Total DRM',
            'Material Aktual',
            'Jasa Aktual',
            'Total Aktual',
            'Keterangan',
            'Created At',
            'Updated At',
            
        ];
    }

    public function query()
    {
        return LaporanKonstruksi::query()
        ->join('status_pekerjaan', 'laporan_konstruksi.status_pekerjaan_id', '=', 'status_pekerjaan.id')
        ->join('mitra', 'laporan_konstruksi.mitra_id', '=', 'mitra.id')
        ->join('tipe_kemitraan', 'laporan_konstruksi.tipe_kemitraan_id', '=', 'tipe_kemitraan.id')
        ->join('program', 'laporan_konstruksi.program_id', '=', 'program.id')
        ->join('tipe_provisioning', 'laporan_konstruksi.tipe_provisioning_id', '=', 'tipe_provisioning.id')
            ->select(
                'laporan_konstruksi.PID_konstruksi',
                'laporan_konstruksi.ID_SAP_konstruksi',
                'laporan_konstruksi.NO_PR_konstruksi',
                'laporan_konstruksi.tanggal_PR',
                'status_pekerjaan.nama_status_pekerjaan',
                'mitra.nama_mitra',
                'tipe_kemitraan.nama_tipe_kemitraan',
                'program.nama_program',
                'tipe_provisioning.nama_tipe_provisioning',
                'laporan_konstruksi.lokasi',
                'laporan_konstruksi.material_DRM',
                'laporan_konstruksi.jasa_DRM',
                'laporan_konstruksi.total_DRM',
                'laporan_konstruksi.material_aktual',
                'laporan_konstruksi.jasa_aktual',
                'laporan_konstruksi.total_aktual',
                'laporan_konstruksi.keterangan',
                'laporan_konstruksi.created_at',
                'laporan_konstruksi.updated_at',
                
            );
    }

    public function map($row): array
    {
        return [
            $row->PID_konstruksi,
            $row->ID_SAP_konstruksi,
            $row->NO_PR_konstruksi,
            $row->tanggal_PR,
            $row->nama_status_pekerjaan,
            $row->nama_mitra,
            $row->nama_tipe_kemitraan,
            $row->nama_program,
            $row->nama_tipe_provisioning,
            $row->lokasi,
            $row->material_DRM,
            $row->jasa_DRM,
            $row->total_DRM,
            $row->material_aktual,
            $row->jasa_aktual,
            $row->total_aktual,
            $row->keterangan,
            $row->created_at,
            $row->updated_at,
        ];
    }
}