<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CparJenisPermohonanModel extends Model
{
    use HasFactory;
    public $table = "cpar_permohonan_001_jenis_permohonan";
    protected $primarykey = "id_jenis_permohonan";
    protected $fillable = [
        'nm_jenis_permohonan', 'alias_jenis_permohonan', 'status_actived'
    ];

    public function RelasiPermohonan()
    {
        return $this->hasMany(CparPermohonanModel::class, 'id_jenis_permohonan', 'id_jenis_permohonan');
    }
}
