<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPermohonanModel extends Model
{
    use HasFactory;
    public $table = "tr_permohonan";
    protected $primarykey = "id_permohonan_izin";
    protected $fillable = [
        'id_jenis_permohonan',
        'id_par_permohonan',
        'id_trayek',
        'id_jenis_angkutan',
        'id_mengangkut',
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
        'id_badan_usaha',
        'nm_perusahaan_personal',
        'nm_pimpinan_pemilik',
        'alamat_biodata',
        'email',
        'no_telp',
        'tgl_kirim_permohonan',
        'status_permohonan',
        'file_kir',
        'file_stnk',
        'id_kendaraan_history',
        'kode_provinsi',
        'kode_kabkota'
    ];

    public function JkendaraanMerek()
    {
        return $this->belongsTo(CparKendaraanMerekModel::class, 'id_merek_kendaraan', 'id_merek_kendaraan');
    }

    public function JkendaraanType()
    {
        return $this->belongsTo(CparKendaraanTypeModel::class, 'id_type_kendaraan', 'id_type_kendaraan');
    }

    public function JjenisPermohonan()
    {
        return $this->belongsTo(CparJenisPermohonanModel::class, 'id_jenis_permohonan', 'id_jenis_permohonan');
    }
    public function JPermohonan()
    {
        return $this->belongsTo(CparPermohonanModel::class, 'id_par_permohonan', 'id_par_permohonan');
    }
    public function JjenisAngkutan()
    {
        return $this->belongsTo(CparJenisAngkutanModel::class, 'id_jenis_angkutan', 'id_jenis_angkutan');
    }
    public function Jtrayek()
    {
        return $this->belongsTo(CparTrayekModel::class, 'id_trayek', 'id_trayek');
    }
    public function jmengangkut()
    {
        return $this->belongsTo(CparMengangkutModel::class, 'id_mengangkut', 'id_mengangkut');
    }

    public function BadanUsaha()
    {
        return $this->belongsTo(BparBadanUsahaModel::class, 'id_badan_usaha', 'id_badan_usaha');
    }
}
