<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TTDDokumenModel extends Model
{
    use HasFactory;
    public $table = "cpar_ttd_dokumen";
    protected $primarykey = "id_ttd_dok";
    protected $fillable = [
        'nm_ttd', 'pangkat_gol', 'nip_ttd', 'jabatan_ttd'
    ];
}
