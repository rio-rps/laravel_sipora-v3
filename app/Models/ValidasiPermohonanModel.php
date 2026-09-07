<?php

namespace App\Models;

use App\Http\Controllers\DataPermohonanController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidasiPermohonanModel extends Model
{
    use HasFactory;
    public $table = 'tr_permohonan_002_validasi';
    protected $primarykey = 'id_validasi_permohonan';
    protected $fillable = ['no_kartu_pengawas', 'tgl_sk', 'no_sk', 'tgl_awal', 'tgl_akhir', 'tgl_kir_awal', 'tgl_Kir_akhir', 'status_validasi', 'id_permohonan_izin', 'tgl_validasi_proses', 'tgl_validasi_selesai', 'ck_tgl_kir_awal_clear', 'ck_tgl_kir_akhir_clear'];

    public function JPermohonan()
    {
        return $this->belongsTo(PengajuanPermohonanModel::class, 'id_permohonan_izin', 'id_permohonan_izin');
    }
}
