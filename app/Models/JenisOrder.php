<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisOrder extends Model
{
    use HasFactory;
    protected $table = "jenis_order";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_jenis_order'
    ];
}
