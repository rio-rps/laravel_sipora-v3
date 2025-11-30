<?php

namespace App\Http\Controllers;

use App\Models\BparColorCardModel;
use App\Models\BparKabKotaModel;
use App\Models\PICModel;
use App\Models\UserDataAksesKabKotaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VmodalController extends Controller
{
    public function show_kabkota(Request $r)
    {
        if (request()->ajax()) {

            if (getLevel() == 2) {
                $user = getIdUser();
                $aksesKabkota = UserDataAksesKabKotaModel::where('id_user', $user)->get();
            } else {
                $aksesKabkota = null;
            }


            // if ($r->act == "lap_permohonan") {
            //     $ss = "";
            // } else {
            //     $ss = "";
            // }



            $data = [
                'act' => $r->act,
                'title_form' => 'PILIH DATA KAB/ KOTA',
                'result' =>  BparKabKotaModel::when(getLevel() == 2, function ($query) use ($aksesKabkota) {
                    $query->whereIn(
                        'kode_provinsi',
                        $aksesKabkota->pluck('kode_provinsi')->toArray()
                    )->whereIn(
                        'kode_kabkota',
                        $aksesKabkota->pluck('kode_kabkota')->toArray()
                    );
                })
                    ->get(),
                'countAksesKabKota' => $aksesKabkota
            ];
            return view('private.vmodal.show_kabkota', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }

    public function show_pic(Request $r)
    {
        if (request()->ajax()) {

            $data = [
                'act' => $r->act,
                'title_form' => 'DAFTAR PIC',
                'result' => DB::table('bpar_002_kabkota')
                    ->leftJoin('hhh_pic', function ($join) {
                        $join->on('bpar_002_kabkota.kode_provinsi', '=', 'hhh_pic.kode_provinsi')
                            ->on('bpar_002_kabkota.kode_kabkota', '=', 'hhh_pic.kode_kabkota');
                    })
                    ->select(
                        'bpar_002_kabkota.kode_provinsi',
                        'bpar_002_kabkota.kode_kabkota',
                        'bpar_002_kabkota.nm_kabkota',
                        'hhh_pic.*'
                    )
                    ->orderBy('bpar_002_kabkota.kode_provinsi', 'ASC')
                    ->orderBy('bpar_002_kabkota.kode_kabkota', 'ASC')
                    ->get()
            ];
            return view('private.vmodal.show_pic', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }



    public function bgCard($id)
    {
        if (request()->ajax()) {
            $row = BparColorCardModel::where('id_par_permohonan', $id)->first();
            $data = [
                'title_form' => 'Gambar Warna Background Kartu & Striker',
                'bgCard' => $row->color_card,
            ];
            return view('private.vmodal.bgCard', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
