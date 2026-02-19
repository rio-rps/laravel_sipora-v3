<?php

namespace App\Http\Controllers;

use App\Exports\DataKendaraanExport;
use App\Exports\PermohonanFilterExport;
use App\Models\AccesUrlModel;
use App\Models\BparColorCardModel;
use App\Models\BparKabKotaModel;
use App\Models\CparJenisPermohonanModel;
use App\Models\CparPermohonanModel;
use App\Models\CparTrayekModel;
use App\Models\DataKendaraanModel;
use App\Models\MyModel;
use App\Models\PengajuanPermohonanModel;
use App\Models\TTDDokumenModel;
use App\Models\ValidasiPermohonanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use PDF;
use SimpleSoftwareIO\QrCode\Generator;
use Maatwebsite\Excel\Facades\Excel;
use Vinkla\Hashids\Facades\Hashids;

class LaporanController extends Controller
{
    public function index() {}

    public function permohonan()
    {
        if (isAdmin() || isKabkota()) {
            $data = [
                'title' => "LAPORAN PERMOHONAN",
                'resultPermohonan' => CparJenisPermohonanModel::get()
            ];
            return view('private.laporan.view_permohonan', $data);
        }
        abort(404);
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
                // ->when($tgl_awal && $tgl_akhir, function ($query) use ($tgl_awal, $tgl_akhir) {
                //     $query->whereBetween('tr_permohonan.tgl_kirim_permohonan', [$tgl_awal, $tgl_akhir]);
                // }) 

                ->when($tgl_awal && $tgl_akhir, function ($query) use ($tgl_awal, $tgl_akhir) {
                    $query->whereBetween('tr_permohonan.tgl_kirim_permohonan', [
                        Carbon::parse($tgl_awal)->startOfDay(),
                        Carbon::parse($tgl_akhir)->endOfDay()
                    ]);
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
            // ->when($tgl_awal && $tgl_akhir, function ($query) use ($tgl_awal, $tgl_akhir) {
            //     $query->whereBetween('tr_permohonan.tgl_kirim_permohonan', [$tgl_awal, $tgl_akhir]);
            // })
            ->when($tgl_awal && $tgl_akhir, function ($query) use ($tgl_awal, $tgl_akhir) {
                $query->whereBetween('tr_permohonan.tgl_kirim_permohonan', [
                    Carbon::parse($tgl_awal)->startOfDay(),
                    Carbon::parse($tgl_akhir)->endOfDay()
                ]);
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
                'dateFilter' => $r->datesFilter,
                'font_size' => $r->font_size,
                'font_family' => str_replace('+', ' ', urldecode($r->font_family))
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
        // $decoded = Hashids::decode($id);

        // if (!empty($decoded)) {
        //     $id_permohonan_izin = $decoded[0];
        // } else {
        //     try {
        //         // Jika gagal, coba decrypt pakai Crypt
        //         $id_permohonan_izin = Crypt::decrypt($id);
        //     } catch (\Exception $e) {
        //         // Jika Crypt juga gagal, bisa redirect atau abort
        //         return abort(404, 'ID tidak valid.');
        //     }
        // }


        $id_permohonan_izin = Crypt::decrypt($id);

        $count = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin);
        if ($count->count() == 0) {
            return  "Belum di validasi";
        } else if ($count->first()->status_validasi != '5') {
            return  "Belum di validasi";
        }
        $hashID = Hashids::encode($id_permohonan_izin);

        $cek = AccesUrlModel::where('access', 'qrcode')->first();

        if ($cek->status_actived == 1) {
            $url = $cek->url . 'kartucek/QRcode/' . $hashID;
        } else {
            $url = route('kartucek.QRcode', $hashID);
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

    public function cetakKartuPengawasElektronik($id) //  fitur non aktif
    {
        set_time_limit(3000);
        // $decoded = Hashids::decode($id);

        // if (!empty($decoded)) {
        //     $id_permohonan_izin = $decoded[0];
        // } else {
        //     try {
        //         // Jika gagal, coba decrypt pakai Crypt
        //         $id_permohonan_izin = Crypt::decrypt($id);
        //     } catch (\Exception $e) {
        //         // Jika Crypt juga gagal, bisa redirect atau abort
        //         return abort(404, 'ID tidak valid.');
        //     }
        // }


        $id_permohonan_izin = Crypt::decrypt($id);
        $count = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin);
        if ($count->count() == 0) {
            return  "Belum di validasi";
        } else if ($count->first()->status_validasi != '5') {
            return  "Belum di validasi";
        }

        $hashID = Hashids::encode($id_permohonan_izin);

        $cek = AccesUrlModel::where('access', 'qrcode')->first();

        if ($cek->status_actived == 1) {
            $url = $cek->url . 'kartucek/QRcode/' . $hashID;
        } else {
            $url = route('kartucek.QRcode', $hashID);
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

    public function cetakKartuPengawasElektronikV2($id)
    {
        $id_permohonan_izin = Crypt::decrypt($id);
        $count = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin);
        if ($count->count() == 0) {
            return  "Belum di validasi";
        } else if ($count->first()->status_validasi != '5') {
            return  "Belum di validasi";
        }

        $hashID = Hashids::encode($id_permohonan_izin);

        $cek = AccesUrlModel::where('access', 'qrcode')->first();

        if ($cek->status_actived == 1) {
            $url = $cek->url . 'kartucek/QRcode/' . $hashID;
        } else {
            $url = route('kartucek.QRcode', $hashID);
        }


        $row = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin)->first();
        $data = [
            'row' => $row,
            // 'trayek' => CparTrayekModel::where('id_trayek', $row->JPermohonan->id_trayek)->first(),
            //'ttd' => TTDDokumenModel::where('kode_jabatan', '1')->first(),
            'QRcode' => $url,
            'bgCard' => BparColorCardModel::where('id_par_permohonan', $row->JPermohonan->id_par_permohonan)->first()->color_card
        ];
        return view('private.laporan.kartuPengawas', $data);
    }


    public function cetakQRcode($id)
    {

        set_time_limit(3000);

        // $decoded = Hashids::decode($id);

        // if (!empty($decoded)) {
        //     $id_permohonan_izin = $decoded[0];
        // } else {
        //     try {
        //         // Jika gagal, coba decrypt pakai Crypt
        //         $id_permohonan_izin = Crypt::decrypt($id);
        //     } catch (\Exception $e) {
        //         // Jika Crypt juga gagal, bisa redirect atau abort
        //         return abort(404, 'ID tidak valid.');
        //     }
        // }


        $id_permohonan_izin = Crypt::decrypt($id);
        //$rowID = PengajuanPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin)->first();


        $count = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin);
        if ($count->count() == 0) {
            return  "Belum di validasi";
        } else if ($count->first()->status_validasi != '5') {
            return  "Belum di validasi";
        }
        $hashID = Hashids::encode($id_permohonan_izin);



        $cek = AccesUrlModel::where('access', 'qrcode')->first();

        if ($cek->status_actived == 1) {
            $url = $cek->url . 'kartucek/QRcode/' . $hashID;
        } else {
            $url = route('kartucek.QRcode', $hashID);
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


    // v2
    public function cetakSuratRekomendasiKepala($id)
    {
        set_time_limit(3000);
        // $decoded = Hashids::decode($id);

        // if (!empty($decoded)) {
        //     $id_permohonan_izin = $decoded[0];
        // } else {
        //     try {
        //         // Jika gagal, coba decrypt pakai Crypt
        //         $id_permohonan_izin = Crypt::decrypt($id);
        //     } catch (\Exception $e) {
        //         // Jika Crypt juga gagal, bisa redirect atau abort
        //         return abort(404, 'ID tidak valid.');
        //     }
        // }


        $id_permohonan_izin = Crypt::decrypt($id);

        $count = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin);
        if ($count->count() == 0) {
            return  "Belum di validasi";
        } else if ($count->first()->status_validasi != '5') {
            return  "Belum di validasi";
        }
        $hashID = Hashids::encode($id_permohonan_izin);

        $cek = AccesUrlModel::where('access', 'qrcode')->first();

        if ($cek->status_actived == 1) {
            $url = $cek->url . 'kartucek/QRcode/' . $hashID;
        } else {
            $url = route('kartucek.QRcode', $hashID);
        }


        $row = ValidasiPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin)->first();
        $data = [
            'row' => $row,
            'permohonan' => PengajuanPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin)->first(),
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
        ])->loadview('private.laporan.cetakSuratRekomendasiKepala', $data)->setpaper('folio', 'potrait');

        return $pdf->stream('Surat_Rekomendasi_kepala.pdf');

        //     return view('private.laporan.cetakKartuPengawas', $data);
    }

    public function cetak_info_QRcode($id)
    {
        dd('oke');
    }


    public function kendaraan()
    {
        if (isAdmin() || isKabkota()) {
            $data = [
                'title' => "LAPORAN KENDARAAN",
            ];
            return view('private.laporan.kendaraan.view', $data);
        }
        abort(404);
    }

    public function show_kendaraan(Request $r)
    {
        $stts = $r->stts_kendaraan;

        $result = DataKendaraanModel::when($stts != 0, function ($query) use ($stts) {
            $query->where('status_actived', $stts);
        })
            ->get()
            ->sortBy(fn($item) => $item->JBiodata->nm_perusahaan_personal ?? '');

        $data = [
            'resultKendaraan' => $result,
        ];
        return view('private.laporan.kendaraan.show', $data);
    }

    public function cetakKendaraanFilterPdf(Request $r)
    {
        ini_set('memory_limit', '1024M'); // atau 2048M
        set_time_limit(3000); // waktu proses 
        $stts = $r->stts_kendaraan;
        $result = DataKendaraanModel::when($stts != 0, function ($query) use ($stts) {
            $query->where('status_actived', $stts);
        })
            ->get()
            ->sortBy(fn($item) => $item->JBiodata->nm_perusahaan_personal ?? '');

        $data = [
            'stts_kendaraan' => $stts,
            'resultKendaraan' => $result,
        ];
        echo  view('private.laporan.kendaraan.show', $data);
    }

    public function exportKendaraanFilterExcel(Request $r)
    {
        ini_set('memory_limit', '1024M'); // atau 2048M
        set_time_limit(3000); // waktu proses 
        $stts = $r->stts_kendaraan;
        $result = DataKendaraanModel::when($stts != 0, function ($query) use ($stts) {
            $query->where('status_actived', $stts);
        })
            ->get()
            ->sortBy(fn($item) => $item->JBiodata->nm_perusahaan_personal ?? '');

        $filters = [
            'stts_kendaraan' => $stts,
            'resultKendaraan' => $result,
        ];

        return Excel::download(new DataKendaraanExport($filters), 'data_kendaraan.xlsx');
    }
}
