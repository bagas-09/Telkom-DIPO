<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $table = "program";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        'nama_program'
    ];
    public static $rules = [
        'nama_program' => 'unique:program',
    ];

    public static $messages = [
        'nama_program.unique' => 'Nama Program sudah ada dalam database.',
    ];
}
