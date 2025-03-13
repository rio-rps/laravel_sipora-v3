<?php

namespace App\Http\Controllers;

use App\Models\BiodataModel;
use App\Models\CparKendaraanMerekModel;
use App\Models\CparKendaraanTypeModel;
use App\Models\DataKendaraanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables as DataTables;

class DataKendaraanController extends Controller
{

    public function index()
    {
        $biodata = BiodataModel::where('id_user', getIdUser())->first();
        if ($biodata) {
            $data = [
                'title' => 'DATA KENDARAAN',
            ];
            return view('private/data_kendaraan/view')->with($data);
        } else {
            return redirect()->to('biodata');
        }
    }

    public function create()
    {
        if (request()->ajax()) {
            $biodata = BiodataModel::where('id_user', getIdUser())->first();
            $data = [
                'title_form' => 'FORM INPUT DATA BARU',
                'resultMerek' => CparKendaraanMerekModel::all(),
                'id_biodata' => $biodata->id_biodata
            ];
            return view('private.data_kendaraan.formadd', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function getTypeKendaraan(Request $r)
    {
        $data = CparKendaraanTypeModel::where('id_merek_kendaraan', $r->id_merek_kendaraan)->get();

        return response()->json($data);
    }

    public function store(Request $r)
    {
        if (request()->ajax()) {

            $validator = Validator::make($r->all(), [
                'id_merek_kendaraan' => 'required',
                'id_type_kendaraan' => 'required',
                'nm_kendaraan' => 'required',
                'plat_no_kendaraan' => 'required',
                // 'plat_no_kendaraan' => [
                //     'required',
                //     function ($attribute, $value, $fail) {
                //         $isUnique = DataKendaraanModel::where('plat_no_kendaraan', $value)
                //             ->count() === 0;
                //         if (!$isUnique) {
                //             $fail('Plat No kendaraan sudah ada');
                //         }
                //     }
                // ],
                'daya_angkut_orang' => 'required',
                'daya_angkut_barang' => 'required',
                'thn_pembuatan' => 'required',
                'no_rangka' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $isUnique = DataKendaraanModel::where('no_rangka', $value)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('No Rangka kendaraan sudah ada');
                        }
                    }
                ],
                'no_mesin' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $isUnique = DataKendaraanModel::where('no_mesin', $value)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('No Mesin kendaraan sudah ada');
                        }
                    }
                ],
            ], [
                'id_merek_kendaraan.required' => 'Nama Merek Kendaraan Tidak Boleh Kosong',
                'id_type_kendaraan.required' => 'Nama Type Kendaraan Tidak Boleh Kosong',
                'nm_kendaraan.required' => 'Nama Kendaraan Tidak Boleh Kosong',
                'plat_no_kendaraan.required' => 'Plat Kendaraan Tidak Boleh Kosong',
                'daya_angkut_orang.required' => 'Daya Angkut Orang Tidak Boleh Kosong',
                'daya_angkut_barang.required' => 'Daya Angkut Barang Tidak Boleh Kosong',
                'thn_pembuatan.required' => 'Tahun Pembuatan Tidak Boleh Kosong',
                'no_rangka.required' => 'Nomor Rangka Tidak Boleh Kosong',
                'no_mesin.required' => 'Nomor Mesin Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = DataKendaraanModel::create([
                    'id_merek_kendaraan'  => $r->id_merek_kendaraan,
                    'id_type_kendaraan'  => $r->id_type_kendaraan,
                    'nm_kendaraan'  => $r->nm_kendaraan,
                    'plat_no_kendaraan'  => $r->plat_no_kendaraan,
                    'daya_angkut_orang'  => str_replace(".", "", $r->daya_angkut_orang),
                    'daya_angkut_barang'  => str_replace(".", "", $r->daya_angkut_barang),
                    'thn_pembuatan'  => $r->thn_pembuatan,
                    'no_rangka'  => $r->no_rangka,
                    'no_mesin'  => $r->no_mesin,
                    'id_biodata'  => $r->id_biodata,
                    'status_actived'  => '1',
                ]);
                return response()->json(['success' => 'Data berhasil disimpan']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function show($id)
    {
        if (request()->ajax()) {
            return  DataTables::of(DataKendaraanModel::where('id_biodata', getIdBiodata())->get())
                ->addColumn('action', 'private.data_kendaraan.action')
                ->addColumn('merekType', function ($row) {
                    return $row->JkendaraanMerek->nm_merek_kendaraan . " / " . $row->JkendaraanType->nm_type_kendaraan;
                })
                // ->filterColumn('merekType', function ($query, $keyword) {
                //     $query->whereHas('JkendaraanMerek', function ($query) use ($keyword) {
                //         $query->where('nm_merek_kendaraan', 'like', "%{$keyword}%");
                //     });
                // })
                // ->filterColumn('merekType', function ($query, $keyword) {
                //     $query->whereHas('JkendaraanType', function ($query) use ($keyword) {
                //         $query->where('nm_type_kendaraan', 'like', "%{$keyword}%");
                //     });
                // })


                ->addColumn('angkut_orang', function ($row) {
                    return format_rupiah($row->daya_angkut_orang) . " Orang";
                })
                ->addColumn('angkut_barang', function ($row) {
                    return format_rupiah($row->daya_angkut_barang) . " Kg";
                })

                ->addColumn('status', function ($row) {
                    return status_actived($row->status_actived);
                })


                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function edit($id)
    {
        if (request()->ajax()) {
            $row = DataKendaraanModel::where('id_kendaraan', $id)->first();
            $data = [
                'id'  => $id,
                'row' => $row,
                'resultMerek' => CparKendaraanMerekModel::all(),
                'title_form' => 'FORM EDIT DATA',
            ];
            return view('private.data_kendaraan.formedit', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }


    public function update(Request $r, $id)
    {
        if (request()->ajax()) {

            $validator = Validator::make($r->all(), [
                'nm_kendaraan' => 'required',
                'plat_no_kendaraan' => 'required',
                // 'plat_no_kendaraan' => [
                //     'required',
                //     function ($attribute, $value, $fail) use ($id) {
                //         $isUnique = DataKendaraanModel::where('plat_no_kendaraan', $value)
                //             ->where('id_kendaraan', '!=', $id)
                //             ->count() === 0;
                //         if (!$isUnique) {
                //             $fail('Plat No kendaraan sudah ada');
                //         }
                //     }
                // ],
                'daya_angkut_orang' => 'required',
                'daya_angkut_barang' => 'required',
                'thn_pembuatan' => 'required',
                'no_rangka' => [
                    'required',
                    function ($attribute, $value, $fail) use ($id) {
                        $isUnique = DataKendaraanModel::where('no_rangka', $value)
                            ->where('id_kendaraan', '!=', $id)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('No Rangka kendaraan sudah ada');
                        }
                    }
                ],
                'no_mesin' => [
                    'required',
                    function ($attribute, $value, $fail) use ($id) {
                        $isUnique = DataKendaraanModel::where('no_mesin', $value)
                            ->where('id_kendaraan', '!=', $id)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('No Mesin kendaraan sudah ada');
                        }
                    }
                ],
            ], [
                'nm_kendaraan.required' => 'Nama Kendaraan Tidak Boleh Kosong',
                'plat_no_kendaraan.required' => 'Plat Kendaraan Tidak Boleh Kosong',
                'daya_angkut_orang.required' => 'Daya Angkut Orang Tidak Boleh Kosong',
                'daya_angkut_barang.required' => 'Daya Angkut Barang Tidak Boleh Kosong',
                'thn_pembuatan.required' => 'Tahun Pembuatan Tidak Boleh Kosong',
                'no_rangka.required' => 'Nomor Rangka Tidak Boleh Kosong',
                'no_mesin.required' => 'Nomor Mesin Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = DataKendaraanModel::where('id_kendaraan', $id)->update([
                    'nm_kendaraan'  => $r->nm_kendaraan,
                    'plat_no_kendaraan'  => $r->plat_no_kendaraan,
                    'daya_angkut_orang'  => str_replace(".", "", $r->daya_angkut_orang),
                    'daya_angkut_barang'  => str_replace(".", "", $r->daya_angkut_barang),
                    'thn_pembuatan'  => $r->thn_pembuatan,
                    'no_rangka'  => $r->no_rangka,
                    'no_mesin'  => $r->no_mesin,
                ]);
                return response()->json(['success' => 'Data berhasil diedit']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function destroyUploadKir($id)
    {
        if (request()->ajax()) {
            $row = DataKendaraanModel::where('id_kendaraan', $id)->first();
            $imagePath = public_path('upload/file_kendaraan') . '/' . $row->file_kir;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            DataKendaraanModel::where('id_kendaraan', $id)->update([
                'file_kir' => null
            ]);
            return response()->json([
                'success' => 'Data berhasil dihapus',
                'action' => 'uploadkendaraan'
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function destroyUploadSTNK($id)
    {
        if (request()->ajax()) {
            $row = DataKendaraanModel::where('id_kendaraan', $id)->first();
            $imagePath = public_path('upload/file_kendaraan') . '/' . $row->file_stnk;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            DataKendaraanModel::where('id_kendaraan', $id)->update([
                'file_stnk' => null
            ]);
            return response()->json([
                'success' => 'Data berhasil dihapus',
                'action' => 'uploadkendaraan'
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function createUpload($id)
    {
        if (request()->ajax()) {
            $row = DataKendaraanModel::where('id_kendaraan', $id)->first();
            $data = [
                'title_form' => 'DATA DOKUMEN',
                'kir' => $row->file_kir,
                'stnk' => $row->file_stnk,
                'row' => $row,
            ];
            return view('private.data_kendaraan.formupload', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function createUploadForm(Request $r)
    {
        if (request()->ajax()) {
            if ($r->jenis_dok == 5) {
                $f = 'file_kir';
            } else if ($r->jenis_dok == 6) {
                $f = 'file_stnk';
            }
            $cek = DataKendaraanModel::where('id_kendaraan', $r->id_kendaraan)->where($f, $r->jenis_dok)->count();

            $data = [
                'title_form' => 'FORM UPLOAD DOKUMEN',
                'jenis_dok' => $r->jenis_dok,
                'id' => $r->id_kendaraan,
                'action' => $cek
            ];
            return view('private.data_kendaraan.formuploadform', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function storeUpload(Request $r)
    {
        if (request()->ajax()) {

            if ($r->jenis_dok == 5) {
                $f = 'file_kir';
            } else if ($r->jenis_dok == 6) {
                $f = 'file_stnk';
            }


            $r->validate([
                'file_dokumen' =>  'required|file|mimes:pdf,docx,xlsx,pptx|max:10000',
            ], [
                'file_dokumen.required' => 'File Dokumen Tidak Boleh Kosong',
                'file_dokumen.mimes' => 'File Hanya di perbolehkan ekstensi pdf,docx,xlsx,pptx',
            ]);

            $file_name = "";
            if ($file = $r->file('file_dokumen')) {
                $file_path = public_path('upload/file_kendaraan');
                $file_ekstensi = $file->getClientOriginalExtension();
                $file_name = date('ymdhis') . "." . $file_ekstensi;
                $file->move($file_path, $file_name);
            }


            $post = DataKendaraanModel::where('id_kendaraan', $r->id_kendaraan)->update([
                '' . $f . ''   => $file_name,
            ]);
            if ($post = true) {
                return response()->json(['success' => 'Data berhasil diupload', 'action' => 'uploadkendaraan']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function showUploadDokumenKendaraan($id)
    {
        if (request()->ajax()) {

            $row = DataKendaraanModel::where('id_kendaraan', $id)->first();
            $data = [
                'row' => $row
            ];
            return view('private.data_kendaraan.data_upload', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function destroy($id)
    {
        if (request()->ajax()) {
            $row = DataKendaraanModel::where('id_kendaraan', $id)->first();

            if ($row) {
                // Hapus file KIR jika ada
                if ($row->file_kir) {
                    $imagePathKir = public_path('upload/file_kendaraan') . '/' . $row->file_kir;
                    if (file_exists($imagePathKir) && is_file($imagePathKir)) {
                        unlink($imagePathKir);
                    }
                }

                // Hapus file STNK jika ada
                if ($row->file_stnk) {
                    $imagePathStnk = public_path('upload/file_kendaraan') . '/' . $row->file_stnk;
                    if (file_exists($imagePathStnk) && is_file($imagePathStnk)) {
                        unlink($imagePathStnk);
                    }
                }

                // Hapus data dari database
                DataKendaraanModel::where('id_kendaraan', $id)->delete();

                return response()->json([
                    'success' => 'Data berhasil dihapus',
                ]);
            } else {
                return response()->json([
                    'error' => 'Data tidak ditemukan',
                ], 404);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
