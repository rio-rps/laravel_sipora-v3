<?php

namespace App\Http\Controllers;

use App\Models\BparKabKotaModel;
use App\Models\CparJenisPermohonanModel;
use App\Models\KategoriModel;
use App\Models\MyModel;
use App\Models\PengajuanPermohonanModel;
use App\Models\PostModel;
use App\Models\UserAktivasiAkunModel;
use App\Models\UserDataAksesKabKotaModel;
use App\Models\UserLogModel;
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
                    //'kk' =>  BparKabKotaModel::get(),
                ];
                return view('private.layout.beranda', $data);
            } else  if (getLevel() == 3) {
                if (@empty(getIdBiodata())) {
                    return view('private.layout.content.beranda-client', ['session' => false]);
                } else {
                    $Mymodel = new MyModel();
                    $data = [
                        'draft' => $Mymodel->countPermohonanByStatus(1, getIdBiodata()),
                        'dikirim' => $Mymodel->countPermohonanByStatus(2, getIdBiodata()),
                        'diproses' => $Mymodel->countPermohonanByStatus(4, getIdBiodata()),
                        'diterima' => $Mymodel->countPermohonanByStatus(5, getIdBiodata()),
                        'ditolak' => $Mymodel->countPermohonanByStatus(3, getIdBiodata()),
                        'aksesKabkotaFirst' => null,
                        'countKabkota' => null,
                        'session' => true,
                        'Log' => UserLogModel::where('id_user', getIdUser())->orderBy('created_at', 'DESC')->limit(10)->get(),
                    ];
                    return view('private.layout.content.beranda-client', $data);
                }
            } else  if (getLevel() == 2) {
                // $user = getIdUser();

                // $aksesKabkota = UserDataAksesKabKotaModel::where('id_user', $user)->get();

                // $kabkota = BparKabKotaModel::whereIn('kode_provinsi', $aksesKabkota->pluck('kode_provinsi'))
                //     ->whereIn('kode_kabkota', $aksesKabkota->pluck('kode_kabkota'))
                //     ->orderBy('kode_kabkota', 'ASC')
                //     ->get();



                $data = [
                    // 'resultKabKota' => $kabkota,
                    'aksesKabkotaFirst' => null,
                    'countKabkota' => null,
                    //'kk' =>  BparKabKotaModel::get(),
                ];
                return view('private.layout.beranda', $data);
            }
        } else {
            return redirect('/login');
        }
    }

    public function show_grafik_tahunan(Request $r)
    {
        if ($r->ajax()) {

            //     $resultPermohonan = PengajuanPermohonanModel::from('tr_permohonan as p')
            //     ->leftJoin('cpar_permohonan_001_jenis_permohonan as j', 'j.id_jenis_permohonan', '=', 'p.id_jenis_permohonan')
            //     ->selectRaw('
            //     YEAR(p.tgl_kirim_permohonan) as tahun,
            //     p.id_jenis_permohonan,
            //     j.nm_jenis_permohonan,
            //     COUNT(CASE WHEN p.status_permohonan = 5 THEN 1 END) as jmlh_selesai
            // ')
            //     ->groupBy(
            //         DB::raw('YEAR(p.tgl_kirim_permohonan)'),
            //         'p.id_jenis_permohonan',
            //         'j.nm_jenis_permohonan'
            //     )
            //     ->orderBy('p.id_jenis_permohonan', 'ASC')
            //     ->orderBy(DB::raw('YEAR(p.tgl_kirim_permohonan)'), 'ASC')
            //     ->get()
            //     ->groupBy('nm_jenis_permohonan');

            $resultPermohonan = PengajuanPermohonanModel::from('cpar_permohonan_001_jenis_permohonan as j')
                ->leftJoin('tr_permohonan as p', 'p.id_jenis_permohonan', '=', 'j.id_jenis_permohonan')
                ->selectRaw('
                YEAR(p.tgl_kirim_permohonan) as tahun,
                j.id_jenis_permohonan,
                j.nm_jenis_permohonan,
                COUNT(CASE WHEN p.status_permohonan = 5 THEN 1 END) as jmlh_selesai
            ')
                ->groupBy(
                    DB::raw('YEAR(p.tgl_kirim_permohonan)'),
                    'j.id_jenis_permohonan',
                    'j.nm_jenis_permohonan'
                )
                ->orderBy('j.id_jenis_permohonan', 'ASC')
                ->orderBy(DB::raw('YEAR(p.tgl_kirim_permohonan)'), 'ASC')
                ->get()
                ->groupBy('nm_jenis_permohonan');


            $data = [
                'title_form' => 'GRAFIK PERTAHUN',
                'resultPermohonan' => $resultPermohonan
            ];
            return view('private.layout.data.grafik_tahunan', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }





    public function show_jenis_permohonan(Request $r)
    {
        if (Auth::user()) {

            if (getLevel() == 2) {
                $user = getIdUser();

                $aksesKabkota = UserDataAksesKabKotaModel::where('id_user', $user)->get();

                $kabkota = BparKabKotaModel::whereIn('kode_provinsi', $aksesKabkota->pluck('kode_provinsi'))
                    ->whereIn('kode_kabkota', $aksesKabkota->pluck('kode_kabkota'))
                    ->orderBy('kode_kabkota', 'ASC')
                    ->get();
            } else {
                $kabkota = BparKabKotaModel::get();
            }

            $tahun = $r->tahun;
            $jenisPermohonan = CparJenisPermohonanModel::get();
            $data = [
                //'title_form' => 'PERMOHONAN ' . $namakab . ' TAHUN ' . $tahun . ' (' . cek_status_permohonan($r->status) . ')',
                // 'resultJenisPermohonan' =>  $resultJenisPermohonan,
                // 'sttus_show' => $id_kabkota,
                'title_form' => "JENIS PERMOHONAN " . $tahun,
                'kabkotaAll' => $kabkota,
                'jenisPermohonan' => $jenisPermohonan,
                'tahun' => $tahun,
            ];
            return view('private.layout.data.view_jenis_permohonan', $data);
        } else {
            return redirect('/login');
        }
    }




    public function filter_monitoringAll(Request $r)
    {
        if (request()->ajax()) {
            $kabkota = BparKabKotaModel::where('id_kabkota', $r->id_kabkota)->first();

            $resultPermohonan =  PengajuanPermohonanModel::selectRaw(
                'id_jenis_permohonan,
                    COUNT(CASE WHEN status_permohonan = 2 THEN 1 END) as jmlh_masuk,
                    COUNT(CASE WHEN status_permohonan = 4 THEN 1 END) as jmlh_diproses,
                    COUNT(CASE WHEN status_permohonan = 5 THEN 1 END) as jmlh_selesai',
            )
                ->where('kode_provinsi', $kabkota->kode_provinsi)
                ->where('kode_kabkota', $kabkota->kode_kabkota)
                ->whereYear('tgl_kirim_permohonan', $r->tahun)
                ->groupBy('id_jenis_permohonan')
                ->orderBy('id_jenis_permohonan', 'ASC')
                ->get();


            $data = [
                'title_form' => $kabkota->nm_kabkota,
                'resultPermohonan' => $resultPermohonan,
                'tahunFilter' => $r->tahun,
                'kode_provinsi' => $kabkota->kode_provinsi,
                'kode_kabkota' => $kabkota->kode_kabkota,
            ];
            return view('private.layout.data.filter_monitoringAll', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function show_getDataGrafikDetailTahunan(Request $r)
    {
        if (request()->ajax()) {
            $donutData = PengajuanPermohonanModel::from('tr_permohonan as p')
                ->join('cpar_permohonan_002_permohonan as par', 'par.id_par_permohonan', '=', 'p.id_par_permohonan')
                ->selectRaw('
                par.nm_par_permohonan as name,
                COUNT(*) as y
            ')
                ->where('p.id_jenis_permohonan', $r->id)   // filter dari request / route
                ->whereYear('p.tgl_kirim_permohonan', $r->tahun)
                ->where('p.status_permohonan', 5)
                ->groupBy('par.nm_par_permohonan')
                ->get();

            $jenisPermohonan = CparJenisPermohonanModel::where('id_jenis_permohonan', $r->id)->first()->nm_jenis_permohonan;

            //dd($donutData);
            $data = [
                'title_form' => 'DETAIL GRAFIK',
                'donutData' => $donutData,
                'jenisPermohonan' => $jenisPermohonan
            ];
            return view('private.layout.data.modal_getDataGrafikDetailTahunan', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
