<?php

namespace App\Http\Controllers;

use App\Exports\PermohonanFilterExport;
use App\Models\AccesUrlModel;
use App\Models\BparKabKotaModel;
use App\Models\CparJenisPermohonanModel;
use App\Models\CparPermohonanModel;
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
use Maatwebsite\Excel\Facades\Excel;


class LaporanController extends Controller
{
    public function index() {}

    public function permohonan()
    {
        $data = [
            'title' => "LAPORAN",
            'resultPermohonan' => CparJenisPermohonanModel::get()
        ];
        return view('private.laporan.view', $data);
    }

    public function getLapPermohonan(Request $r)
    {
        if (request()->ajax()) {
            list($tgl_awal, $tgl_akhir) = explode(' - ', $r->datesFilter);
            $id_jenis_permohonan = $r->id_jenis_permohonan;
            $status_permohonan = $r->status_permohonan;
            $id_kabkota = $r->id_kabkota;
            $tgl_awal = $tgl_awal;
            $tgl_akhir = $tgl_akhir;


            $kabkota = BparKabKotaModel::where('id_kabkota', $id_kabkota)->first();


            $resultPermohonan = PengajuanPermohonanModel::join('bpar_002_kabkota', function ($join) {
                $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')
                    ->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
            })
                ->leftJoin('tr_permohonan_002_validasi', function ($join) {
                    $join->on('tr_permohonan_002_validasi.id_permohonan_izin', '=', 'tr_permohonan.id_permohonan_izin');
                })
                ->leftJoin('bpar_badan_usaha', function ($join) {
                    $join->on('bpar_badan_usaha.id_badan_usaha', '=', 'tr_permohonan.id_badan_usaha');
                })
                ->where('status_permohonan', $status_permohonan)
                ->when($tgl_awal && $tgl_akhir, function ($query) use ($tgl_awal, $tgl_akhir) {
                    $query->whereBetween('tr_permohonan.tgl_kirim_permohonan', [$tgl_awal, $tgl_akhir]);
                })
                ->orderBy('tr_permohonan.tgl_kirim_permohonan', 'ASC');

            // Cek jika id_jenis_permohonan bukan 'All'
            if ($id_jenis_permohonan != 'All') {
                $resultPermohonan = $resultPermohonan
                    ->where('id_jenis_permohonan', $id_jenis_permohonan);
            }

            // Cek Semua peovinsi
            if ($id_kabkota != 'SEMUA') {
                $resultPermohonan = $resultPermohonan->where('tr_permohonan.kode_provinsi', $kabkota->kode_provinsi)
                    ->where('tr_permohonan.kode_kabkota', $kabkota->kode_kabkota);

                $kabkotaRow = $kabkota->nm_kabkota;
            } else {
                $kabkotaRow = 'SEMUA';
            }

            $data = [
                'status_permohonan' => $status_permohonan,
                'resultPermohonan' => $resultPermohonan = $resultPermohonan->get(),
                'ket' => [
                    'jenisPermohonan' => CparJenisPermohonanModel::where('id_jenis_permohonan', $id_jenis_permohonan)->first()->nm_jenis_permohonan ?? 'SEMUA PERMOHONAN',
                    'sttsPermohonan' => cek_status_permohonan($status_permohonan),
                    'kabkota' => $kabkotaRow,
                    'datePeriode' => cek_ddmmyy_v1($tgl_awal) . ' s/d ' . cek_ddmmyy_v1($tgl_akhir),

                    'jenisPermohonanFilter' => $id_jenis_permohonan,
                    'sttsPermohonanFilter' => $status_permohonan,
                    'id_kabkotaFilter' => $id_kabkota,
                    'dateFilter' => $r->datesFilter
                ]
            ];
            return view('private.laporan.getLapPermohonan', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }

    public function cetakPermohonanFilter(Request $r)
    {
        ini_set('memory_limit', '1024M'); // atau 2048M
        set_time_limit(3000); // waktu proses
        list($tgl_awal, $tgl_akhir) = explode(' - ', $r->tglFilter);
        $id_jenis_permohonan = $r->jenisPermohonan;
        $status_permohonan = $r->sttsPermohonan;
        $id_kabkota = $r->id_kabkotaFilter;
        $tgl_awal = $tgl_awal;
        $tgl_akhir = $tgl_akhir;


        $kabkota = BparKabKotaModel::where('id_kabkota', $id_kabkota)->first();


        $resultPermohonan = PengajuanPermohonanModel::join('bpar_002_kabkota', function ($join) {
            $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')
                ->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
        })
            ->leftJoin('tr_permohonan_002_validasi', function ($join) {
                $join->on('tr_permohonan_002_validasi.id_permohonan_izin', '=', 'tr_permohonan.id_permohonan_izin');
            })
            ->leftJoin('bpar_badan_usaha', function ($join) {
                $join->on('bpar_badan_usaha.id_badan_usaha', '=', 'tr_permohonan.id_badan_usaha');
            })
            ->where('status_permohonan', $status_permohonan)
            ->when($tgl_awal && $tgl_akhir, function ($query) use ($tgl_awal, $tgl_akhir) {
                $query->whereBetween('tr_permohonan.tgl_kirim_permohonan', [$tgl_awal, $tgl_akhir]);
            })
            ->orderBy('tr_permohonan.tgl_kirim_permohonan', 'ASC');

        // Cek jika id_jenis_permohonan bukan 'All'
        if ($id_jenis_permohonan != 'All') {
            $resultPermohonan = $resultPermohonan
                ->where('id_jenis_permohonan', $id_jenis_permohonan);
        }

        // Cek Semua peovinsi
        if ($id_kabkota != 'SEMUA') {
            $resultPermohonan = $resultPermohonan->where('tr_permohonan.kode_provinsi', $kabkota->kode_provinsi)
                ->where('tr_permohonan.kode_kabkota', $kabkota->kode_kabkota);

            $kabkotaRow = $kabkota->nm_kabkota;
        } else {
            $kabkotaRow = 'SEMUA';
        }

        $data = [
            'status_permohonan' => $status_permohonan,
            'resultPermohonan' => $resultPermohonan = $resultPermohonan->get(),
            'ket' => [
                'jenisPermohonan' => CparJenisPermohonanModel::where('id_jenis_permohonan', $id_jenis_permohonan)->first()->nm_jenis_permohonan ?? 'SEMUA PERMOHONAN',
                'sttsPermohonan' => cek_status_permohonan($status_permohonan),
                'kabkota' => $kabkotaRow,
                'datePeriode' => cek_ddmmyy_v1($tgl_awal) . ' s/d ' . cek_ddmmyy_v1($tgl_akhir),

                'jenisPermohonanFilter' => $id_jenis_permohonan,
                'sttsPermohonanFilter' => $status_permohonan,
                'id_kabkotaFilter' => $id_kabkota,
                'dateFilter' => $r->datesFilter
            ]
        ];


        // $pdf = PDF::setOptions([
        //     'isHtml5ParserEnabled' => true,
        //     'isRemoteEnabled' => true,
        //     'enable_remote' => true,
        //     'defaultFont' => 'sans-serif',
        //     //'chroot' => public_path('images/logo')
        // ])->loadview('private.laporan.cetakPermohonanFilter', $data)->setpaper('folio', 'landscape');
        // return $pdf->stream('permohonanFilter.pdf');
        echo  view('private.laporan.cetakPermohonanFilter', $data);
    }


    public function exportPermohonanFilter(Request $r)
    {

        $id_jenis_permohonan = $r->jenisPermohonan;
        $status_permohonan = $r->sttsPermohonan;
        $id_kabkota = $r->id_kabkotaFilter;
        $tanggalFilter = $r->tglFilter;


        $filters = [
            'id_jenis_permohonan' => $id_jenis_permohonan,
            'status_permohonan' => $status_permohonan,
            'id_kabkota' => $id_kabkota,
            'tanggalFilter' => $tanggalFilter
        ];


        return Excel::download(new PermohonanFilterExport($filters), 'permohonanExcelFilter.xlsx');
    }
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
