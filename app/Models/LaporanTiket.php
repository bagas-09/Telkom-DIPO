<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTiket extends Model
{
    use HasFactory;
    protected $table = "laporan_tiket";
    protected $primaryKey = "ID_tiket";
    public $timestamps = true;
    public $incrementing = false;
    protected $fillable = [
        'ID_tiket',
        'ID_SAP_maintenance',
        'datek',
        'status_pekerjaan',
        'mitra',
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
        'created_at',
        'updated_at',
        'commerce',
        'procurement',
        'kota_id',
        'slugt',
        'draft'
    ];

}
