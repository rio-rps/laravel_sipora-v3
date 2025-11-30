<?php

namespace App\Http\Controllers;

use App\Models\BiodataModel;
use App\Models\BparKabKotaModel;
use App\Models\CparJenisPermohonanModel;
use App\Models\CparPermohonanModel;
use App\Models\CparTrayekModel;
use App\Models\DataKendaraanModel;
use App\Models\MappingAngkutanToJenisPermohonanModel;
use App\Models\MappingMengangkutModel;
use App\Models\PengajuanPermohonanModel;
use App\Models\PermohonanUploadBiodataModel;
use App\Models\UploadModel;
use App\Models\UserLogModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables as DataTables;
use Illuminate\Support\Facades\File;


class PengajuanPermohonanController extends Controller
{


    public function index()
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

        $biodata = BiodataModel::where('id_user', getIdUser())->first();
        $countUpload = UploadModel::where('id_biodata', getIdBiodata())->count();
        $row1 = UploadModel::where('id_biodata', getIdBiodata())->where('jenis_dok', '1')->first();
        $row2 = UploadModel::where('id_biodata', getIdBiodata())->where('jenis_dok', '2')->first();
        $row3 = UploadModel::where('id_biodata', getIdBiodata())->where('jenis_dok', '3')->first();
        $row4 = UploadModel::where('id_biodata', getIdBiodata())->where('jenis_dok', '4')->first();
        if ($biodata) {
            $data = [
                'title' => 'FORMULIR PENGAJUAN PERMOHONAN',
                'row' => $biodata,
                'ResultJenisPermohonan' => CparJenisPermohonanModel::all(),
                'countUpload' => $countUpload,
                'row1' => $row1,
                'row2' => $row2,
                'row3' => $row3,
                'row4' => $row4,

            ];
            return view('private/permohonan_pengajuan/view')->with($data);
        } else {
            return redirect()->to('biodata');
        }
    }

    public function getPermohonan(Request $r)
    {
        $data = CparPermohonanModel::where('id_jenis_permohonan', $r->id_jenis_permohonan)->get();

        return response()->json($data);
    }

    public function getTrayek(Request $r)
    {
        $data = CparTrayekModel::where('id_par_permohonan', $r->id_par_permohonan)->get();

        return response()->json($data);
    }

    public function getJenisAngkutan(Request $r)
    {
        $result = MappingAngkutanToJenisPermohonanModel::where('id_jenis_permohonan', $r->id_jenis_permohonan)->get();
        $data = [];

        foreach ($result as $res) {
            $data[] = [
                'id_jenis_angkutan' => $res->id_jenis_angkutan,
                'nm_jenis_angkutan' => $res->JCparJenisAngkutan->nm_jenis_angkutan,
            ];
        }

        return response()->json($data);
    }

    public function getMengangkut(Request $r)
    {
        $result = MappingMengangkutModel::where('id_jenis_angkutan', $r->id_jenis_angkutan)->get();
        $data = [];

        foreach ($result as $res) {
            $data[] = [
                'id_mengangkut' => $res->id_mengangkut,
                'nm_mengangkut' => $res->JCparMengangkut->nm_mengangkut,
            ];
        }


        return response()->json($data);
    }

    public function create()
    {
        if (request()->ajax()) {
            $biodata = BiodataModel::where('id_user', getIdUser())->first();

            $data = [
                'title_form' => 'DATA KENDARAAN',
                'id_biodata' => $biodata->id_biodata,
            ];
            return view('private.permohonan_pengajuan.getModalView', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function store(Request $r)
    {
        if (request()->ajax()) {

            $id_kabkota = $r->id_kabkota;
            $rowKabkota = BparKabKotaModel::where('id_kabkota', $id_kabkota)->first();

            $biodata = BiodataModel::where('id_biodata', getIdBiodata())->first();
            //dd($biodata);
            $trayek = $r->id_trayek;
            if (empty($trayek)) {
                $id_trayek = '0';
            } else {
                $id_trayek = $trayek;
            }
            $validator = Validator::make($r->all(), [
                'id_jenis_permohonan' => 'required',
                'id_par_permohonan' => 'required',
                'id_trayek' => 'required_if:id_jenis_permohonan,2',
                'id_jenis_angkutan' => 'required',
                'id_mengangkut' => 'required',
                'id_kabkota' => 'required',

                'id_merek_kendaraan' => 'required',
                'id_type_kendaraan' => 'required',
                'nm_kendaraan' => 'required',
                'plat_no_kendaraan' => 'required',
                'no_rangka' => 'required',
                'no_mesin' => 'required',

                'warna_tnkb' => 'required',
                'bahan_bakar' => 'required',

                'daya_angkut_orang' => 'required',
                'daya_angkut_barang' => 'required',
                'thn_pembuatan' => 'required',

            ], [
                'id_jenis_permohonan.required' => 'Jenis Permohonan Tidak Boleh Kosong',
                'id_par_permohonan.required' => 'Permohonan Tidak Boleh Kosong',
                'id_trayek.required_if' => 'Trayek tidak boleh kosong.',
                'id_jenis_angkutan.required' => 'Jenis Angkutan Tidak Boleh Kosong',
                'id_mengangkut.required' => 'Mengangkut Tidak Boleh Kosong',
                'id_kabkota.required' => 'Kab/kota Tidak Boleh Kosong',


                'id_merek_kendaraan.required' => 'Nama Merek Kendaraan Tidak Boleh Kosong',
                'id_type_kendaraan.required' => 'Nama Type Kendaraan Tidak Boleh Kosong',
                'nm_kendaraan.required' => 'Nama Kendaraan Tidak Boleh Kosong',
                'plat_no_kendaraan.required' => 'Plat Kendaraan Tidak Boleh Kosong',
                'no_rangka.required' => 'Nomor Rangka Tidak Boleh Kosong',
                'no_mesin.required' => 'Nomor Mesin Tidak Boleh Kosong',

                'warna_tnkb.required' => 'Warna TNKB Barang Tidak Boleh Kosong',
                'bahan_bakar.required' => 'Bahan Bakar Tidak Boleh Kosong',



                'daya_angkut_orang.required' => 'Daya Angkut Orang Tidak Boleh Kosong',
                'daya_angkut_barang.required' => 'Daya Angkut Barang Tidak Boleh Kosong',
                'thn_pembuatan.required' => 'Tahun Pembuatan Tidak Boleh Kosong',

            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {

                $rowKendaraan = DataKendaraanModel::where('id_kendaraan', $r->id_kendaraan_history)->first();

                $file_kir = $rowKendaraan->file_kir;
                $file_stnk = $rowKendaraan->file_stnk;

                $asal_path = public_path('upload/file_kendaraan');
                $tujuan_path = public_path('upload/copy_file_permohonan/file_kendaraan');

                // Pastikan folder tujuan ada
                if (!File::exists($tujuan_path)) {
                    File::makeDirectory($tujuan_path, 0755, true);
                }

                // Copy file jika tersedia
                if ($file_kir && File::exists($asal_path . '/' . $file_kir)) {
                    File::copy($asal_path . '/' . $file_kir, $tujuan_path . '/' . $file_kir);
                }

                if ($file_stnk && File::exists($asal_path . '/' . $file_stnk)) {
                    File::copy($asal_path . '/' . $file_stnk, $tujuan_path . '/' . $file_stnk);
                }


                $tgl_faktur = $r->tgl_faktur_jual_beli;

                if ($tgl_faktur) {
                    $tgl_faktur_jual_beli =  \Carbon\Carbon::createFromFormat('d-m-Y', $r->tgl_faktur_jual_beli)->format('Y-m-d');;
                } else {
                    $tgl_faktur_jual_beli = null;
                }


                $post = PengajuanPermohonanModel::create([
                    'id_merek_kendaraan'  => $r->id_merek_kendaraan,
                    'id_type_kendaraan'  => $r->id_type_kendaraan,
                    'nm_kendaraan'  => $r->nm_kendaraan,
                    'plat_no_kendaraan'  => $r->plat_no_kendaraan,
                    'daya_angkut_orang'  => str_replace(".", "", $r->daya_angkut_orang),
                    'daya_angkut_barang'  => str_replace(".", "", $r->daya_angkut_barang),
                    'thn_pembuatan'  => $r->thn_pembuatan,
                    'no_rangka'  => $r->no_rangka,
                    'no_mesin'  => $r->no_mesin,

                    'id_jenis_permohonan'  => $r->id_jenis_permohonan,
                    'id_par_permohonan'  => $r->id_par_permohonan,
                    'id_trayek'  => $id_trayek,
                    'id_jenis_angkutan'  => $r->id_jenis_angkutan,
                    'id_mengangkut'  => $r->id_mengangkut,

                    'id_biodata'  => $biodata->id_biodata,
                    'id_badan_usaha'  => $biodata->id_badan_usaha,
                    'nm_perusahaan_personal'  => $biodata->nm_perusahaan_personal,
                    'nm_pimpinan_pemilik'  => $biodata->nm_pimpinan_pemilik,
                    'alamat_biodata'  => $biodata->alamat_biodata,
                    'email'  => $biodata->email,
                    'no_telp'  => $biodata->no_telp,

                    'tgl_kirim_permohonan'  => date('Y-m-d H:i:s'),
                    'status_permohonan'  => '2',
                    'file_kir' => $file_kir,
                    'file_stnk' => $file_stnk,
                    'id_kendaraan_history'  => $r->id_kendaraan_history,
                    'kode_provinsi'  => $rowKabkota->kode_provinsi,
                    'kode_kabkota'  => $rowKabkota->kode_kabkota,

                    'warna_tnkb'  => $r->warna_tnkb,
                    'bahan_bakar'  => $r->bahan_bakar,
                    'nmr_faktur_jual_beli'  => $r->nmr_faktur_jual_beli,
                    'tgl_faktur_jual_beli'  => $tgl_faktur_jual_beli,
                ]);


                // copy
                $id_permohonan_izin = PengajuanPermohonanModel::latest('id_permohonan_izin')->value('id_permohonan_izin');
                $oldTable = 'ddd_biodata_upload_dok';
                $newTable = 'tr_permohonan_004_upload_biodata';

                $asal_path = public_path('upload/file_biodata');
                $tujuan_path = public_path('upload/copy_file_permohonan/file_biodata');

                // Pastikan folder tujuan ada
                if (!File::exists($tujuan_path)) {
                    File::makeDirectory($tujuan_path, 0755, true);
                }

                $data = DB::table($oldTable)
                    ->select(['jenis_dok', 'file_dokumen', 'id_biodata'])
                    ->where('id_biodata', $biodata->id_biodata)
                    ->get();

                foreach ($data as $row) {
                    // Cek dan salin file jika ada
                    $namaFile = $row->file_dokumen;
                    if ($namaFile && File::exists($asal_path . '/' . $namaFile)) {
                        File::copy($asal_path . '/' . $namaFile, $tujuan_path . '/' . $namaFile);
                    }

                    // Simpan ke tabel baru
                    DB::table($newTable)->insert([
                        'jenis_dok' => $row->jenis_dok,
                        'file_dokumen' => $namaFile,
                        'id_biodata' => $row->id_biodata,
                        'id_permohonan_izin' => $id_permohonan_izin,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }

                $row = DataKendaraanModel::where('id_kendaraan', $r->id_kendaraan_history)->first();
                $ids =  getIdUser();
                UserLogModel::create([
                    'id_user' => $ids,
                    'aktivitas' => 'Berhasil Mengirimkan Pengajuan Permohonan KIR ' . $row->plat_no_kendaraan . '/' . $row->nm_kendaraan . ' (Create).',
                ]);

                return response()->json([
                    'success' => 'Data pengajuan permohonan Anda berhasil dikirim',
                    'action' => 'storePengajuanPermohonan',
                    'route' => 'datapermohonan?act=Input'
                ]);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }



    public function show()
    {
        if (request()->ajax()) {
            return  DataTables::of(DataKendaraanModel::where('status_actived', 1)->where('id_biodata', getIdBiodata())->get())
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" class="btn btn-sm btn-primary" id="tombolGetPilih" data-url="' . route('pengajuanpermohonan.getPilih', $row->id_kendaraan) . '" title="Pilih"><i class="fa fa-check"></i></button>';
                    return $btn;
                })
                ->addColumn('merekType', function ($row) {
                    return $row->JkendaraanMerek->nm_merek_kendaraan . " / " . $row->JkendaraanType->nm_type_kendaraan . " / " . $row->nm_kendaraan;
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


    public function getPilih($id)
    {
        if (request()->ajax()) {
            $row = DataKendaraanModel::where('id_kendaraan', $id)->first();
            $data = [
                'id_kendaraan' => $row->id_kendaraan,
                'id_merek_kendaraan' => $row->id_merek_kendaraan,
                'id_type_kendaraan' => $row->id_type_kendaraan,
                'nm_kendaraan' => $row->nm_kendaraan,
                'plat_no_kendaraan' => $row->plat_no_kendaraan,
                'daya_angkut_orang' => format_rupiah($row->daya_angkut_orang),
                'daya_angkut_barang' => format_rupiah($row->daya_angkut_barang),
                'no_rangka' => $row->no_rangka,
                'no_mesin' => $row->no_mesin,
                'thn_pembuatan' => $row->thn_pembuatan,
                //'id_biodata' => $row->id_biodata,

                'nm_merek_kendaraan' => $row->JkendaraanMerek->nm_merek_kendaraan,
                'nm_type_kendaraan' => $row->JkendaraanType->nm_type_kendaraan,
                'file_kir' => $row->file_kir,
                'file_stnk' => $row->file_stnk,
                'warna_tnkb' => $row->warna_tnkb,
                'bahan_bakar' => $row->bahan_bakar,
                'nmr_faktur_jual_beli' => $row->nmr_faktur_jual_beli,
                'tgl_faktur_jual_beli' => ($row->tgl_faktur_jual_beli ? cek_date_ddmmyyyy_his_v2($row->tgl_faktur_jual_beli) : ''),


            ];
            return response()->json($data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function showUploadDokumenBiodata($id)
    {
        if (request()->ajax()) {
            $rowKendaraan = DataKendaraanModel::where('id_kendaraan', $id)->first();
            $data = [
                'rowKendaraan' => $rowKendaraan,
            ];
            return view('private.permohonan_pengajuan.getShowUpload', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function edit(PengajuanPermohonanModel $pengajuanPermohonanModel)
    {
        //
    }


    public function update(Request $request, PengajuanPermohonanModel $pengajuanPermohonanModel)
    {
        //
    }

    public function destroy(PengajuanPermohonanModel $pengajuanPermohonanModel)
    {
        //
    }
}
