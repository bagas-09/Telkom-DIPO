<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMaintenance extends Model
{
    use HasFactory;
    protected $table = "laporan_maintenance";
    protected $primaryKey = "PID_maintenance";
    public $timestamps = false;
    protected $fillable = [
        'PID',
        'ID SAP',
        'No PR',
        'Tanggal PR',
        'Status Pekerjaan',
        'Mitra',
        'Tipe Kemitraan',
        'Jenis Program',
        'Tipe Provisioning',
        'Periode Pekerjaan',
        'Lokasi',
        'Material DRM',
        'Jasa DRM',
        'Total DRM',
        'Material Aktual',
        'Jasa Aktual',
        'Total Aktual',
        'Keterangan',
        'commerce'
    ];

}
