<?php

namespace App\Http\Controllers;

use App\Models\DataUserModel;
use App\Models\PengajuanPermohonanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hostname;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class LayoutController extends Controller
{
    public function index(Request $request)
    {
        $comp = [
            'content' => view('public.content.content-beranda', [
                'title' => '',
            ]),
        ];
        return view('public.layout.main', $comp);
    }

    // action
    public function show_pencarian(Request $r)
    {
        if (request()->ajax()) {
            $cari_field = $r->cari_field;
            $cari_data = $r->cari_data;

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
                ->whereIn('tr_permohonan.status_permohonan', ['4', '5'])
                ->where($cari_field, $cari_data);


            $data = [
                'search' => $cari_data,
                'resultPermohonan' => $resultPermohonan = $resultPermohonan->get(),
            ];
            return view('public.content.content-search-show', $data);
            // echo "okeee";
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function mshow_detail($id)
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'LIHAT DATA',
                'row' => PengajuanPermohonanModel::Join('bpar_002_kabkota', function ($join) {
                    $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')
                        ->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
                })
                    ->where('id_permohonan_izin', $id)->first()
            ];
            return view('public.content.content-search-show-detail', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
