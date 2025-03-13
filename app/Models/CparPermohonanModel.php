<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CparPermohonanModel extends Model
{
    use HasFactory;
    public $table = "cpar_permohonan_002_permohonan";
    protected $primarykey = "id_par_permohonan";
    protected $fillable = [
        'nm_par_permohonan', 'id_jenis_permohonan', 'status_actived'
    ];

    public function JCparJenisPermohonan()
    {
        return $this->belongsTo(CparJenisPermohonanModel::class, 'id_jenis_permohonan', 'id_jenis_permohonan');
    }
}
