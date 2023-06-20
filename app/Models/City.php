<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = "city";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_city'
    ];
}