<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = "role";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_role'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class, 'id_nama_kota');
    }
}
