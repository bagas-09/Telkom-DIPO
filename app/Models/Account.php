<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "account";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'name', 'nik', 'password', 'keterangan', 'role', 'id_nama_kota'
    ];
    protected $hidden = [
        'password',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'id_nama_kota');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_nama_kota');
    }
}
