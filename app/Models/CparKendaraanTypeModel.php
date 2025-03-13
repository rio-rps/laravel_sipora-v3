<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CparKendaraanTypeModel extends Model
{
    use HasFactory;
    public $table = "cpar_kendaraan_002_type_kendaraan";
    protected $primarykey = "id_type_kendaraan";
    protected $fillable = [
        'nm_type_kendaraan', 'id_merek_kendaraan', 'slug_type_kendaraan', 'status_actived'
    ];

    public function kendaraanMerek()
    {
        return $this->belongsTo(CparKendaraanMerekModel::class, 'id_merek_kendaraan', 'id_merek_kendaraan');
    }
}
