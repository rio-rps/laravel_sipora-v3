<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CparKendaraanMerekModel extends Model
{
    use HasFactory;
    public $table = "cpar_kendaraan_001_merek_kendaraan";
    protected $primarykey = "id_merek_kendaraan";
    protected $fillable = [
        'nm_merek_kendaraan', 'slug_merek_kendaraan'
    ];
}
