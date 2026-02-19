<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKendaraanModel extends Model
{
    use HasFactory;
    public $table = "ddd_data_kendaraan";
    protected $primarykey = "id_kendaraan";
    protected $fillable = [
        'id_merek_kendaraan',
        'id_type_kendaraan',
        'nm_kendaraan',
        'plat_no_kendaraan',
        'daya_angkut_orang',
        'daya_angkut_barang',
        'thn_pembuatan',
        'no_rangka',
        'no_mesin',
        'id_biodata',
        'jenis_biodata',
        'id_biodata',
        'status_actived',
        'file_kir',
        'file_stnk',
        'warna_tnkb',
        'bahan_bakar',
        'nmr_faktur_jual_beli',
        'tgl_faktur_jual_beli'
    ];

    public function JkendaraanMerek()
    {
        return $this->belongsTo(CparKendaraanMerekModel::class, 'id_merek_kendaraan', 'id_merek_kendaraan');
    }

    public function JkendaraanType()
    {
        return $this->belongsTo(CparKendaraanTypeModel::class, 'id_type_kendaraan', 'id_type_kendaraan');
    }

    public function JBiodata()
    {
        return $this->belongsTo(BiodataModel::class, 'id_biodata', 'id_biodata');
    }
}
