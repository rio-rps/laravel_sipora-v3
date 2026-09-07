<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPermohonanModel;
use App\Models\ValidasiPermohonanModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Vinkla\Hashids\Facades\Hashids;

class KartuCekController extends Controller
{
    public function QRcode($id)
    {
        // Coba decode dengan Hashids
        $decoded = Hashids::decode($id);
        if (!empty($decoded)) {
            $decodedId = $decoded[0];
        } else {
            try {
                // Jika gagal, coba decrypt pakai Crypt
                $decodedId = Crypt::decrypt($id);
            } catch (\Exception $e) {
                // Jika Crypt juga gagal, bisa redirect atau abort
                return abort(404, 'ID tidak valid.');
            }
        }

        //$id_permohonan_izin = Crypt::decrypt($id);
        $dt = PengajuanPermohonanModel::Join('bpar_002_kabkota', function ($join) {
            $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
        })
            ->where('id_permohonan_izin', $decodedId)
            ->first();

        $data = [
            'title' => 'INFORMASI KARTU PENGAWAS',
            'row' => $dt,
            'row_validasi' => ValidasiPermohonanModel::where('id_permohonan_izin', $decodedId)->first(),
        ];
        return view('private/kartu_cek/qrcode')->with($data);
    }

    public function NomorKartu()
    {
        $data = [
            'title' => 'CEK KARTU PENGAWAS',
        ];
        return view('private/kartu_cek/nomor_kartu')->with($data);
    }
}
