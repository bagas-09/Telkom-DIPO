<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = "status";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_status'
    ];
    public static $rules = [
        'nama_status' => 'unique:status',
    ];

    public static $messages = [
        'nama_status.unique' => 'Nama Status sudah ada dalam database.',
    ];
}