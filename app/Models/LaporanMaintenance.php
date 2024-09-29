<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMaintenance extends Model
{
    use HasFactory;
    protected $table = "laporan_maintenance";
    protected $primaryKey = "ID_SAP_maintenance";
    public $timestamps = true;
    public $incrementing = false;
    protected $fillable = [
        'ID SAP',
        'PID',
        'No PR',
        'Tanggal PR',
        'Keterangan',
        'created_at',
        'updated_at',
        'kota_id',
        'slugm',
    ];

}
