<?php

namespace App\Http\Controllers;

use App\Models\BiodataModel;
use App\Models\BparBadanUsahaModel;
use App\Models\UserLogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables as DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BiodataController extends Controller
{

    public function createSlug($title)
    {
        $slug = Str::slug($title);
        $count = BiodataModel::whereRaw("slug_biodata  RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return ($count > 0) ? "{$slug}-{$count}" : $slug;
    }

    public function index()
    {


        if (getLevel() == 3) {
            if (in_array(getSttsUser(), ['2', '3', '4'])) {
                return redirect()->to('panel');
            }
        }

        $data = [
            'title' => 'DATA BIODATA',
            'id_user' => Auth::user()->id,
        ];
        return view('private/biodata/view')->with($data);
    }


    public function create(Request $r)
    {
        if (request()->ajax()) {

            $cek = BiodataModel::where('id_user', $r->id_user)->count();
            if ($cek > 0) {
                $biodata = BiodataModel::where('id_user', $r->id_user)->first();
            } else {
                $biodata = 0;
            }

            $data = [
                'id_user' => $r->id_user,
                'badanUsaha' => $biodata->id_badan_usaha ?? '0',
                'title_form' => 'FORM INPUT DATA BARU',
                'resultBadanUsaha' => BparBadanUsahaModel::orderBy('no_urut', 'ASC')->get(),
                'row' => $biodata,
            ];
            return view('private.biodata.formadd', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function store(Request $r)
    {
        if (request()->ajax()) {
            $validator = Validator::make($r->all(), [
                'id_badan_usaha' => 'required',
                'nm_perusahaan_personal' => 'required',
                'nm_pimpinan_pemilik' => 'required',
                'email' => 'required|email',
                'alamat_biodata' => 'required',
                'no_telp' => 'required|numeric',
            ], [
                'id_badan_usaha.required' => 'Nama Badan Usaha Tidak Boleh Kosong',
                'nm_perusahaan_personal.required' => 'Nama Perusahaan / Personal Tidak Boleh Kosong',
                'nm_pimpinan_pemilik.required' => 'Nama Pimpinan / Pemilik Tidak Boleh Kosong',
                'email.required' => 'Email Tidak Boleh Kosong',
                'email.email' => 'Format Email Salah.',
                'alamat_biodata.required' => 'Alamat Tidak Boleh Kosong',
                'no_telp.required' => 'No Telp / HP Tidak Boleh Kosong',
                'no_telp.numeric' => 'No Telp / HP Harus Angka',
            ]);

            $cek = BiodataModel::where('id_user', $r->id_user)->count();

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                if ($cek > 0) {

                    $ids =  $r->id_user;
                    UserLogModel::create([
                        'id_user' => $ids,
                        'aktivitas' => 'Melengkapi Biodata (Update).',
                    ]);


                    $post = BiodataModel::where('id_user', $r->id_user)->update([
                        'id_badan_usaha'  => $r->id_badan_usaha,
                        'nm_perusahaan_personal'  => $r->nm_perusahaan_personal,
                        'nm_pimpinan_pemilik'  => $r->nm_pimpinan_pemilik,
                        'email'  => $r->email,
                        'alamat_biodata'  => $r->alamat_biodata,
                        'no_telp'  => $r->no_telp,
                        'slug_biodata' => $this->createSlug($r->nm_perusahaan_personal),
                    ]);
                } else {

                    $ids =  $r->id_user;
                    UserLogModel::create([
                        'id_user' => $ids,
                        'aktivitas' => 'Melengkapi Biodata (Create).',
                    ]);

                    $post = BiodataModel::create([
                        'id_badan_usaha'  => $r->id_badan_usaha,
                        'nm_perusahaan_personal'  => $r->nm_perusahaan_personal,
                        'nm_pimpinan_pemilik'  => $r->nm_pimpinan_pemilik,
                        'email'  => $r->email,
                        'alamat_biodata'  => $r->alamat_biodata,
                        'no_telp'  => $r->no_telp,
                        'slug_biodata' => $this->createSlug($r->nm_perusahaan_personal),
                        'id_user'  => $r->id_user,
                        //'email'  => Auth::user()->email,
                    ]);
                }
                return response()->json(['success' => 'Data berhasil disimpan', 'action' => 'show']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }



    public function show($id)
    {
        if (request()->ajax()) {
            if (empty($id)) {
                $biodata = 0;
            } else {
                $biodata = BiodataModel::where('id_user', $id)->first();
            }
            $data = [
                'row' => $biodata
            ];
            return view('private.biodata.data', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function edit(BiodataModel $biodataModel)
    {
        //
    }


    public function update(Request $request, BiodataModel $biodataModel)
    {
        //
    }


    public function destroy(BiodataModel $biodataModel)
    {
        //
    }
}
