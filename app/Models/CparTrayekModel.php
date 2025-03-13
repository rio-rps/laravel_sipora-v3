<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CparTrayekModel extends Model
{
    use HasFactory;
    public $table = "cpar_z001_trayek";
    protected $primarykey = "id_trayek";
    protected $fillable = [
        'nm_trayek', 'status_actived', 'slug_trayek', 'id_par_permohonan'
    ];

    public function JCparPermohonan()
    {
        return $this->belongsTo(CparPermohonanModel::class, 'id_par_permohonan', 'id_par_permohonan');
    }
}
