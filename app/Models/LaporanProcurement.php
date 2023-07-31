<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanProcurement extends Model
{
    use HasFactory;
    protected $table = "laporan_procurement";
    protected $primaryKey = "PR_SAP";
    public $timestamps = false;
    protected $fillable = [
        "PR_SAP",
        'PO_SAP',
        'tanggal_PO_SAP',
        'Material DRM',
        'Jasa DRM',
        'Total DRM',
        'Material Aktual',
        'Jasa Aktual',
        'Total Aktual',
        'status_tagihan_id',
        'PID_konstruksi_id',
        'PID_maintenance_id',
        'lokasi',
        'draft'
    ];


}
