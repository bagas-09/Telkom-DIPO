<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisProgram extends Model
{
    use HasFactory;
    protected $table = "jenis_program";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_jenis_program'
    ];
    public static $rules = [
        'nama_jenis_program' => 'unique:jenis_program',
    ];

    public static $messages = [
        'nama_jenis_program.unique' => 'Nama Jenis Program sudah ada dalam database.',
    ];
}