<?php

namespace App\Http\Controllers;

use App\Models\BparKabKotaModel;
use App\Models\DataUserModel;
use App\Models\MyModel;
use App\Models\UserDataAksesKabKotaModel;
use App\Models\UserDataModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables as DataTables;


class UserDataAksesKabKotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $data = [
            'id' => $r->id,
            'title_form' => 'DATA KAB/ KOTA',
        ];
        return view('private.data_user_akses_kabkota.view', $data);
    }

    public function kabkota_pilih(Request $r)
    {
        if (request()->ajax()) {
            $result = BparKabKotaModel::get();
            $data = [
                'id' => $r->id,
                'result' => $result,
                'title_form' => 'PILIH DATA KAB/ KOTA',
            ];
            return view('private.data_user_akses_kabkota.datakabkota_pilih', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
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
    public function store(Request $r)
    {


        $row = DataUserModel::where('id', $r->id)->first();


        $kabkota = BparKabKotaModel::where('id_kabkota', $r->id_kabkota)->first();

        $cek = UserDataAksesKabKotaModel::where('kode_provinsi', $kabkota->kode_provinsi)
            ->where('kode_kabkota', $kabkota->kode_kabkota)
            ->where('id_user', $r->id)
            ->count();

        $cek2 = UserDataAksesKabKotaModel::where('id_user', $r->id)
            ->count();

        // if ($row->level == 2 and $cek2 >= 1) {
        //     return response()->json(['errors' => 'Kab/ Kota harus satu !'], 423);
        // }

        if ($cek > 0) {
            return response()->json(['errors' => 'Data sudah Ada'], 423);
        } else {
            $post = UserDataAksesKabKotaModel::create([
                'id_user' => $row->id,
                'kode_provinsi'  => $kabkota->kode_provinsi,
                'kode_kabkota'  => $kabkota->kode_kabkota,
            ]);
            return response()->json(['success' => 'Berhasil dipilih']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDataModel  $userDataModel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $r)
    {
        if (request()->ajax()) {
            return DataTables::of(UserDataAksesKabKotaModel::where('id_user', $r->id)->orderBy('kode_provinsi', 'ASC')->orderBy('kode_kabkota', 'ASC'))
                ->addColumn('action', 'private.data_user_akses_kabkota.action_pilihan')
                ->addColumn('kabkota', function ($row) {
                    $Mymodel = new MyModel();
                    $r = $Mymodel->MyTableKabkota($row->kode_provinsi, $row->kode_kabkota)->first();
                    return $r->nm_kabkota;
                })
                ->make(true);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDataModel  $userDataModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $userDataModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDataModel  $userDataModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Request $userDataModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDataModel  $userDataModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->ajax()) {
            UserDataAksesKabKotaModel::where('id_user_akses_kabkota', $id)->delete();
            return response()->json([
                'success' => 'Berhasil dihapus',
                'myReload' => 'userdataakses_destroy'
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
