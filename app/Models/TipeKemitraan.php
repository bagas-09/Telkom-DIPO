<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKemitraan extends Model
{
    use HasFactory;
    protected $table = "tipe_kemitraan";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_tipe_kemitraan', 'role'
    ];
    public static $rules = [
        'nama_tipe_kemitraan' => 'unique_with_role:tipe_kemitraan',
    ];

    public static $messages = [
        'nama_tipe_kemitraan.unique_with_role' => 'Kombinasi Nama Tipe Kemitraan dan Role sudah ada dalam database.',
    ];

    // public function role()
    // {
    //     return $this->belongsTo(Role::class, 'id');
    // }
}