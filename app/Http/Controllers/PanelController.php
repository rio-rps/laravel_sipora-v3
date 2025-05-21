<?php

namespace App\Http\Controllers;

use App\Models\BparKabKotaModel;
use App\Models\CparJenisPermohonanModel;
use App\Models\KategoriModel;
use App\Models\PostModel;
use App\Models\UserAktivasiAkunModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function index()
    {
        //AktivasiAkunHelper();
        if (Auth::user()) {
            $data = [
                'resultPermohonan' => BparKabKotaModel::leftJoin('tr_permohonan', function ($join) {
                    $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')
                        ->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
                })
                    ->selectRaw('bpar_002_kabkota.*, 
                COUNT(CASE WHEN tr_permohonan.status_permohonan = 2 THEN tr_permohonan.id_permohonan_izin END) as jmlh_masuk,
                COUNT(CASE WHEN tr_permohonan.status_permohonan = 4 THEN tr_permohonan.id_permohonan_izin END) as jmlh_diproses,
                COUNT(CASE WHEN tr_permohonan.status_permohonan = 5 THEN tr_permohonan.id_permohonan_izin END) as jmlh_selesai')
                    ->groupBy('bpar_002_kabkota.id_kabkota') // Pastikan untuk mengelompokkan berdasarkan kolom yang relevan
                    ->orderBy('bpar_002_kabkota.kode_kabkota', 'ASC')
                    // ->where('bpar_002_kabkota.id_kabkota', 18)
                    ->get(),
                'resultKabKota' => BparKabKotaModel::orderBy('kode_kabkota', 'ASC')->get()
            ];
            return view('private.layout.beranda', $data);
        } else {
            return redirect('/login');
        }
    }

    public function show_count_jenis_permohonan(Request $r)
    {
        if (Auth::user()) {
            $data = [
                'title_form' => 'JUMLAH JENIS PERMOHONAN',
                'result' => CparJenisPermohonanModel::all(),
            ];
            return view('private.layout.data.modal_count_jenis_permohonan', $data);
        } else {
            return redirect('/login');
        }
    }

    public function show_jenis_permohonan(Request $r)
    {
        if (Auth::user()) {
            $id_kabkota = $r->id_kabkota;
            $status = $r->status;
            if ($id_kabkota == 'All') {
                $kode_provinsi = '';
                $kode_kabkota = '';
                $namakab = 'SEMUA';
            } else {
                $kabkota = BparKabKotaModel::where('id_kabkota', $id_kabkota)->first();
                $kode_provinsi = $kabkota->kode_provinsi;
                $kode_kabkota = $kabkota->kode_kabkota;
                $namakab = $kabkota->nm_kabkota;
            }






            $resultJenisPermohonan = CparJenisPermohonanModel::leftJoin('tr_permohonan as tp', function ($join) use ($id_kabkota, $status, $kode_provinsi, $kode_kabkota) {
                $join->on('tp.id_jenis_permohonan', '=', 'cpar_permohonan_001_jenis_permohonan.id_jenis_permohonan')
                    ->whereRaw('tp.status_permohonan=?', [$status]);
                if ($id_kabkota != 'All') {
                    $join->whereRaw('tp.kode_provinsi = ?', [$kode_provinsi])
                        ->whereRaw('tp.kode_kabkota = ?', [$kode_kabkota]);
                }
            })
                ->selectRaw('
                cpar_permohonan_001_jenis_permohonan.nm_jenis_permohonan,  
                COALESCE(COUNT(tp.id_permohonan_izin), 0) AS total
            ')
                ->groupBy(
                    'cpar_permohonan_001_jenis_permohonan.id_jenis_permohonan',
                    'cpar_permohonan_001_jenis_permohonan.nm_jenis_permohonan'
                )
                ->get();



            $data = [
                'title_form' => 'PERMOHONAN ' . $namakab . ' (' . cek_status_permohonan($r->status) . ')',
                'resultJenisPermohonan' =>  $resultJenisPermohonan
            ];
            return view('private.layout.data.view_jenis_permohonan', $data);
        } else {
            return redirect('/login');
        }
    }
}
