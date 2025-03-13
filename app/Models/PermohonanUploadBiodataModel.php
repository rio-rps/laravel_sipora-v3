<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanUploadBiodataModel extends Model
{
    use HasFactory;
    public $table = "tr_permohonan_004_upload_biodata";
    protected $primarykey = "id_upload_dok_permohonan";
    protected $fillable = [
        'jenis_dok', 'file_dokumen', 'id_biodata', 'id_permohonan_izin'
    ];
}
