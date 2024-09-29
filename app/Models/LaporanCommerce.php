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
    public $incrementing = false;
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
        'kota_id',
        'ID_SAP_konstruksi_id',
        'ID_tiket_id',
        'lokasi',
        'created_at',
        'updated_at',
        'draft',
        'tanggal',
        'slugc',
    ];


}
