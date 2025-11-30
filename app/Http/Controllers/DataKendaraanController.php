<?php

namespace App\Http\Controllers;

use App\Models\BiodataModel;
use App\Models\CparKendaraanMerekModel;
use App\Models\CparKendaraanTypeModel;
use App\Models\DataKendaraanModel;
use App\Models\UserLogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables as DataTables;

class DataKendaraanController extends Controller
{

    public function index()
    {
        if (getLevel() == 3) {
            if (in_array(getSttsUser(), ['2', '3', '4'])) {
                return redirect()->to('panel');
            }
        }

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
            //  'nullable',

            $tgl_faktur_jual_beli = \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_faktur_jual_beli)->format('Y-m-d');

            $validator = Validator::make($r->all(), [
                'id_merek_kendaraan' => 'required',
                'id_type_kendaraan' => 'required',
                'nm_kendaraan' => 'required',
                'plat_no_kendaraan' => [
                    'required',    //  'nullable',
                    function ($attribute, $value, $fail) {
                        // Anggap "-" juga sebagai kosong, jadi tidak dicek duplikat
                        if (trim($value) !== '' && $value !== '-') {
                            $isUnique = DataKendaraanModel::where('plat_no_kendaraan', $value)->doesntExist();
                            if (!$isUnique) {
                                $fail('Plat No kendaraan sudah dipakai/ sudah ada.');
                            }
                        }
                    },
                ],
                'no_rangka' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $isUnique = DataKendaraanModel::where('no_rangka', $value)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('No Rangka kendaraan sudah dipakai/ sudah ada');
                        }
                    }
                ],
                'no_mesin' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $isUnique = DataKendaraanModel::where('no_mesin', $value)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('No Mesin kendaraan sudah dipakai/sudah ada');
                        }
                    }
                ],
                'warna_tnkb' => 'required',
                'bahan_bakar' => 'required',
                'daya_angkut_orang' => 'required',
                'daya_angkut_barang' => 'required',
                'thn_pembuatan' => 'required',

            ], [
                'id_merek_kendaraan.required' => 'Nama Merek Kendaraan Tidak Boleh Kosong',
                'id_type_kendaraan.required' => 'Nama Type Kendaraan Tidak Boleh Kosong',
                'nm_kendaraan.required' => 'Nama Kendaraan Tidak Boleh Kosong',
                'plat_no_kendaraan.required' => 'Plat Kendaraan Tidak Boleh Kosong',
                'warna_tnkb.required' => 'Warna TNKB Tidak Boleh Kosong',
                'bahan_bakar.required' => 'Bahan Bakar Tidak Boleh Kosong',
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
                    'warna_tnkb'  => $r->warna_tnkb,
                    'bahan_bakar'  => $r->bahan_bakar,
                    'nmr_faktur_jual_beli'  => $r->nmr_faktur_jual_beli,
                    'tgl_faktur_jual_beli'  => $tgl_faktur_jual_beli,
                    'status_actived'  => '1',
                ]);

                $ids =  getIdUser();
                UserLogModel::create([
                    'id_user' => $ids,
                    'aktivitas' => 'Melengkapi Data kendaraan ' . $r->plat_no_kendaraan . '/' . $r->nm_kendaraan . ' (Create).',
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
                //->addColumn('action', 'private.data_kendaraan.action')
                ->addColumn('action', function ($model) {
                    return view('private.data_kendaraan.action', compact('model'))->render();
                })
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

                ->rawColumns(['action'])
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
            $nmr_faktur = $r->nmr_faktur_jual_beli;
            $tgl_faktur = $r->tgl_faktur_jual_beli;

            if ($nmr_faktur) {
                $nmr_faktur_jual_beli = $r->nmr_faktur_jual_beli;
            } else {
                $nmr_faktur_jual_beli = null;
            }

            if ($tgl_faktur) {
                $tgl_faktur_jual_beli =  \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_faktur_jual_beli)->format('Y-m-d');;
            } else {
                $tgl_faktur_jual_beli = null;
            }


            $validator = Validator::make($r->all(), [
                'nm_kendaraan' => 'required',
                'plat_no_kendaraan' => 'required',

                'plat_no_kendaraan' => [
                    'required',
                    function ($attribute, $value, $fail) use ($id) {
                        if (trim($value) !== '' && $value !== '-') {
                            $isUnique = DataKendaraanModel::where('plat_no_kendaraan', $value)
                                ->where('id_kendaraan', '!=', $id) // <-- abaikan data milik sendiri
                                ->doesntExist();

                            if (!$isUnique) {
                                $fail('Plat No kendaraan sudah dipakai/ sudah ada.');
                            }
                        }
                    },
                ],
                'no_rangka' => [
                    'required',
                    function ($attribute, $value, $fail) use ($id) {
                        $isUnique = DataKendaraanModel::where('no_rangka', $value)
                            ->where('id_kendaraan', '!=', $id)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('No Rangka kendaraan sudah dipakai/ sudah ada');
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
                            $fail('No Mesin kendaraan sudah dipakai/ sudah ada');
                        }
                    }
                ],
                'warna_tnkb' => 'required',
                'bahan_bakar' => 'required',
                'daya_angkut_orang' => 'required',
                'daya_angkut_barang' => 'required',
                'thn_pembuatan' => 'required',
            ], [
                'nm_kendaraan.required' => 'Nama Kendaraan Tidak Boleh Kosong',
                'plat_no_kendaraan.required' => 'Plat Kendaraan Tidak Boleh Kosong',
                'no_rangka.required' => 'Nomor Rangka Tidak Boleh Kosong',
                'no_mesin.required' => 'Nomor Mesin Tidak Boleh Kosong',
                'warna_tnkb.required' => 'Warna TNKB Tidak Boleh Kosong',
                'bahan_bakar.required' => 'Bahan Bakar Tidak Boleh Kosong',
                'daya_angkut_orang.required' => 'Daya Angkut Orang Tidak Boleh Kosong',
                'daya_angkut_barang.required' => 'Daya Angkut Barang Tidak Boleh Kosong',
                'thn_pembuatan.required' => 'Tahun Pembuatan Tidak Boleh Kosong',

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
                    'warna_tnkb'  => $r->warna_tnkb,
                    'bahan_bakar'  => $r->bahan_bakar,
                    'nmr_faktur_jual_beli'  => $nmr_faktur_jual_beli,
                    'tgl_faktur_jual_beli'  => $tgl_faktur_jual_beli,
                ]);

                $ids =  getIdUser();
                UserLogModel::create([
                    'id_user' => $ids,
                    'aktivitas' => 'Melengkapi Data kendaraan ' . $r->plat_no_kendaraan . '/' . $r->nm_kendaraan . ' (Update).',
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

            $row = DataKendaraanModel::where('id_kendaraan', $id)->first();
            $ids =  getIdUser();
            UserLogModel::create([
                'id_user' => $ids,
                'aktivitas' => 'Hapus Dokumen Kendaraan Berhasil ' . $row->plat_no_kendaraan . '/' . $row->nm_kendaraan . ' (file_kir) (Destroy).',
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

            $row = DataKendaraanModel::where('id_kendaraan', $id)->first();
            $ids =  getIdUser();
            UserLogModel::create([
                'id_user' => $ids,
                'aktivitas' => 'Hapus Dokumen Kendaraan Berhasil ' . $row->plat_no_kendaraan . '/' . $row->nm_kendaraan . ' (file_stnk) (Destroy).',
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

    public function storeUpload(Request $request)
    {
        if ($request->ajax()) {

            // Validasi awal Laravel
            $request->validate([
                'file_dokumen' => 'required|file|max:500|mimes:pdf,docx,xlsx,pptx',
            ], [
                'file_dokumen.required' => 'File Dokumen tidak boleh kosong.',
                'file_dokumen.mimes' => 'File hanya diperbolehkan pdf, docx, xlsx, pptx.',
                'file_dokumen.max' => 'Ukuran file maksimal 500kb.',
            ]);

            if ($request->hasFile('file_dokumen')) {
                $file = $request->file('file_dokumen');

                // 1. Validasi MIME asli
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $realMime = finfo_file($finfo, $file->getPathname());
                finfo_close($finfo);

                $allowedMime = [
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                ];

                if (!in_array($realMime, $allowedMime)) {
                    return response()->json(['error' => 'Tipe MIME file tidak diizinkan.'], 422);
                }

                // 2. Validasi ekstensi asli
                $extension = strtolower($file->getClientOriginalExtension());
                $allowedExt = ['pdf', 'docx', 'xlsx', 'pptx'];

                if (!in_array($extension, $allowedExt)) {
                    return response()->json(['error' => 'Ekstensi file tidak valid.'], 422);
                }

                // 3. Cek isi file apakah mengandung kode PHP atau eksploit
                $contents = file_get_contents($file->getPathname());
                if (stripos($contents, '<?php') !== false || stripos($contents, 'eval(') !== false) {
                    return response()->json(['error' => 'Isi file mencurigakan, upload ditolak.'], 422);
                }

                // 4. Tentukan field berdasarkan jenis_dok
                $field = match ((int)$request->jenis_dok) {
                    5 => 'file_kir',
                    6 => 'file_stnk',
                    default => null,
                };

                if (!$field) {
                    return response()->json(['error' => 'Jenis dokumen tidak dikenali.'], 422);
                }

                // 5. Simpan file
                $file_path = public_path('upload/file_kendaraan');
                $file_name = now()->format('ymdHis') . '_' . uniqid() . '.' . $extension;
                $file->move($file_path, $file_name);

                // 6. Update data kendaraan
                DataKendaraanModel::where('id_kendaraan', $request->id_kendaraan)->update([
                    $field => $file_name,
                ]);

                $row = DataKendaraanModel::where('id_kendaraan', $request->id_kendaraan)->first();
                $ids =  getIdUser();
                UserLogModel::create([
                    'id_user' => $ids,
                    'aktivitas' => 'Berhasil Upload Dokumen Kendaraan ' . $row->plat_no_kendaraan . '/' . $row->nm_kendaraan . ' (' . $field . ').',
                ]);


                return response()->json([
                    'success' => 'Dokumen berhasil diupload.',
                    'action' => 'uploadkendaraan'
                ]);
            }

            return response()->json(['error' => 'File tidak ditemukan.'], 400);
        }

        return response()->json(['error' => 'Permintaan tidak valid.'], 400);
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

                $row = DataKendaraanModel::where('id_kendaraan', $id)->first();
                $ids =  getIdUser();
                UserLogModel::create([
                    'id_user' => $ids,
                    'aktivitas' => 'Berhasil Hapus Data Kendaraan ' . $row->plat_no_kendaraan . '/' . $row->nm_kendaraan . ' (Destroy).',
                ]);


                // Hapus data dari database
                DataKendaraanModel::where('id_kendaraan', $id)->delete();


                return response()->json([
                    'success' => 'Data berhasil dihapus',
                ]);
            } else {

                $row = DataKendaraanModel::where('id_kendaraan', $id)->first();
                $ids =  getIdUser();
                UserLogModel::create([
                    'id_user' => $ids,
                    'aktivitas' => 'Gagal Hapus Data Kendaraan ' . $row->plat_no_kendaraan . '/' . $row->nm_kendaraan . ' (Failed).',
                ]);


                return response()->json([
                    'error' => 'Data tidak ditemukan',
                ], 404);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function edit_status($id)
    {
        if (request()->ajax()) {

            $data = [
                'id'  => $id,
                'title_form' => 'FORM UBAH STATUS',
            ];
            return view('private.data_kendaraan.formedit_status', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }

    public function update_status(Request $r, $id)
    {
        if (request()->ajax()) {
            $row = DataKendaraanModel::where('id_kendaraan', $id)->first();
            $stts = status_actived($r->status_actived);

            $validator = Validator::make($r->all(), [
                'status_actived' => 'required',
            ], [
                'status_actived.required' => 'Status Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                DataKendaraanModel::where('id_kendaraan', $id)->update([
                    'status_actived' => $r->status_actived,
                ]);

                $ids =  getIdUser();
                UserLogModel::create([
                    'id_user' => $ids,
                    'aktivitas' => 'Berhasil Ubah Status kendaraan ' . $row->plat_no_kendaraan . '/' . $row->nm_kendaraan . ' (' . $stts . ').',
                ]);


                return response()->json(['success' => 'Status Berhasil diubah']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
