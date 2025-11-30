<?php

namespace App\Http\Controllers;

use App\Models\BparKabKotaModel;
use App\Models\CparJenisPermohonanModel;
use App\Models\KategoriModel;
use App\Models\MyModel;
use App\Models\PostModel;
use App\Models\UserAktivasiAkunModel;
use App\Models\UserDataAksesKabKotaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{
    public function index()
    {
        //AktivasiAkunHelper();
        if (Auth::user()) {

            if (getLevel() == 1) {
                $data = [
                    'resultKabKota' => BparKabKotaModel::orderBy('kode_kabkota', 'ASC')->get(),
                    'aksesKabkotaFirst' => null,
                    'countKabkota' => null,
                ];
                return view('private.layout.beranda', $data);
            } else  if (getLevel() == 3) {
                $Mymodel = new MyModel();
                $data = [
                    'draft' => $Mymodel->countPermohonanByStatus(1, getIdBiodata()),
                    'dikirim' => $Mymodel->countPermohonanByStatus(2, getIdBiodata()),
                    'diproses' => $Mymodel->countPermohonanByStatus(4, getIdBiodata()),
                    'diterima' => $Mymodel->countPermohonanByStatus(5, getIdBiodata()),
                    'ditolak' => $Mymodel->countPermohonanByStatus(3, getIdBiodata()),
                    'aksesKabkotaFirst' => null,
                    'countKabkota' => null,
                ];
                return view('private.layout.content.beranda-client', $data);
            } else  if (getLevel() == 2) {
                $user = getIdUser();
                $row = UserDataAksesKabKotaModel::where('id_user', $user)->orderBy('kode_kabkota', 'ASC')->first();
                $aksesKabkotaFirst = BparKabKotaModel::where('kode_provinsi', $row->kode_provinsi)
                    ->where('kode_kabkota', $row->kode_kabkota)->first()->id_kabkota;

                $aksesKabkota = UserDataAksesKabKotaModel::where('id_user', $user)->get();

                $kabkota = BparKabKotaModel::whereIn('kode_provinsi', $aksesKabkota->pluck('kode_provinsi'))
                    ->whereIn('kode_kabkota', $aksesKabkota->pluck('kode_kabkota'))
                    ->orderBy('kode_kabkota', 'ASC')
                    ->get();

                $data = [
                    'aksesKabkotaFirst' => $aksesKabkotaFirst,
                    'resultKabKota' => $kabkota,
                    'countKabkota' => count($kabkota),
                ];
                return view('private.layout.beranda', $data);
            }
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
            $tahun = $r->tahun;
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

            $kk = BparKabKotaModel::get();
            $resultJenisPermohonan = CparJenisPermohonanModel::leftJoin('tr_permohonan as tp', function ($join) use ($id_kabkota, $status, $kode_provinsi, $kode_kabkota, $tahun) {
                $join->on('tp.id_jenis_permohonan', '=', 'cpar_permohonan_001_jenis_permohonan.id_jenis_permohonan')
                    ->whereRaw('tp.status_permohonan=?', [$status])
                    ->whereRaw('YEAR(tp.tgl_kirim_permohonan) = ?', [$tahun]);
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
                'title_form' => 'PERMOHONAN ' . $namakab . ' TAHUN ' . $tahun . ' (' . cek_status_permohonan($r->status) . ')',
                'resultJenisPermohonan' =>  $resultJenisPermohonan,
                'sttus_show' => $id_kabkota,
                'kk' => $kk
            ];
            return view('private.layout.data.view_jenis_permohonan', $data);
        } else {
            return redirect('/login');
        }
    }

    public function show_permohonan(Request $r)
    {
        if (!Auth::user()) {
            return redirect('/login');
        }

        $tahun = $r->tahun;
        $user = getIdUser(); // level 2

        // Akses Kab/Kota user
        $aksesKabkota = UserDataAksesKabKotaModel::where('id_user', $user)->get();
        $kabkota = BparKabKotaModel::whereIn('kode_provinsi', $aksesKabkota->pluck('kode_provinsi'))
            ->whereIn('kode_kabkota', $aksesKabkota->pluck('kode_kabkota'))
            ->orderBy('kode_kabkota', 'ASC')
            ->get();

        // Subquery permohonan
        $subquery = DB::table('tr_permohonan')
            ->selectRaw('
                kode_provinsi,
                kode_kabkota,
                COUNT(CASE WHEN status_permohonan = 2 THEN id_permohonan_izin END) as jmlh_masuk,
                COUNT(CASE WHEN status_permohonan = 4 THEN id_permohonan_izin END) as jmlh_diproses,
                COUNT(CASE WHEN status_permohonan = 5 THEN id_permohonan_izin END) as jmlh_selesai
            ')
            ->whereYear('tgl_kirim_permohonan', $tahun)
            ->groupBy('kode_provinsi', 'kode_kabkota');

        // Query utama
        $resultPermohonan = BparKabKotaModel::leftJoinSub($subquery, 'perm', function ($join) {
            $join->on('bpar_002_kabkota.kode_provinsi', '=', 'perm.kode_provinsi')
                ->on('bpar_002_kabkota.kode_kabkota', '=', 'perm.kode_kabkota');
        })
            ->select(
                'bpar_002_kabkota.*',
                DB::raw('COALESCE(perm.jmlh_masuk, 0) as jmlh_masuk'),
                DB::raw('COALESCE(perm.jmlh_diproses, 0) as jmlh_diproses'),
                DB::raw('COALESCE(perm.jmlh_selesai, 0) as jmlh_selesai')
            )
            ->when(getLevel() == 2, function ($query) use ($kabkota) {
                $query->whereIn(
                    'bpar_002_kabkota.kode_provinsi',
                    $kabkota->pluck('kode_provinsi')->toArray()
                )->whereIn(
                    'bpar_002_kabkota.kode_kabkota',
                    $kabkota->pluck('kode_kabkota')->toArray()
                );
            })

            ->orderBy('bpar_002_kabkota.kode_kabkota', 'ASC')
            ->get();

        $data = [
            'title_form' => 'MONITORING DATA PERMOHONAN TAHUN ' . $r->tahun,
            'resultPermohonan' => $resultPermohonan,
            'tahunFilter' => $tahun
        ];

        return view('private.layout.data.view_data_permohonan', $data);
    }
}
