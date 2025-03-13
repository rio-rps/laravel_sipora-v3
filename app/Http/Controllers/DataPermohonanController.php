<?php

namespace App\Http\Controllers;

use App\Models\BiodataModel;
use App\Models\HistoriDataPermohonanModel;
use App\Models\PengajuanPermohonanModel;
use App\Models\PermohonanUploadBiodataModel;
use App\Models\ValidasiPermohonanModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class DataPermohonanController extends Controller
{
    public function index(Request $r)
    {
        if (getLevel() == 3) {
            $biodata = BiodataModel::where('id_user', getIdUser())->first();
            if (empty($biodata)) {
                return redirect()->to('biodata');
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
            $dt($query);

            return DataTables::of($query->orderBy('tgl_kirim_permohonan', 'DESC')->get())
                ->addColumn('action', 'private.permohonan_data.action')
                ->addColumn('tglProses', function ($row) {
                    return cek_date_ddmmyyyy_his_v1($row->tgl_kirim_permohonan);
                })
                ->addColumn('merekType', function ($row) {
                    return $row->JkendaraanMerek->nm_merek_kendaraan . " / " . $row->JkendaraanType->nm_type_kendaraan . " / " . $row->nm_kendaraan . ' (' . $row->thn_pembuatan . ') ';
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
                ->rawColumns(['status', 'action'])
                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function destroy($id)
    {
        if (request()->ajax()) {
            PengajuanPermohonanModel::where('id_permohonan_izin', $id)->delete();
            return response()->json([
                'success' => 'Data berhasil dihapus',
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }



    public function detailView($id)
    {
        if (request()->ajax()) {
            $data = [
                'title_form' => 'LIHAT DATA',
                'row' => PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first()
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
            $title = act($r->act);
            $status = '5';
            $label  = 'Disetujui';
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

            return  DataTables::of(PengajuanPermohonanModel::where('status_permohonan', $status)
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

                ->addColumn('nomor', function ($row) use ($status) {
                    if ($status != '5') {
                        return "-";
                    } else {
                        $validasi = ValidasiPermohonanModel::where('id_permohonan_izin', $row->id_permohonan_izin)->first();
                        return $validasi->no_kartu_pengawas;
                    }
                })

                ->addColumn('perusahaan', function ($row) {
                    return $row->nm_perusahaan_personal;
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
                    return $row->JkendaraanMerek->nm_merek_kendaraan . " / " . $row->JkendaraanType->nm_type_kendaraan . " / " . $row->nm_kendaraan . ' (' . $row->thn_pembuatan . ') ';
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
            'row' => PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first()

        ];
        return view('private/permohonan_data/kartuInput')->with($data);
    }

    public function getModal_kartuInput($id)
    {
        if (request()->ajax()) {
            $row = ValidasiPermohonanModel::where('id_permohonan_izin', $id)->first();
            $data = [
                'title_form' => 'INPUT KARTU PENGAWAS',
                'id' => $row->id_validasi_permohonan,
                'row' => $row,
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
                'row' => ValidasiPermohonanModel::where('id_permohonan_izin', $id)->first()
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

            $validator = Validator::make($r->all(), [
                'no_kartu_pengawas' => [
                    'required',
                    function ($attribute, $value, $fail) use ($id) {
                        $isUnique = ValidasiPermohonanModel::where('no_kartu_pengawas', $value)
                            ->where('id_validasi_permohonan', '!=', $id)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('Nomor Kartu Pengawas sudah ada');
                        }
                    }
                ],
                'tgl_sk' => 'required',
                'no_sk' => 'required',
                'tgl_awal' => 'required',
                'tgl_akhir' => 'required',
                'tgl_kir_awal' => $r->input('ck_tgl_kir_awal_clear') !== '0' ? 'required' : '',
                //'tgl_kir_akhir' => 'required',
                'tgl_kir_akhir' => $r->input('ck_tgl_kir_akhir_clear') !== '0' ? 'required' : '',
            ], [
                'no_kartu_pengawas.required' => 'Nomor Kartu Pengawas Tidak Boleh Kosong',
                'tgl_sk.required' => 'Tanggal SK Tidak Boleh Kosong',
                'no_sk.required' => 'Nomor SK Tidak Boleh Kosong',
                'tgl_awal.required' => 'Tanggal Awal Tidak Boleh Kosong',
                'tgl_akhir.required' => 'Tanggal Akhir Tidak Boleh Kosong',
                'tgl_kir_awal.required' => 'Tanggal Awal KIR Tidak Boleh Kosong',
                'tgl_kir_akhir.required' => 'Tanggal Akhir KIR Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = ValidasiPermohonanModel::where('id_validasi_permohonan', $id)->update([
                    'no_kartu_pengawas'  => $r->no_kartu_pengawas,
                    'tgl_sk'  => $r->tgl_sk,
                    'no_sk'  => $r->no_sk,
                    'tgl_awal'  => $r->tgl_awal,
                    'tgl_akhir'  => $r->tgl_akhir,
                    'tgl_kir_awal'  =>  $r->input('ck_tgl_kir_awal_clear') == '' ? $r->tgl_kir_awal : null,
                    'tgl_kir_akhir'  =>  $r->input('ck_tgl_kir_akhir_clear') == '' ? $r->tgl_kir_akhir : null,
                    'ck_tgl_kir_awal_clear' => $r->input('ck_tgl_kir_awal_clear') == '' ? '1' : '0',
                    'ck_tgl_kir_akhir_clear' => $r->input('ck_tgl_kir_akhir_clear') == '' ? '1' : '0'
                ]);
                return response()->json([
                    'success' => 'Data berhasil disimpan',
                    'action' => 'storeInputKartu_dataPermohonan'
                ]);
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
        if (request()->ajax()) {
            $cek = ValidasiPermohonanModel::where('id_permohonan_izin', $id)->first();
            // echo $cek->id_validasi_permohonan;
            // echo "<br>";
            // echo $id;
            $validator = Validator::make($r->all(), [
                'tgl_validasi_selesai' => 'required',
            ], [
                'tgl_validasi_selesai.required' => 'Tanggal Validasi Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else if ($cek->no_kartu_pengawas == '-' || $cek->no_kartu_pengawas == '') {
                return response()->json(['errors' => 'Silakan Isi Nomor Kartu Pengawas'], 423);
            } else {
                ValidasiPermohonanModel::where('id_validasi_permohonan', $cek->id_validasi_permohonan)->update([
                    'status_validasi'  => '5',
                    'tgl_validasi_selesai'  => $r->tgl_validasi_selesai,
                ]);

                PengajuanPermohonanModel::where('id_permohonan_izin', $id)->update([
                    'status_permohonan'  => '5',
                ]);
                return response()->json([
                    'success' => 'Data berhasil disimpan dan diproses, terimakasih',
                    'action' => "validasiSelesai_dataPermohonan"
                ]);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
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
                'biodata' => PermohonanUploadBiodataModel::where('id_permohonan_izin', $id)->orderBy('jenis_dok', 'asc')->get(),
                'kendaraan' => PengajuanPermohonanModel::where('id_permohonan_izin', $id)->first()
            ];
            return view('private.permohonan_data.getModal_dokumenUpload', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
