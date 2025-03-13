<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriDataPermohonanModel extends Model
{
    use HasFactory;
    public $table = "tr_permohonan_003_histori_data";
    protected $primarykey = "id_histori_data";
    protected $fillable = [
        'status_permohonan', 'keterangan_histori', 'id_permohonan_izin'
    ];
}
