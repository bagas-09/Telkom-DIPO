<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPekerjaan extends Model
{
    use HasFactory;
    protected $table = "status_pekerjaan";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_status_pekerjaan', 'role'
    ];
    public static $rules = [
        'nama_status_pekerjaan' => 'unique_with_role:status_pekerjaan',
    ];

    public static $messages = [
        'nama_status_pekerjaan.unique_with_role' => 'Kombinasi Nama Status Pekerjaan dan Role sudah ada dalam database.',
    ];

    // public function role()
    // {
    //     return $this->belongsTo(Role::class, 'id');
    // }
}