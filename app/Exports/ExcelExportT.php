<?php

namespace App\Exports;
use App\Models\LaporanTiket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExportT implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'ID Tiket',
            'ID SAP',
            'Datek',
            'Status Pekerjaan',
            'Mitra',
            'Tipe Kemitraan',
            'Jenis Program',
            'Tipe Provisoning',
            'Periode Pekerjaan',
            'Lokasi',
            'Material DRM',
            'Jasa DRM',
            'Total DRM',
            'Material Aktual',
            'Jasa Aktual',
            'Total Aktual',
            'Keterangan',
            
        ];
    }

    public function query()
    {
        return LaporanTiket::query()
        ->join('status_pekerjaan', 'laporan_tiket.status_pekerjaan_id', '=', 'status_pekerjaan.id')
        ->join('mitra', 'laporan_tiket.mitra_id', '=', 'mitra.id')
        ->join('tipe_kemitraan', 'laporan_tiket.tipe_kemitraan_id', '=', 'tipe_kemitraan.id')
        ->join('jenis_program', 'laporan_tiket.jenis_program_id', '=', 'jenis_program.id')
        ->join('tipe_provisioning', 'laporan_tiket.tipe_provisioning_id', '=', 'tipe_provisioning.id')
            ->select(
                'laporan_tiket.ID_tiket',
                'laporan_tiket.ID_SAP_maintenance',
                'laporan_tiket.datek',
                'status_pekerjaan.nama_status_pekerjaan',
                'mitra.nama_mitra',
                'tipe_kemitraan.nama_tipe_kemitraan',
                'jenis_program.nama_jenis_program',
                'tipe_provisioning.nama_tipe_provisioning',
                'laporan_tiket.periode_pekerjaan',
                'laporan_tiket.lokasi',
                'laporan_tiket.material_DRM',
                'laporan_tiket.jasa_DRM',
                'laporan_tiket.total_DRM',
                'laporan_tiket.material_aktual',
                'laporan_tiket.jasa_aktual',
                'laporan_tiket.total_aktual',
                'laporan_tiket.keterangan',
                
            );
    }

    public function map($row): array
    {
        return [
            $row->ID_tiket,
            $row->ID_SAP_maintenance,
            $row->datek,
            $row->nama_status_pekerjaan,
            $row->nama_mitra,
            $row->nama_tipe_kemitraan,
            $row->nama_jenis_program,
            $row->nama_tipe_provisioning,
            $row->periode_pekerjaan,
            $row->lokasi,
            $row->material_DRM,
            $row->jasa_DRM,
            $row->total_DRM,
            $row->material_aktual,
            $row->jasa_aktual,
            $row->total_aktual,
            $row->keterangan,
            
        ];
    }
}