<?php

namespace App\Http\Controllers;

use App\Models\BparKabKotaModel;
use App\Models\PICModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PICController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'DATA PIC KABKOTA',
        ];
        return view('private.PIC.view')->with($data);
    }


    public function create(Request $r)
    {
        if (request()->ajax()) {
            $row = PICModel::where('kode_provinsi', $r->kode_provinsi)->where('kode_kabkota', $r->kode_kabkota)->first();
            $kabkota =  BparKabKotaModel::where('kode_provinsi', $r->kode_provinsi)->where('kode_kabkota', $r->kode_kabkota)->first();
            $data = [
                'title'   => "ISI DATA PIC",
                'row'     => $row,
                'kabkota' => $kabkota
            ];
            return view('private.PIC.formadd', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function store(Request $r)
    {
        if (request()->ajax()) {
            $validator = Validator::make($r->all(), [
                'no_tlp1' =>  'required',
                'no_tlp2' =>  'required',
            ], [
                'no_tlp1.required' => 'No Telp 1 Tidak Boleh Kosong',
                'no_tlp2.required' => 'No Telp 2 Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = PICModel::create([
                    'kode_provinsi'  => $r->kode_provinsi,
                    'kode_kabkota'  => $r->kode_kabkota,
                    'no_tlp1'  => $r->no_tlp1,
                    'no_tlp2'  => $r->no_tlp2,
                ]);
                return response()->json([
                    'success' => 'Data berhasil disimpan',
                    'myReload' => 'PIC'
                ]);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PICModel  $pICModel
     * @return \Illuminate\Http\Response
     */
    public function show(PICModel $r)
    {
        if (request()->ajax()) {
            $result = BparKabKotaModel::select(
                'bpar_002_kabkota.nm_kabkota',
                'bpar_002_kabkota.kode_provinsi as kode_provinsix',
                'bpar_002_kabkota.kode_kabkota as kode_kabkotax',
                'bpar_002_kabkota.*',
                'hhh_PIC.*'
            )
                ->leftJoin('hhh_PIC', function ($join) {
                    $join->on('hhh_PIC.kode_provinsi', '=', 'bpar_002_kabkota.kode_provinsi');
                    $join->on('hhh_PIC.kode_kabkota', '=', 'bpar_002_kabkota.kode_kabkota');
                });
            $data = [
                'result' => $result->get(),

            ];
            return view('private.PIC.show', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function edit(PICModel $pICModel)
    {
        //
    }

    public function update(Request $r, $id)
    {

        if (request()->ajax()) {
            $validator = Validator::make($r->all(), [
                'no_tlp1' =>  'required',
                'no_tlp2' =>  'required',
            ], [
                'no_tlp1.required' => 'No Telp 1 Tidak Boleh Kosong',
                'no_tlp2.required' => 'No Telp 2 Tidak Boleh Kosong',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                $post = PICModel::where('id_pic', $id)->update([
                    'no_tlp1'  => $r->no_tlp1,
                    'no_tlp2'  => $r->no_tlp2,
                ]);
                return response()->json([
                    'success' => 'Data berhasil diupdate',
                    'myReload' => 'PIC'
                ]);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PICModel  $pICModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PICModel $pICModel)
    {
        //
    }
}
