<?php

namespace App\Http\Controllers;

use App\Models\BparKabKotaModel;
use App\Models\PengajuanPermohonanModel;
use App\Models\UserDataAksesKabKotaModel;
use Illuminate\Http\Request;

class HistoriKartuPengawasController extends Controller
{
    public function index()
    {
        if (isAdmin() or isKabkota()) {
            if (getLevel() == 2) {
                $user = getIdUser();
                $aksesKabkota = UserDataAksesKabKotaModel::where('id_user', $user)->get();
                $kabkota = BparKabKotaModel::whereIn('kode_provinsi', $aksesKabkota->pluck('kode_provinsi'))->whereIn('kode_kabkota', $aksesKabkota->pluck('kode_kabkota'))->orderBy('kode_kabkota', 'ASC')->get();
            } else {
                $kabkota = null;
            }

            $data = [
                'title' => act('HistoriPengawas'),
                'status' => 5,
                'kabkota' => $kabkota,
            ];
            return view('private/histori_kartu_pengawas/view')->with($data);
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $r)
    {
        if (request()->ajax()) {
            $cari_field = $r->cari_field;
            $cari_data = $r->cari_data;

            if (getLevel() == 2) {
                $user = getIdUser();
                $aksesKabkota = UserDataAksesKabKotaModel::where('id_user', $user)->get();
            } else {
                $aksesKabkota = null;
            }

            $resultPermohonan = PengajuanPermohonanModel::join('bpar_002_kabkota', function ($join) {
                $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
            })
                ->leftJoin('tr_permohonan_002_validasi', function ($join) {
                    $join->on('tr_permohonan_002_validasi.id_permohonan_izin', '=', 'tr_permohonan.id_permohonan_izin');
                })
                ->leftJoin('bpar_badan_usaha', function ($join) {
                    $join->on('bpar_badan_usaha.id_badan_usaha', '=', 'tr_permohonan.id_badan_usaha');
                })
                ->when(getLevel() == 2, function ($query) use ($aksesKabkota) {
                    $query->whereIn('tr_permohonan.kode_provinsi', $aksesKabkota->pluck('kode_provinsi')->toArray())->whereIn('tr_permohonan.kode_kabkota', $aksesKabkota->pluck('kode_kabkota')->toArray());
                })
                ->where('tr_permohonan.status_permohonan', 5)
                ->where($cari_field, 'like', '%' . $cari_data . '%');
            //->where($cari_field, $cari_data);

            $data = [
                'resultPermohonan' => ($resultPermohonan = $resultPermohonan->get()),
            ];
            return view('private.histori_kartu_pengawas.show', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
