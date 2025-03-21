<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BparKabKotaModel extends Model
{
    use HasFactory;
    public $table = "bpar_002_kabkota";
    protected $primarykey = "id_kabkota";
    protected $fillable = ['kode_provinsi', 'kode_kabkota', 'nm_kabkota'];
}
