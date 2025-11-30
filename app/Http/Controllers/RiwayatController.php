<?php

namespace App\Http\Controllers;

use App\Models\BiodataModel;
use App\Models\DataKendaraanModel;
use App\Models\PengajuanPermohonanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function badanUsaha()
    {
        // 20 detik
        // $result = BiodataModel::query()
        //     ->withCount([
        //         'dataKendaraan as jml_kendaraan',
        //         'pengajuan as jml_masuk' => function ($q) {
        //             $q->where('status_permohonan', 2);
        //         },
        //         'pengajuan as jml_proses' => function ($q) {
        //             $q->where('status_permohonan', 4);
        //         },
        //         'pengajuan as jml_selesai' => function ($q) {
        //             $q->where('status_permohonan', 5);
        //         },
        //         'pengajuan as jml_tolak' => function ($q) {
        //             $q->where('status_permohonan', 3);
        //         },
        //     ])
        //     ->orderBy('created_at', 'ASC')
        //     ->get();

        // 18 detik
        // $result = BiodataModel::select(
        //     'ddd_biodata.*',
        //     DB::raw('(SELECT COUNT(*) 
        //           FROM ddd_data_kendaraan 
        //           WHERE ddd_data_kendaraan.id_biodata = ddd_biodata.id_biodata) AS jml_kendaraan'),
        //     DB::raw('(SELECT COUNT(*) 
        //           FROM tr_permohonan 
        //           WHERE tr_permohonan.id_biodata = ddd_biodata.id_biodata 
        //           AND status_permohonan = 2) AS jml_masuk'),
        //     DB::raw('(SELECT COUNT(*) 
        //           FROM tr_permohonan 
        //           WHERE tr_permohonan.id_biodata = ddd_biodata.id_biodata 
        //           AND status_permohonan = 4) AS jml_proses'),
        //     DB::raw('(SELECT COUNT(*) 
        //           FROM tr_permohonan 
        //           WHERE tr_permohonan.id_biodata = ddd_biodata.id_biodata 
        //           AND status_permohonan = 5) AS jml_selesai'),
        //     DB::raw('(SELECT COUNT(*) 
        //           FROM tr_permohonan 
        //           WHERE tr_permohonan.id_biodata = ddd_biodata.id_biodata 
        //           AND status_permohonan = 3) AS jml_tolak')
        // )
        //     ->orderBy('ddd_biodata.created_at', 'ASC')
        //     ->get();


        // 10 detik
        // $result = DB::table('ddd_biodata')
        //     ->select(
        //         'ddd_biodata.*',
        //         'bpar_badan_usaha.nm_badan_usaha',
        //         DB::raw('COUNT(DISTINCT ddd_data_kendaraan.id_kendaraan) AS jml_kendaraan'),
        //         DB::raw('SUM(CASE WHEN tr_permohonan.status_permohonan = 2 THEN 1 ELSE 0 END) AS jml_masuk'),
        //         DB::raw('SUM(CASE WHEN tr_permohonan.status_permohonan = 4 THEN 1 ELSE 0 END) AS jml_proses'),
        //         DB::raw('SUM(CASE WHEN tr_permohonan.status_permohonan = 5 THEN 1 ELSE 0 END) AS jml_selesai'),
        //         DB::raw('SUM(CASE WHEN tr_permohonan.status_permohonan = 3 THEN 1 ELSE 0 END) AS jml_tolak')
        //     )
        //     ->leftJoin('bpar_badan_usaha', 'bpar_badan_usaha.id_badan_usaha', '=', 'ddd_biodata.id_badan_usaha')
        //     ->leftJoin('ddd_data_kendaraan', 'ddd_data_kendaraan.id_biodata', '=', 'ddd_biodata.id_biodata')
        //     ->leftJoin('tr_permohonan', 'tr_permohonan.id_biodata', '=', 'ddd_biodata.id_biodata')
        //     ->groupBy('ddd_biodata.id_biodata')
        //     ->orderBy('ddd_biodata.created_at', 'ASC')
        //     ->get();


        // 7 detik 
        // $result = DB::table('ddd_biodata')
        //     ->select(
        //         'ddd_biodata.id_biodata',
        //         'ddd_biodata.created_at',
        //         'ddd_biodata.nm_perusahaan_personal',
        //         'ddd_biodata.nm_pimpinan_pemilik',
        //         'ddd_biodata.email',
        //         'ddd_biodata.no_telp',
        //         'ddd_biodata.alamat_biodata',
        //         'bpar_badan_usaha.nm_badan_usaha',
        //         DB::raw('COUNT(DISTINCT ddd_data_kendaraan.id_kendaraan) AS jml_kendaraan'),
        //         DB::raw('SUM(CASE WHEN tr_permohonan.status_permohonan = 2 THEN 1 ELSE 0 END) AS jml_masuk'),
        //         DB::raw('SUM(CASE WHEN tr_permohonan.status_permohonan = 4 THEN 1 ELSE 0 END) AS jml_proses'),
        //         DB::raw('SUM(CASE WHEN tr_permohonan.status_permohonan = 5 THEN 1 ELSE 0 END) AS jml_selesai'),
        //         DB::raw('SUM(CASE WHEN tr_permohonan.status_permohonan = 3 THEN 1 ELSE 0 END) AS jml_tolak')
        //     )
        //     ->leftJoin('bpar_badan_usaha', 'bpar_badan_usaha.id_badan_usaha', '=', 'ddd_biodata.id_badan_usaha')
        //     ->leftJoin('ddd_data_kendaraan', 'ddd_data_kendaraan.id_biodata', '=', 'ddd_biodata.id_biodata')
        //     ->leftJoin('tr_permohonan', 'tr_permohonan.id_biodata', '=', 'ddd_biodata.id_biodata')
        //     ->groupBy('ddd_biodata.id_biodata')
        //     ->orderBy('ddd_biodata.created_at', 'ASC')
        //     ->get();

        // 4 detik 
        // $result = DB::table('ddd_biodata')
        //     ->selectRaw("
        //         ddd_biodata.id_biodata,
        //         ddd_biodata.created_at,
        //         ddd_biodata.nm_perusahaan_personal,
        //         ddd_biodata.nm_pimpinan_pemilik,
        //         ddd_biodata.email,
        //         ddd_biodata.no_telp,
        //         ddd_biodata.alamat_biodata,
        //         bpar_badan_usaha.nm_badan_usaha,
        //         COUNT(DISTINCT ddd_data_kendaraan.id_kendaraan) AS jml_kendaraan,
        //         SUM(CASE WHEN tr_permohonan.status_permohonan = 2 THEN 1 ELSE 0 END) AS jml_masuk,
        //         SUM(CASE WHEN tr_permohonan.status_permohonan = 4 THEN 1 ELSE 0 END) AS jml_proses,
        //         SUM(CASE WHEN tr_permohonan.status_permohonan = 5 THEN 1 ELSE 0 END) AS jml_selesai,
        //         SUM(CASE WHEN tr_permohonan.status_permohonan = 3 THEN 1 ELSE 0 END) AS jml_tolak
        //     ")
        //     ->leftJoin('bpar_badan_usaha', 'bpar_badan_usaha.id_badan_usaha', '=', 'ddd_biodata.id_badan_usaha')
        //     ->leftJoin('ddd_data_kendaraan', 'ddd_data_kendaraan.id_biodata', '=', 'ddd_biodata.id_biodata')
        //     ->leftJoin('tr_permohonan', 'tr_permohonan.id_biodata', '=', 'ddd_biodata.id_biodata')
        //     ->groupBy('ddd_biodata.id_biodata')
        //     ->orderBy('ddd_biodata.created_at', 'ASC')
        //     ->get();


        // 3 detik 
        // subquery permohonan: hitung per id_biodata
        $permSub = DB::table('tr_permohonan')
            ->select(
                'id_biodata',
                DB::raw('SUM(CASE WHEN status_permohonan = 2 THEN 1 ELSE 0 END) AS jml_masuk'),
                DB::raw('SUM(CASE WHEN status_permohonan = 4 THEN 1 ELSE 0 END) AS jml_proses'),
                DB::raw('SUM(CASE WHEN status_permohonan = 5 THEN 1 ELSE 0 END) AS jml_selesai'),
                DB::raw('SUM(CASE WHEN status_permohonan = 3 THEN 1 ELSE 0 END) AS jml_tolak')
            )
            ->groupBy('id_biodata');

        // subquery kendaraan: hitung per id_biodata
        $kendSub = DB::table('ddd_data_kendaraan')
            ->select('id_biodata', DB::raw('COUNT(*) AS jml_kendaraan'))
            ->groupBy('id_biodata');

        // query utama
        $result = DB::table('ddd_biodata as b')
            ->leftJoinSub($kendSub, 'kd', function ($join) {
                $join->on('kd.id_biodata', '=', 'b.id_biodata');
            })
            ->leftJoinSub($permSub, 'pm', function ($join) {
                $join->on('pm.id_biodata', '=', 'b.id_biodata');
            })
            ->leftJoin('bpar_badan_usaha as bu', 'bu.id_badan_usaha', '=', 'b.id_badan_usaha')
            ->select(
                'b.id_biodata',
                'b.created_at',
                'b.nm_perusahaan_personal',
                'b.nm_pimpinan_pemilik',
                'b.email',
                'b.no_telp',
                'b.alamat_biodata',
                'bu.nm_badan_usaha',
                DB::raw('COALESCE(kd.jml_kendaraan,0) AS jml_kendaraan'),
                DB::raw('COALESCE(pm.jml_masuk,0) AS jml_masuk'),
                DB::raw('COALESCE(pm.jml_proses,0) AS jml_proses'),
                DB::raw('COALESCE(pm.jml_selesai,0) AS jml_selesai'),
                DB::raw('COALESCE(pm.jml_tolak,0) AS jml_tolak')
            )
            ->orderBy('b.created_at', 'ASC')
            ->get();



        $data = [
            'title' => 'DAFTAR DATA BADAN USAHA PT/ CV/ KOPERASI/ PERSONAL/ PERORANGAN',
            'result' => $result
        ];
        return view('private.riwayat.badan_usaha.view')->with($data);
    }

    public function badanUsaha_detail($id)
    {

        if (request()->ajax()) {

            // masuk
            $resultPermohonanMasuk = PengajuanPermohonanModel::join('bpar_002_kabkota', function ($join) {
                $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')
                    ->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
            })
                ->where('tr_permohonan.status_permohonan', 2)
                ->where('id_biodata', $id);

            // proses
            $resultPermohonanProses = PengajuanPermohonanModel::join('bpar_002_kabkota', function ($join) {
                $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')
                    ->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
            })
                ->leftJoin('tr_permohonan_002_validasi', function ($join) {
                    $join->on('tr_permohonan_002_validasi.id_permohonan_izin', '=', 'tr_permohonan.id_permohonan_izin');
                })
                ->where('tr_permohonan.status_permohonan', 4)
                ->where('id_biodata', $id);

            // selesai
            $resultPermohonanSelesai = PengajuanPermohonanModel::join('bpar_002_kabkota', function ($join) {
                $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')
                    ->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
            })
                ->leftJoin('tr_permohonan_002_validasi', function ($join) {
                    $join->on('tr_permohonan_002_validasi.id_permohonan_izin', '=', 'tr_permohonan.id_permohonan_izin');
                })
                ->where('tr_permohonan.status_permohonan', 5)
                ->where('id_biodata', $id);

            // TOLAK
            $resultPermohonanTolak = PengajuanPermohonanModel::join('bpar_002_kabkota', function ($join) {
                $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')
                    ->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
            })
                ->join('tr_permohonan_003_histori_data', function ($join) {
                    $join->on('tr_permohonan_003_histori_data.id_permohonan_izin', '=', 'tr_permohonan.id_permohonan_izin');
                })
                ->where('tr_permohonan.status_permohonan', 3)
                ->where('id_biodata', $id)
                ->select(
                    'tr_permohonan.*',
                    'bpar_002_kabkota.*',
                    'tr_permohonan_003_histori_data.created_at as histori_created_at',
                    'tr_permohonan_003_histori_data.keterangan_histori as keterangan_histori'
                );


            $data = [
                'title' => 'DETAIL DATA',
                'row' => BiodataModel::where('id_biodata', $id)->first(),
                'resultKendaraan' => DataKendaraanModel::where('id_biodata', $id)->orderBy('thn_pembuatan', 'ASC')->get(),
                'resultPermohonanMasuk' => $resultPermohonanMasuk = $resultPermohonanMasuk->get(),
                'resultPermohonanProses' => $resultPermohonanProses = $resultPermohonanProses->get(),
                'resultPermohonanSelesai' => $resultPermohonanSelesai = $resultPermohonanSelesai->get(),
                'resultPermohonanTolak' => $resultPermohonanTolak = $resultPermohonanTolak->get(),
            ];
            return view('private.riwayat.badan_usaha.show_detail', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function kendaraan()
    {
        $data = [
            'title' => 'CARI DATA KENDARAAN',
        ];
        return view('private.riwayat.kendaraan.view')->with($data);
    }

    public function cek_kendaraan(Request $r)
    {

        if (request()->ajax()) {
            $result =  DataKendaraanModel::leftJoin('ddd_biodata', 'ddd_data_kendaraan.id_biodata', '=', 'ddd_biodata.id_biodata')
                ->leftJoin('bpar_badan_usaha', 'bpar_badan_usaha.id_badan_usaha', '=', 'ddd_biodata.id_badan_usaha')
                ->leftJoin('cpar_kendaraan_001_merek_kendaraan', 'cpar_kendaraan_001_merek_kendaraan.id_merek_kendaraan', '=', 'ddd_data_kendaraan.id_merek_kendaraan')
                ->leftJoin('cpar_kendaraan_002_type_kendaraan', 'cpar_kendaraan_002_type_kendaraan.id_type_kendaraan', '=', 'ddd_data_kendaraan.id_type_kendaraan')
                ->where('ddd_data_kendaraan.' . $r->cari_field, 'like', '%' . $r->cari_data . '%')
                ->select('ddd_data_kendaraan.*', 'ddd_biodata.*', 'bpar_badan_usaha.nm_badan_usaha', 'cpar_kendaraan_001_merek_kendaraan.nm_merek_kendaraan', 'cpar_kendaraan_002_type_kendaraan.nm_type_kendaraan')
                ->get();
            $data = [
                'result' => $result,

            ];
            return view('private.riwayat.kendaraan.show', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
