<?php

namespace App\Http\Controllers;

use App\Models\BparKabKotaModel;
use App\Models\PengajuanPermohonanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MutasiPICController extends Controller
{
    public function index()
    {
        if (isAdmin()) {
            $data = [
                'title' => 'DATA KENDARAAN',
            ];
            return view('private.mutasi_pic.view')->with($data);
        }
        abort(404);
    }

    public function show(Request $r)
    {

        if (request()->ajax()) {
            $cari_status_permohonan = $r->cari_status_permohonan;
            $cari_field = $r->cari_field;
            $cari_data = $r->cari_data;
            $resultPermohonan = PengajuanPermohonanModel::select(
                'tr_permohonan.id_permohonan_izin as id_permhn',
                'tr_permohonan.*',
                'bpar_002_kabkota.*',
                'tr_permohonan_002_validasi.*',
                'bpar_badan_usaha.*'
            )
                ->join('bpar_002_kabkota', function ($join) {
                    $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')
                        ->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
                })
                ->leftJoin('tr_permohonan_002_validasi', function ($join) {
                    $join->on('tr_permohonan_002_validasi.id_permohonan_izin', '=', 'tr_permohonan.id_permohonan_izin');
                })
                ->leftJoin('bpar_badan_usaha', function ($join) {
                    $join->on('bpar_badan_usaha.id_badan_usaha', '=', 'tr_permohonan.id_badan_usaha');
                })
                ->where('status_permohonan', $cari_status_permohonan)
                ->where($cari_field, 'like', '%' . $cari_data . '%');
            $data = [
                'result' => $resultPermohonan->get(),
                'status_permohonan' => $cari_status_permohonan

            ];
            return view('private.mutasi_pic.show', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $row = PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first();
            $kabkota = BparKabKotaModel::where('kode_provinsi', $row->kode_provinsi)->where('kode_kabkota', $row->kode_kabkota)->first();

            $data = [
                'id' => $id,
                'title' => 'UBAH PIC',
                'nm_kabkota' => $kabkota->nm_kabkota,
            ];
            return view('private.mutasi_pic.formedit', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }

    public function update(Request $r, $id)
    {
        if (request()->ajax()) {
            $kabkota = BparKabKotaModel::where('id_kabkota', $r->id_kabkota)->first();
            $validator = Validator::make($r->all(), [
                'id_kabkota' => 'required',
            ], [
                'id_kabkota.required' => 'PIC baru Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                PengajuanPermohonanModel::where('id_permohonan_izin', $id)->update([
                    'kode_provinsi'   => $kabkota->kode_provinsi,
                    'kode_kabkota'  => $kabkota->kode_kabkota,
                ]);

                return response()->json(['success' => 'Data PIC berhasil diubah']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
