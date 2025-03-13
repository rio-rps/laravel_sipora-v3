<?php

namespace App\Http\Controllers;

use App\Models\AccesUrlModel;
use App\Models\CparTrayekModel;
use App\Models\MyModel;
use App\Models\PengajuanPermohonanModel;
use App\Models\TTDDokumenModel;
use App\Models\ValidasiPermohonanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use PDF;
use SimpleSoftwareIO\QrCode\Generator;


class LaporanController extends Controller
{
    // public function cetakpengajuanpermohonan($id)
    // {
    //     set_time_limit(3000);
    //     $row = PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first();
    //     $data = [
    //         'row' => $row,
    //     ];
    //     $pdf = PDF::setOptions([
    //         'isHtml5ParserEnabled' => true,
    //         'isRemoteEnabled' => true,
    //         'enable_remote' => true,
    //         'defaultFont' => 'sans-serif',
    //         'chroot' => public_path('images/logo')
    //     ])->loadview('private.laporan.permohonan', $data)->setpaper('folio', 'potrait');

    //     return $pdf->stream('permohonan.pdf');
    // }


    // public function qrcode($id)
    // {
    //     $row = ValidasiPermohonanModel::where('id_permohonan_izin', $id)->first();
    //     // if (empty($row)) {
    //     //     return redirect()->route()->with([
    //     //         'status' => 'Gagal',
    //     //         'message' => 'Belum Ada Data Kartu Pengawas',
    //     //         'icon' => 'success'
    //     //     ]);
    //     // }

    //     $qrcode = new Generator;




    //     $data = [
    //         'row' =>  $qrcode->size(500)->generate(request()->get('text=rio')),
    //     ];
    //     return view('private.laporan.qrcode', $data);

    //     // $pdf = PDF::setOptions([
    //     //     'isHtml5ParserEnabled' => true,
    //     //     'isRemoteEnabled' => true,
    //     //     'enable_remote' => true,
    //     //     'defaultFont' => 'sans-serif',
    //     //     'chroot' => public_path('images/logo')
    //     // ])->loadview('private.laporan.qrcode', $data)->setpaper('folio', 'potrait');

    //     // return $pdf->stream('permohonan.pdf');
    // }



    public function cetakKartuPengawas($id)
    {
        set_time_limit(3000);
        $id_permohonan_izin = Crypt::decrypt($id);

        $count = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin);
        if ($count->count() == 0) {
            return  "Belum di validasi";
        } else if ($count->first()->status_validasi != '5') {
            return  "Belum di validasi";
        }


        $cek = AccesUrlModel::where('access', 'qrcode')->first();

        if ($cek->status_actived == 1) {
            $url = $cek->url . 'kartucek/QRcode/' . $id;
        } else {
            $url = route('kartucek.QRcode', $id);
        }


        $row = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin)->first();
        $data = [
            'row' => $row,
            'trayek' => CparTrayekModel::where('id_trayek', $row->JPermohonan->id_trayek)->first(),
            'ttd' => TTDDokumenModel::where('kode_jabatan', '1')->first(),
            'QRcode' => $url
        ];
        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'enable_remote' => true,
            'defaultFont' => 'sans-serif',
            'chroot' => public_path('images/logo')
        ])->loadview('private.laporan.cetakKartuPengawas', $data)->setpaper('folio', 'potrait');

        return $pdf->stream('KartuPengawas.pdf');

        //     return view('private.laporan.cetakKartuPengawas', $data);
    }

    public function cetakKartuPengawasElektronik($id)
    {
        set_time_limit(3000);
        $id_permohonan_izin = Crypt::decrypt($id);
        $count = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin);
        if ($count->count() == 0) {
            return  "Belum di validasi";
        } else if ($count->first()->status_validasi != '5') {
            return  "Belum di validasi";
        }


        $cek = AccesUrlModel::where('access', 'qrcode')->first();

        if ($cek->status_actived == 1) {
            $url = $cek->url . 'kartucek/QRcode/' . $id;
        } else {
            $url = route('kartucek.QRcode', $id);
        }


        $row = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin)->first();
        $data = [
            'row' => $row,
            'trayek' => CparTrayekModel::where('id_trayek', $row->JPermohonan->id_trayek)->first(),
            'ttd' => TTDDokumenModel::where('kode_jabatan', '1')->first(),
            'QRcode' => $url
        ];
        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'enable_remote' => true,
            'defaultFont' => 'sans-serif',
            // 'chroot' => public_path('images/logo'),
            'chroot' => public_path('images/kartu')
        ])->loadview('private.laporan.cetakKartuPengawasElektronik', $data)->setpaper('folio', 'potrait');

        return $pdf->stream('cetakKartuPengawasElektronik.pdf');

        //return view('private.laporan.cetakKartuPengawasElektronik', $data);
    }

    public function cetakQRcode($id)
    {

        set_time_limit(3000);

        $id_permohonan_izin = Crypt::decrypt($id);
        $count = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin);
        if ($count->count() == 0) {
            return  "Belum di validasi";
        } else if ($count->first()->status_validasi != '5') {
            return  "Belum di validasi";
        }




        $cek = AccesUrlModel::where('access', 'qrcode')->first();

        if ($cek->status_actived == 1) {
            $url = $cek->url . 'kartucek/QRcode/' . $id;
        } else {
            $url = route('kartucek.QRcode', $id);
        }


        $row = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin)->first();
        $data = [
            'row' => $row,
            'trayek' => CparTrayekModel::where('id_trayek', $row->JPermohonan->id_trayek)->first(),
            'ttd' => TTDDokumenModel::where('kode_jabatan', '1')->first(),
            'QRcode' => $url
        ];
        $pdf = PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'enable_remote' => true,
            'defaultFont' => 'sans-serif',
            'chroot' => public_path('images/logo')
        ])->loadview('private.laporan.cetakQRcode', $data)->setpaper('folio', 'potrait');

        return $pdf->stream('QRcode.pdf');

        //return view('private.laporan.cetakKartuPengawas', $data);
    }
}
