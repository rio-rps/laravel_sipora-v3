<?php

namespace App\Http\Controllers;

use App\Models\TTDDokumenModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TTDDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => "TANDA TANGAN DOKUMEN PIMPINAN",
            'row' => TTDDokumenModel::where('kode_jabatan', '1')->first(),
        ];
        return view('private/ttd_dokumen/view')->with($data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TTDDokumenModel  $tTDDokumenModel
     * @return \Illuminate\Http\Response
     */
    public function show(TTDDokumenModel $tTDDokumenModel)
    {
        //
    }

    public function edit(Request $r, $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TTDDokumenModel  $tTDDokumenModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $validator = Validator::make($r->all(), [
            'nm_ttd' => 'required',
            'pangkat_gol' => 'required',
            'nip_ttd' => 'required',
            'jabatan_ttd' => 'required',
        ], [
            'nm_ttd.required' => 'Nama TTD Tidak Boleh Kosong',
            'pangkat_gol.required' => 'Pangkat Gol Tidak Boleh Kosong',
            'nip_ttd.required' => 'Nip Tidak Boleh Kosong',
            'jabatan_ttd.required' => 'Jabatan Tidak Boleh Kosong',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['errors' => $errors], 422);
        } else {
            $post = TTDDokumenModel::where('id_ttd_dok', $id)->update([
                'nm_ttd'  => $r->nm_ttd,
                'pangkat_gol'  => $r->pangkat_gol,
                'nip_ttd'  => $r->nip_ttd,
                'jabatan_ttd'  => $r->jabatan_ttd,
            ]);
            // return response()->json(['success' => 'Data berhasil diedit']);
            return redirect()->route('ttddokumen.index')->with([
                'status' => 'Berhasil',
                'message' => 'Data berhasil diupdate',
                'icon' => 'success',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TTDDokumenModel  $tTDDokumenModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(TTDDokumenModel $tTDDokumenModel)
    {
        //
    }
}
