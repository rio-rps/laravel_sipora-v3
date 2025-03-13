<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CparJenisAngkutanModel extends Model
{
    use HasFactory;
    public $table = "cpar_angkutan_001_jenis_angkutan";
    protected $primarykey = "id_jenis_angkutan";
    protected $fillable = [
        'nm_jenis_angkutan'
    ];
}
