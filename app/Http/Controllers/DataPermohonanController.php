<?php

namespace App\Http\Controllers;

use App\Models\BiodataModel;
use App\Models\BparKabKotaModel;
use App\Models\DataKendaraanModel;
use App\Models\HistoriDataPermohonanModel;
use App\Models\MyModel;
use App\Models\PengajuanPermohonanModel;
use App\Models\PermohonanUploadBiodataModel;
use App\Models\UserDataAksesKabKotaModel;
use App\Models\UserLogModel;
use App\Models\ValidasiPermohonanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DataPermohonanController extends Controller
{
    public function index(Request $r)
    {
        if (getLevel() == 3) {
            $biodata = BiodataModel::where('id_user', getIdUser())->first();
            if (empty($biodata)) {
                return redirect()->to('biodata');
            }

            if (in_array(getSttsUser(), ['2', '3', '4'])) {
                return redirect()->to('panel');
            }
        }

        if (empty($r->act)) {
            return redirect()->to('panel');
        } else {
            $data = [
                'title' => act($r->act),
                'act' => $r->act,
            ];
            return view('private/permohonan_data/view')->with($data);
        }
    }

    public function show(Request $r)
    {
        if (request()->ajax()) {
            $act = $r->act;
            if ($act == "Input") {
                $dt = function ($query) {
                    $query->whereIn('status_permohonan', ['1', '2', '4']);
                };
            } else {
                $dt = function ($query) {
                    $query->whereIn('status_permohonan', ['3', '5']);
                };
            }

            $query = PengajuanPermohonanModel::where('id_biodata', getIdBiodata());


            // $kabkota = BparKabKotaModel::where('kode_provinsi', $query->first()->kode_provinsi)
            //     ->where('kode_kabkota', $query->first()->kode_kabkota)->first();

            // dd($kabkota->nm_kabkota);

            $dt($query);

            return DataTables::of($query->orderBy('tgl_kirim_permohonan', 'DESC')->get())
                ->addColumn('action', 'private.permohonan_data.action')
                ->addColumn('tglProses', function ($row) {
                    return cek_date_ddmmyyyy_his_v1($row->tgl_kirim_permohonan);
                })
                ->addColumn('merekType', function ($row) {
                    return $row->JkendaraanMerek->nm_merek_kendaraan . " / " . $row->JkendaraanType->nm_type_kendaraan;
                })
                ->addColumn('nmKendaraan', function ($row) {
                    return   $row->nm_kendaraan . ' (' . $row->thn_pembuatan . ') ';
                })
                ->addColumn('jenisPermohonan', function ($row) {
                    return $row->JjenisPermohonan->nm_jenis_permohonan . " (" . $row->JPermohonan->nm_par_permohonan . ')';
                })
                ->addColumn('jenisAngkutan', function ($row) {
                    return $row->JjenisAngkutan->nm_jenis_angkutan;
                })
                ->addColumn('trayek', function ($row) {
                    if ($row->id_trayek == 0) {
                        $trayek = "-";
                    } else {
                        $trayek = $row->Jtrayek->nm_trayek;
                    }
                    return $trayek;
                })
                ->addColumn('mengangkut', function ($row) {
                    return $row->jmengangkut->nm_mengangkut;
                })
                ->addColumn('status', function ($row) {
                    return status_permohonan($row->status_permohonan);
                })
                ->addColumn('kabkota', function ($row) {
                    $kabkota = BparKabKotaModel::where('kode_provinsi', $row->kode_provinsi)
                        ->where('kode_kabkota', $row->kode_kabkota)->first();
                    return $kabkota->nm_kabkota;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function destroy($id)
    {
        if (request()->ajax()) {
            $id_permohonan_izin = $id;

            $row = PengajuanPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin)->first();

            if ($row) {
                // Hapus file KIR jika tidak null/kosong
                if (!empty($row->file_kir)) {
                    $imagePath1 = public_path('upload/copy_file_permohonan/file_kendaraan') . '/' . $row->file_kir;
                    if (file_exists($imagePath1)) {
                        @unlink($imagePath1); // gunakan @unlink untuk suppress error jika terjadi race condition
                    }
                }

                // Hapus file STNK jika tidak null/kosong
                if (!empty($row->file_stnk)) {
                    $imagePath2 = public_path('upload/copy_file_permohonan/file_kendaraan') . '/' . $row->file_stnk;
                    if (file_exists($imagePath2)) {
                        @unlink($imagePath2);
                    }
                }

                $ids =  getIdUser();
                UserLogModel::create([
                    'id_user' => $ids,
                    'aktivitas' => 'Hapus Permohonan KIR Berhasil ' . $row->plat_no_kendaraan . '/' . $row->nm_kendaraan . ' (Destroy).',
                ]);

                // Hapus data utama permohonan
                $post = PengajuanPermohonanModel::where('id_permohonan_izin', $id_permohonan_izin)->delete();

                if ($post) {
                    // Ambil semua data upload berdasarkan id_permohonan_izin
                    $uploads = PermohonanUploadBiodataModel::where('id_permohonan_izin', $id_permohonan_izin)->get();

                    foreach ($uploads as $upload) {
                        if (!empty($upload->file_dokumen)) {
                            $imagePath = public_path('upload/copy_file_permohonan/file_biodata') . '/' . $upload->file_dokumen;
                            if (file_exists($imagePath)) {
                                @unlink($imagePath);
                            }
                        }
                    }




                    // Hapus data dari database
                    PermohonanUploadBiodataModel::where('id_permohonan_izin', $id_permohonan_izin)->delete();

                    return response()->json([
                        'success' => 'Data berhasil dihapus',
                    ]);
                }
            } else {
                return response()->json([
                    'error' => 'Data tidak ditemukan',
                ], 404);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }



    public function detailView($id)
    {
        if (request()->ajax()) {
            $row = PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first();
            $kabkota = BparKabKotaModel::where('kode_provinsi', $row->kode_provinsi)
                ->where('kode_kabkota', $row->kode_kabkota)
                ->first();
            $data = [
                'title_form' => 'LIHAT DATA PERMOHONAN',
                'row' => $row,
                'kabkota' => $kabkota->nm_kabkota,
            ];
            return view('private.permohonan_data.getModalView', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    // ADMIN || KIR
    public function viewProses(Request $r)
    {

        if ($r->act == "Masuk") {
            $title = act($r->act);
            $status = '2';
            $label  = 'Masuk';
        } else if ($r->act == "Proses") {
            $title = act($r->act);
            $status = '4';
            $label  = 'Proses';
        } else if ($r->act == "HistoriPengawas") {
            // $title = act($r->act);
            // $status = '5';
            // $label  = 'Disetujui';
        }

        $data = [
            'title' => $title,
            'status' =>  $status,
            'label' =>  $label,
        ];
        return view('private/permohonan_data/viewProses')->with($data);
    }

    public function showProses(Request $r)
    {
        if (request()->ajax()) {
            $status = $r->status;

            if (getLevel() == 2) {
                $user = getIdUser();
                $aksesKabkota = UserDataAksesKabKotaModel::where('id_user', $user)->get();
                // $kabkota = BparKabKotaModel::whereIn('kode_provinsi', $aksesKabkota->pluck('kode_provinsi'))
                //     ->whereIn('kode_kabkota', $aksesKabkota->pluck('kode_kabkota'))
                //     ->orderBy('kode_kabkota', 'ASC')
                //     ->get();
            } else {
                $aksesKabkota = null;
            }


            return  DataTables::of(PengajuanPermohonanModel::where('status_permohonan', $status)
                ->when(getLevel() == 2, function ($query) use ($aksesKabkota) {
                    $query->whereIn(
                        'kode_provinsi',
                        $aksesKabkota->pluck('kode_provinsi')->toArray()
                    )->whereIn(
                        'kode_kabkota',
                        $aksesKabkota->pluck('kode_kabkota')->toArray()
                    );
                })
                ->orderBy('tgl_kirim_permohonan', 'DESC')
                ->get())
                ->addColumn('action', 'private.permohonan_data.action')


                ->addColumn('tgl', function ($row) use ($status) {
                    if ($status == '4') {
                        $validasi = ValidasiPermohonanModel::where('id_permohonan_izin', $row->id_permohonan_izin)->first();
                        return cek_date_ddmmyyyy_his_v1($validasi->tgl_validasi_proses);
                    } else if ($status == '5') {
                        $validasi = ValidasiPermohonanModel::where('id_permohonan_izin', $row->id_permohonan_izin)->first();
                        return cek_ddmmyy_v1($validasi->tgl_validasi_selesai);
                    } else {
                        return cek_date_ddmmyyyy_his_v1($row->tgl_kirim_permohonan);
                    }
                })

                ->addColumn('no_kartu_pengawas', function ($row) use ($status) {
                    if ($status == '4') {
                        $validasi = ValidasiPermohonanModel::where('id_permohonan_izin', $row->id_permohonan_izin)->first();
                        return $validasi->no_kartu_pengawas;
                    } else {
                        return '-';
                    }
                })
                ->addColumn('nomor', function ($row) use ($status) {
                    if ($status != '5') {
                        return "-";
                    } else {
                        $validasi = ValidasiPermohonanModel::where('id_permohonan_izin', $row->id_permohonan_izin)->first();
                        return $validasi->no_kartu_pengawas;
                    }
                })

                ->addColumn('perusahaan', function ($row) {
                    return $row->nm_perusahaan_personal . ' (' . $row->BadanUsaha->nm_badan_usaha . ')';
                })

                ->addColumn('pimpinan', function ($row) {
                    return $row->nm_pimpinan_pemilik;
                })

                ->addColumn('tglMulai', function ($row) use ($status) {
                    if ($status != '5') {
                        return "-";
                    } else {
                        $validasi = ValidasiPermohonanModel::where('id_permohonan_izin', $row->id_permohonan_izin)->first();
                        return cek_ddmmyy_v1($validasi->tgl_awal);
                    }
                })
                ->addColumn('tglAkhir', function ($row) use ($status) {
                    if ($status != '5') {
                        return "-";
                    } else {
                        $validasi = ValidasiPermohonanModel::where('id_permohonan_izin', $row->id_permohonan_izin)->first();
                        return cek_ddmmyy_v1($validasi->tgl_akhir);
                    }
                })
                ->addColumn('merekType', function ($row) {
                    return $row->JkendaraanMerek->nm_merek_kendaraan . " / " . $row->JkendaraanType->nm_type_kendaraan;
                })
                ->addColumn('nm_kendaraan', function ($row) {
                    return  $row->nm_kendaraan . ' (' . $row->thn_pembuatan . ') ';
                })
                ->addColumn('jenisPermohonan', function ($row) {
                    return $row->JjenisPermohonan->nm_jenis_permohonan . " (" . $row->JPermohonan->nm_par_permohonan . ')';
                })
                ->addColumn('jenisAngkutan', function ($row) {
                    return $row->JjenisAngkutan->nm_jenis_angkutan;
                })
                ->addColumn('trayek', function ($row) {
                    if ($row->id_trayek == 0) {
                        $trayek = "-";
                    } else {
                        $trayek = $row->Jtrayek->nm_trayek;
                    }
                    return $trayek;
                })
                ->addColumn('mengangkut', function ($row) {
                    return $row->jmengangkut->nm_mengangkut;
                })
                ->addColumn('status', function ($row) {
                    return status_permohonan($row->status_permohonan);
                })
                ->addColumn('statusText', function ($row) {
                    return $row->status_permohonan;
                })
                ->addColumn('KabKota', function ($row) {
                    $Mymodel = new MyModel();
                    $tmp = $Mymodel->MyTableKabkota($row->kode_provinsi, $row->kode_kabkota)->first();
                    return $tmp->nm_kabkota;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function validasiPermohonan($id)
    {
        if (request()->ajax()) {
            $cek = ValidasiPermohonanModel::where('id_permohonan_izin', $id)->count();
            if ($cek > 0) {
                return response()->json([
                    'error' => 'Data sudah ada, tidak dapat di proses',
                ]);
            }
            ValidasiPermohonanModel::create([
                'no_kartu_pengawas'  => "-",
                'no_sk'  => "-",
                'status_validasi'  => 4,
                'id_permohonan_izin'  => $id,
                'tgl_validasi_proses' => date('Y-m-d H:i:s'),
            ]);
            $post = PengajuanPermohonanModel::where('id_permohonan_izin', $id)->update([
                'status_permohonan'  => 4,
            ]);
            return response()->json([
                'success' => 'Data berhasil divalidasi',
                'action' => 'validasiPermohonan_dataPermohonan',
                'route' => route('datapermohonan.kartuInput', Crypt::encrypt($id))
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function kartuInput($id)
    {

        $id = Crypt::decrypt($id);
        $data = [
            'title' => 'KARTU PENGAWAS',
            //'rowValidasi' => PengajuanPermohonanModel::all(),
            'row' => PengajuanPermohonanModel::Join('bpar_002_kabkota', function ($join) {
                $join->on('bpar_002_kabkota.kode_provinsi', '=', 'tr_permohonan.kode_provinsi')
                    ->on('bpar_002_kabkota.kode_kabkota', '=', 'tr_permohonan.kode_kabkota');
            })
                ->where('id_permohonan_izin', $id)->first(),
            'dok1' => PermohonanUploadBiodataModel::where('id_permohonan_izin', $id)->where('jenis_dok', '1')->first(),
            'dok2' => PermohonanUploadBiodataModel::where('id_permohonan_izin', $id)->where('jenis_dok', '2')->first(),
            'dok3' => PermohonanUploadBiodataModel::where('id_permohonan_izin', $id)->where('jenis_dok', '3')->first(),
            'dok4' => PermohonanUploadBiodataModel::where('id_permohonan_izin', $id)->where('jenis_dok', '4')->first(),
            'kendaraan' => PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first()

        ];
        return view('private/permohonan_data/kartuInput')->with($data);
    }

    public function getModal_kartuInput($id)
    {
        if (request()->ajax()) {
            $row = ValidasiPermohonanModel::where('id_permohonan_izin', $id)->first();
            $rowPermohonan =  PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first();
            $data = [
                'title_form'    => 'INPUT KARTU PENGAWAS',
                'id'            => $row->id_validasi_permohonan,
                'row'           => $row,
                'rowPermohonan' => $rowPermohonan,
            ];
            return view('private.permohonan_data.getModal_kartuInput', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function showDataKartuPengawas($id)
    {
        if (request()->ajax()) {
            $data = [
                'row' => ValidasiPermohonanModel::where('id_permohonan_izin', $id)->first(),
                'rowPermohonan' => PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first()
            ];
            return view('private.permohonan_data.dataKartuPengawas', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function cekAksiKartuPengawas($id)
    {
        if (request()->ajax()) {
            $data = [
                'rows' => PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first()
            ];
            return view('private.permohonan_data.cekAksiKartuPengawas', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function storeInputKartu(Request $r, $id)
    {
        if (request()->ajax()) {

            // $validator = Validator::make($r->all(), [
            //     'no_kartu_pengawas' => [
            //         'required',
            //         function ($attribute, $value, $fail) use ($id, $r) {

            //             // 👉 Jika id_par_permohonan = 7, LEWATI pengecekan unik
            //             if ($r->input('id_par_permohonan') == 7) {
            //                 return;
            //             }

            //             $exists = ValidasiPermohonanModel::where('no_kartu_pengawas', $value)
            //                 ->where('id_validasi_permohonan', '!=', $id)
            //                 ->exists();

            //             if ($exists) {
            //                 $fail('Nomor Kartu Pengawas sudah ada');
            //             }
            //         }
            //     ],

            //     'tgl_sk' => 'required_unless:id_par_permohonan,7',
            //     'no_sk' => 'required_unless:id_par_permohonan,7',
            //     'tgl_awal' => 'required_unless:id_par_permohonan,7',
            //     'tgl_akhir' => 'required_unless:id_par_permohonan,7',
            //     'tgl_kir_awal' => $r->input('ck_tgl_kir_awal_clear') !== '0' ? 'required' : '',
            //     'tgl_kir_akhir' => $r->input('ck_tgl_kir_akhir_clear') !== '0' ? 'required' : '',
            // ], [
            //     'no_kartu_pengawas.required' => 'Nomor Kartu Pengawas Tidak Boleh Kosong',
            //     'tgl_sk.required_unless' => 'Tanggal SK Tidak Boleh Kosong',
            //     'no_sk.required_unless' => 'Nomor SK Tidak Boleh Kosong',
            //     'tgl_awal.required_unless' => 'Tanggal Awal Tidak Boleh Kosong',

            //     'tgl_akhir.required_unless' => 'Tanggal Akhir Tidak Boleh Kosong',
            //     'tgl_kir_awal.required' => 'Tanggal Awal KIR Tidak Boleh Kosong',
            //     'tgl_kir_akhir.required' => 'Tanggal Akhir KIR Tidak Boleh Kosong',
            // ]);

            $validator = Validator::make($r->all(), [

                'no_kartu_pengawas' => [
                    'required',
                    function ($attribute, $value, $fail) use ($id, $r) {

                        $value = trim($value);
                        if ($r->input('id_par_permohonan') == 7) {
                            if ($value === '-') {
                                return;
                            }
                        }
                        // ==========================================
                        // CEK DUPLIKAT
                        // Untuk selain "-" atau jenis lainnya
                        // ==========================================

                        $query = ValidasiPermohonanModel::where('no_kartu_pengawas', $value);

                        // Jika EDIT, abaikan data miliknya sendiri
                        if (!empty($id)) {
                            $query->where('id_validasi_permohonan', '!=', $id);
                        }
                        // Jika ditemukan data yang sama
                        if ($query->exists()) {
                            $fail('Nomor Kartu Pengawas sudah ada.');
                        }
                    }
                ],

                'tgl_sk' => [
                    'required_unless:id_par_permohonan,7'
                ],

                'no_sk' => [
                    'required_unless:id_par_permohonan,7'
                ],

                'tgl_awal' => [
                    'required_unless:id_par_permohonan,7'
                ],

                'tgl_akhir' => [
                    'required_unless:id_par_permohonan,7'
                ],
                'tgl_kir_awal' => [
                    Rule::requiredIf(
                        !$r->boolean('ck_tgl_kir_awal_clear')
                    ),
                    'nullable'
                ],

                'tgl_kir_akhir' => [
                    Rule::requiredIf(
                        !$r->boolean('ck_tgl_kir_akhir_clear')
                    ),
                    'nullable'
                ],

                'tgl_pkb_awal' => [
                    Rule::requiredIf(
                        !$r->boolean('ck_tgl_pkb_awal_clear')
                    ),
                    'nullable'
                ],

                'tgl_pkb_akhir' => [
                    Rule::requiredIf(
                        !$r->boolean('ck_tgl_pkb_akhir_clear')
                    ),
                    'nullable'
                ],

                'tgl_iwkbu_awal' => [
                    Rule::requiredIf(
                        !$r->boolean('ck_tgl_iwkbu_awal_clear')
                    ),
                    'nullable'
                ],

                'tgl_iwkbu_akhir' => [
                    Rule::requiredIf(
                        !$r->boolean('ck_tgl_iwkbu_akhir_clear')
                    ),
                    'nullable'
                ],

            ], [


                'no_kartu_pengawas.required' => 'Nomor Kartu Pengawas Tidak Boleh Kosong',
                'tgl_sk.required_unless' => 'Tanggal SK Tidak Boleh Kosong',
                'no_sk.required_unless' => 'Nomor SK Tidak Boleh Kosong',
                'tgl_awal.required_unless' => 'Tanggal Awal Tidak Boleh Kosong',
                'tgl_akhir.required_unless' => 'Tanggal Akhir Tidak Boleh Kosong',
                'tgl_kir_awal.required' => 'Tanggal Awal KIR Tidak Boleh Kosong',
                'tgl_kir_akhir.required' => 'Tanggal Akhir KIR Tidak Boleh Kosong',
                'tgl_pkb_awal.required' =>
                'Tanggal Awal PKB Tidak Boleh Kosong',
                'tgl_pkb_akhir.required' =>
                'Tanggal Akhir PKB Tidak Boleh Kosong',

                'tgl_iwkbu_awal.required' =>
                'Tanggal Awal IWKBU Tidak Boleh Kosong',

                'tgl_iwkbu_akhir.required' =>
                'Tanggal Akhir IWKBU Tidak Boleh Kosong',

            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                // $tgl_sk = \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_sk)->format('Y-m-d');
                //$tgl_awal = \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_awal)->format('Y-m-d');
                // $tgl_akhir = \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_akhir)->format('Y-m-d');

                if ($r->tgl_sk) {
                    $tgl_sk = \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_sk)->format('Y-m-d');
                } else {
                    $tgl_sk = null;
                }

                if ($r->tgl_awal) {
                    $tgl_awal = \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_awal)->format('Y-m-d');
                } else {
                    $tgl_awal = null;
                }

                if ($r->tgl_akhir) {
                    $tgl_akhir = \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_akhir)->format('Y-m-d');
                } else {
                    $tgl_akhir = null;
                }



                if ($r->tgl_kir_awal) {
                    $tgl_kir_awal = \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_kir_awal)->format('Y-m-d');
                } else {
                    $tgl_kir_awal = null;
                }

                if ($r->tgl_kir_akhir) {
                    $tgl_kir_akhir = \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_kir_akhir)->format('Y-m-d');
                } else {
                    $tgl_kir_akhir = null;
                }

                //dd($r);

                $row = ValidasiPermohonanModel::where('id_validasi_permohonan', $id)->first();
                $post = ValidasiPermohonanModel::where('id_validasi_permohonan', $id)->update([
                    'no_kartu_pengawas'  => $r->no_kartu_pengawas,
                    'tgl_sk'  => $tgl_sk,
                    'no_sk'  => $r->no_sk,
                    'tgl_awal'  => $tgl_awal,
                    'tgl_akhir'  => $tgl_akhir,
                    // 'tgl_kir_awal'  => $tgl_kir_awal,
                    // 'tgl_kir_akhir'  =>  $tgl_kir_akhir,
                    // 'ck_tgl_kir_awal_clear' => $r->input('ck_tgl_kir_awal_clear') == '' ? '1' : '0',
                    // 'ck_tgl_kir_akhir_clear' => $r->input('ck_tgl_kir_akhir_clear') == '' ? '1' : '0',
                ]);
                if ($post) {
                    $post = PengajuanPermohonanModel::where('id_permohonan_izin', $row->id_permohonan_izin)->update([
                        'nomor_uji' => $r->nomor_uji,
                        'kombinasi_yg_diperoleh' => $r->kombinasi_yg_diperoleh,
                        'sk_reg_uji_type' => $r->sk_reg_uji_type,
                        'ket_lain' => $r->ket_lain,
                        'tgl_kir_awal' => $r->boolean('ck_tgl_kir_awal_clear')
                            ? null
                            : ($r->tgl_kir_awal
                                ? \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_kir_awal)->format('Y-m-d')
                                : null),
                        'tgl_kir_akhir' => $r->boolean('ck_tgl_kir_akhir_clear')
                            ? null
                            : ($r->tgl_kir_akhir
                                ? \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_kir_akhir)->format('Y-m-d')
                                : null),

                        'tgl_pkb_awal' => $r->boolean('ck_tgl_pkb_awal_clear')
                            ? null
                            : ($r->tgl_pkb_awal
                                ? \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_pkb_awal)->format('Y-m-d')
                                : null),

                        'tgl_pkb_akhir' => $r->boolean('ck_tgl_pkb_akhir_clear')
                            ? null
                            : ($r->tgl_pkb_akhir
                                ? \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_pkb_akhir)->format('Y-m-d')
                                : null),

                        'tgl_iwkbu_awal' => $r->boolean('ck_tgl_iwkbu_awal_clear')
                            ? null
                            : ($r->tgl_iwkbu_awal
                                ? \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_iwkbu_awal)->format('Y-m-d')
                                : null),

                        'tgl_iwkbu_akhir' => $r->boolean('ck_tgl_iwkbu_akhir_clear')
                            ? null
                            : ($r->tgl_iwkbu_akhir
                                ? \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_iwkbu_akhir)->format('Y-m-d')
                                : null),

                    ]);
                    return response()->json([
                        'success' => 'Data berhasil disimpan',
                        'action' => 'storeInputKartu_dataPermohonan'
                    ]);
                }
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function getModal_kartuInputValidasi($id)
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'VALIDASI KARTU PENGAWAS',
                'rows' => PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first()
            ];
            return view('private.permohonan_data.getModal_kartuInputValidasi', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function validasiSelesai(Request $r, $id)
    {
        if (!request()->ajax()) {
            exit('Maaf Tidak Dapat diproses...');
        }

        // =====================================================
        // VALIDASI INPUT
        // =====================================================
        $validator = Validator::make($r->all(), [

            'tgl_validasi_selesai' => [
                'required',
                'date_format:d-m-Y',
            ],

        ], [

            'tgl_validasi_selesai.required' =>
            'Tanggal Validasi Tidak Boleh Kosong',

            'tgl_validasi_selesai.date_format' =>
            'Format Tanggal Validasi harus dd-mm-yyyy',

        ]);


        if ($validator->fails()) {

            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }


        // =====================================================
        // CARI DATA VALIDASI
        // =====================================================
        $cek = ValidasiPermohonanModel::where(
            'id_permohonan_izin',
            $id
        )->first();


        if (!$cek) {

            return response()->json([
                'errors' => 'Data validasi permohonan tidak ditemukan.'
            ], 404);
        }


        // =====================================================
        // CEK JENIS PERMOHONAN
        // =====================================================
        $idParPermohonan = optional($cek->JPermohonan)
            ->id_par_permohonan;


        // =====================================================
        // NOMOR KARTU PENGAWAS
        //
        // Jika id_par_permohonan != 7
        // maka nomor kartu wajib diisi
        // dan tidak boleh "-"
        // =====================================================
        if (
            $idParPermohonan != 7 &&
            in_array(
                trim($cek->no_kartu_pengawas ?? ''),
                ['', '-'],
                true
            )
        ) {

            return response()->json([
                'errors' => 'Silakan Isi Nomor Kartu Pengawas'
            ], 423);
        }


        // =====================================================
        // KONVERSI TANGGAL
        // =====================================================
        $tanggal = \Carbon\Carbon::createFromFormat(
            'd-m-Y',
            $r->tgl_validasi_selesai
        )->format('Y-m-d');


        // =====================================================
        // UPDATE VALIDASI
        // =====================================================
        ValidasiPermohonanModel::where(
            'id_validasi_permohonan',
            $cek->id_validasi_permohonan
        )->update([

            'status_validasi' => '5',

            'tgl_validasi_selesai' => $tanggal,

        ]);


        // =====================================================
        // UPDATE PENGAJUAN PERMOHONAN
        // =====================================================
        PengajuanPermohonanModel::where(
            'id_permohonan_izin',
            $id
        )->update([

            'status_permohonan' => '5',

        ]);


        // =====================================================
        // RESPONSE
        // =====================================================
        return response()->json([

            'success' =>
            'Data berhasil disimpan dan diproses, terimakasih',

            'action' =>
            'validasiSelesai_dataPermohonan'

        ]);
    }

    public function createTolak($id)
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'FORM URAIAN DI TOLAK',
                'id' => $id
            ];
            return view('private.permohonan_data.getModalViewTolak', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function getModalHistoriData($id)
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'INFORMASI',
                'row' => HistoriDataPermohonanModel::where('id_permohonan_izin', $id)->first()
            ];
            return view('private.permohonan_data.getModalHistoriData', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function storeTolakPermohonan(Request $r, $id)
    {
        if (request()->ajax()) {
            PengajuanPermohonanModel::where('id_permohonan_izin', $id)->update([
                'status_permohonan'  => 3,
            ]);
            HistoriDataPermohonanModel::create([
                'status_permohonan'  => 3,
                'keterangan_histori'  => $r->keterangan_histori,
                'id_permohonan_izin'  => $id,
            ]);
            ValidasiPermohonanModel::where('id_permohonan_izin', $id)->delete();
            return response()->json([
                'success' => 'Data berhasil ditolak',
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function destroyBatalProses($id)
    {
        if (request()->ajax()) {
            PengajuanPermohonanModel::where('id_permohonan_izin', $id)->update([
                'status_permohonan'  => 2,
            ]);

            ValidasiPermohonanModel::where('id_permohonan_izin', $id)->delete();
            return response()->json([
                'success' => 'Data proses berhasil dibatalkan',
                'action' => 'destroyBatalProses_dataPermohonan',
                'route' => route('datapermohonan.viewProses', ['act' => 'Masuk'])
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function dokumenUpload($id)
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'DOKUMEN UPLOAD',
                'dok1' => PermohonanUploadBiodataModel::where('id_permohonan_izin', $id)->where('jenis_dok', '1')->first(),
                'dok2' => PermohonanUploadBiodataModel::where('id_permohonan_izin', $id)->where('jenis_dok', '2')->first(),
                'dok3' => PermohonanUploadBiodataModel::where('id_permohonan_izin', $id)->where('jenis_dok', '3')->first(),
                'dok4' => PermohonanUploadBiodataModel::where('id_permohonan_izin', $id)->where('jenis_dok', '4')->first(),
                'kendaraan' => PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first()
            ];
            return view('private.permohonan_data.getModal_dokumenUpload', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
