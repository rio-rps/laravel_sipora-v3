<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPermohonanModel;
use App\Models\ValidasiPermohonanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KartuCekController extends Controller
{
    public function QRcode($id)
    {
        $id_permohonan_izin = Crypt::decrypt($id);
        $dt = PengajuanPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin)->first();
        $data = [
            'title' => "KARTU PENGAWAS",
            'row' => $dt,
            'row_validasi' => ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin)->first()
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
