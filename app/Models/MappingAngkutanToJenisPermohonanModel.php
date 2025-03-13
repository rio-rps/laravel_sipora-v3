<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingAngkutanToJenisPermohonanModel extends Model
{
    use HasFactory;
    public $table = "cpar_angkutan_002_mapping_jenis_angkutan_jenis_permohonan";
    protected $primarykey = "id_mapping_angkutan_jenis_permohonan";
    protected $fillable = [
        'id_jenis_angkutan', 'id_jenis_permohonan'
    ];

    public function JCparJenisAngkutan()
    {
        return $this->belongsTo(CparJenisAngkutanModel::class, 'id_jenis_angkutan', 'id_jenis_angkutan');
    }

    public function JCparJenisPermohonan()
    {
        return $this->belongsTo(CparJenisPermohonanModel::class, 'id_jenis_permohonan', 'id_jenis_permohonan');
    }
}
