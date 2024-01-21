<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;
    protected $table = "mitra";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_mitra', 'role'
    ];
    public static $rules = [
        'nama_mitra' => 'unique_with_role:mitra',
    ];

    public static $messages = [
        'nama_mitra.unique_with_role' => 'Kombinasi Nama Mitra dan Role sudah ada dalam database.',
    ];
}