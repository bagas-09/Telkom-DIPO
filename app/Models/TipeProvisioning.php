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
        'nama_tipe_provisioning', 'role'
    ];
    public static $rules = [
        'nama_tipe_provisioning' => 'unique_with_role:tipe_provisioning',
    ];

    public static $messages = [
        'nama_tipe_provisioning.unique_with_role' => 'Kombinasi Nama Tipe Provisioning dan Role sudah ada dalam database.',
    ];
}