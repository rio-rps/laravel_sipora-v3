<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingMengangkutModel extends Model
{
    use HasFactory;
    public $table = "cpar_mengangkut_002_mapping";
    protected $primarykey = "id_mapping_mengangkut";
    protected $fillable = [
        'id_mengangkut', 'id_jenis_angkutan'
    ];

    public function JCparMengangkut()
    {
        return $this->belongsTo(CparMengangkutModel::class, 'id_mengangkut', 'id_mengangkut');
    }

    public function JCparJenisAngkutan()
    {
        return $this->belongsTo(CparJenisAngkutanModel::class, 'id_jenis_angkutan', 'id_jenis_angkutan');
    }
}
