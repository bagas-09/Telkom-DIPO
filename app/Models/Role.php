<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = "role";
    protected $primaryKey = "nama_role";
    public $timestamps = false;
    protected $fillable = [
        'nama_role'
    ];
    public $incrementing = false;
    public function accounts()
    {
        return $this->hasMany(Account::class, 'role');
    }
}
