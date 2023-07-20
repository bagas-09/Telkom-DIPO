<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanCommerce extends Model
{
    use HasFactory;
    protected $table = "laporan_commerce";
    protected $primaryKey = "no_PO";
    public $timestamps = false;
    protected $fillable = [
        "no_PO",
        'tanggal_PO',
        'No_SP',
        'tanggal_SP',
        'TOC',
        'No_BAUT',
        'tanggal_BAUT',
        'NO_BAR',
        'tanggal_BAR',
        'NO_BAST',
        'tanggal_BAST',
        'material_aktual',
        'jasa_aktual',
        'total_aktual',
        'status_id',
        'PID_konstruksi_id',
        'PID_maintenance_id',
        'lokasi',
        'draft'
    ];


}
