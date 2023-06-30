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

    // public function role()
    // {
    //     return $this->belongsTo(Role::class, 'id');
    // }
}