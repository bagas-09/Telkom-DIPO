<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKonstruksi extends Model
{
    use HasFactory;
    protected $table = "laporan_konstruksi";
    protected $primaryKey = "PID_konstruksi";
    public $timestamps = false;
    protected $fillable = [
        'PID_konstruksi', 'ID_SAP_konstruksi', 'NO_PR_konstruksi', 'tanggal_PR', 'status_pekerjaan_id', 
        'mitra_id', 'tipe_kemitraan_id', 'jenis_order_id', 'tipe_provisioning_id', 'lokasi', 'material_DRM', 'jasa_DRM',
        'total_DRM', 'material_aktual', 'jasa_aktual', 'total_aktual', 'keterangan', 'commerce','kota_id',
    ];
    public $incrementing = false;
}