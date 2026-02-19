<?php

namespace App\Http\Controllers;

use App\Models\NPDModel;
use App\Models\PengajuanPermohonanModel;
use App\Models\ValidasiNPDModel;
use App\Models\ValidasiPermohonanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use PDF;


class ToolsController extends Controller
{
    public function ubahStatusKartuPengawas()
    {
        if (isAdmin() || isKabkota()) {
            $data = [
                'title' => 'DATA KARTU PENGAWAS',
            ];
            return view('private/tools/status_kartu_pengawas/view')->with($data);
        }
        abort(404);
    }

    function showKartuPengawas()
    {
        return  DataTables::of(ValidasiPermohonanModel::where('status_validasi', '5')
            ->get())
            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group"><a href="javascript:void(0)"  id="tombolModalForm" data-url="' . route('tools.editKartuPengawas', $row->id_validasi_permohonan) . '" title="Edit Data" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>';
                return $btn;
            })
            ->addColumn('perusahaan', function ($row) {
                return $row->JPermohonan->nm_perusahaan_personal;
            })
            ->addColumn('pimpinan', function ($row) {
                return $row->JPermohonan->nm_pimpinan_pemilik;
            })
            ->addColumn('status', function ($row) {
                return status_permohonan($row->status_validasi);
            })
            ->addColumn('tgl_proses', function ($row) {
                return cek_date_ddmmyyyy_his_v1($row->tgl_validasi_proses);
            })
            ->addColumn('tgl_disetujui', function ($row) {
                return cek_ddmmyy_v1($row->tgl_validasi_selesai);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function editKartuPengawas($id)
    {
        if (request()->ajax()) {
            $data = [
                'id' => $id,
                'title_form' => 'UBAH KARTU PENGAWAS',
            ];
            return view('private/tools/status_kartu_pengawas/formedit', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }

    public function updateKartuPengawas(Request $r, $id)
    {
        if (request()->ajax()) {
            $row = ValidasiPermohonanModel::where('id_validasi_permohonan', $id)->first();
            $validator = Validator::make($r->all(), [
                'status_validasi' => 'required',
            ], [
                'status_validasi.required' => 'Status Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                PengajuanPermohonanModel::where('id_permohonan_izin', $row->id_permohonan_izin)->update([
                    'status_permohonan' => $r->status_validasi,
                ]);

                ValidasiPermohonanModel::where('id_validasi_permohonan', $id)->update([
                    'status_validasi' => $r->status_validasi,
                ]);


                return response()->json(['success' => 'Data berhasil di Draft']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    // Status Proses

    // public function ubahStatusProses()
    // {
    //     $data = [
    //         'title' => 'DATA PROSES',
    //     ];
    //     return view('private/tools/status_proses/view')->with($data);
    // }




    // public function getModal_statusNPD_2viewFormEdit(Request $r)
    // {
    //     if (request()->ajax()) {
    //         $data = [
    //             'id' => $r->id_npd,
    //             'title_form' => 'UBAH STATUS NPD',
    //         ];
    //         return view('data.tools.status_npd.getModal_statusNPD_2viewFormEdit', $data);
    //     } else {
    //         exit('Maaf, request tidak dapat diproses');
    //     }
    // }



    // // ubah status SPJ
    // public function ubahStatusSPJ()
    // {
    //     $data = [
    //         'title' => 'DATA SPJ',
    //     ];
    //     return view('data/tools/status_spj/view')->with($data);
    // }

    // function statusSPJ_1showData()
    // {
    //     return  DataTables::of(ValidasiNPDModel::where('status_spj', 2)
    //         ->where('tahun', getTahunLogin())
    //         ->get())
    //         ->addColumn('action', function ($row) {
    //             $btn = '<div class="btn-group"><a href="javascript:void(0)" onclick="getModal_statusSPJ_2viewFormEdit(' . $row->id_spj . ')" title="Edit Data" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>';
    //             return $btn;
    //         })
    //         ->addColumn('SPJ', function ($row) {
    //             return $row->no_spj_kolom1 . '' . $row->no_spj_kolom2;
    //         })
    //         ->addColumn('status', function ($row) {
    //             return status_final($row->status_spj);
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }

    // public function getModal_statusSPJ_2viewFormEdit(Request $r)
    // {
    //     if (request()->ajax()) {
    //         $data = [
    //             'id' => $r->id_spj,
    //             'title_form' => 'UBAH STATUS SPJ',
    //         ];
    //         return view('data.tools.status_spj.getModal_statusSPJ_2viewFormEdit', $data);
    //     } else {
    //         exit('Maaf, request tidak dapat diproses');
    //     }
    // }

    // public function getModal_statusSPJ_3doSave(Request $r)
    // {
    //     if (request()->ajax()) {
    //         $validator = Validator::make($r->all(), [
    //             'status_spj' => 'required',
    //         ], [
    //             'status_spj.required' => 'Status Tidak Boleh Kosong',
    //         ]);


    //         if ($validator->fails()) {
    //             $errors = $validator->errors();
    //             return response()->json(['errors' => $errors], 422);
    //         } else {
    //             ValidasiNPDModel::where('id_spj', $r->id_spj)->update([
    //                 'status_spj' => $r->status_spj,
    //             ]);
    //             return response()->json(['success' => 'Data berhasil diubah']);
    //         }
    //     } else {
    //         exit('Maaf Tidak Dapat diproses...');
    //     }
    // }
}
