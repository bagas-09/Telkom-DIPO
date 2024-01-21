<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTagihan extends Model
{
    use HasFactory;
    protected $table = "status_tagihan";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_status_tagihan'
    ];
    public static $rules = [
        'nama_status_tagihan' => 'unique:status_tagihan',
    ];

    public static $messages = [
        'nama_status_tagihan.unique' => 'Nama Status Tagihan sudah ada dalam database.',
    ];
}
