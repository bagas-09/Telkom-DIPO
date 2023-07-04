<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeProvisioning extends Model
{
    use HasFactory;
    protected $table = "tipe_provisioning";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_tipe_provisioning'
    ];
}