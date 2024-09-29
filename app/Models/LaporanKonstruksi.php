<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKonstruksi extends Model
{
    use HasFactory;
    protected $table = "laporan_konstruksi";
    protected $primaryKey = "ID_SAP_konstruksi";
    public $timestamps = true;
    protected $fillable = [
        'ID_SAP_konstruksi', 
        'PID_konstruksi', 
        'NO_PR_konstruksi', 
        'tanggal_PR', 
        'status_pekerjaan_id', 
        'mitra_id', 
        'tipe_kemitraan_id', 
        'program_id', 
        'tipe_provisioning_id', 
        'lokasi', 
        'material_DRM', 
        'jasa_DRM',
        'total_DRM', 
        'material_aktual', 
        'jasa_aktual', 
        'total_aktual', 
        'keterangan',
        'created_at',
        'updated_at', 
        'commerce',
        'procurement',
        'kota_id',
        'slugk',
        'draft'
    ];
    public $incrementing = false;
}