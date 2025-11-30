<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataModel extends Model
{
    use HasFactory;
    public $table = "ddd_biodata";
    protected $primaryKey = "id_biodata";
    protected $fillable = [
        'id_badan_usaha',
        'nm_perusahaan_personal',
        'nm_pimpinan_pemilik',
        'email',
        'no_telp',
        'slug_biodata',
        'id_user',
        'alamat_biodata'
    ];


    public function BadanUsaha()
    {
        return $this->belongsTo(BparBadanUsahaModel::class, 'id_badan_usaha', 'id_badan_usaha');
    }

    public function dataKendaraan()
    {
        return $this->hasMany(DataKendaraanModel::class, 'id_biodata', 'id_biodata');
    }

    public function pengajuan()
    {
        return $this->hasMany(PengajuanPermohonanModel::class, 'id_biodata', 'id_biodata');
    }
}
