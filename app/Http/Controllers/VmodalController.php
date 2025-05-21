<?php

namespace App\Http\Controllers;

use App\Models\BparKabKotaModel;
use Illuminate\Http\Request;

class VmodalController extends Controller
{
    public function show_kabkota(Request $r)
    {
        if (request()->ajax()) {

            $data = [
                'act' => $r->act,
                'title_form' => 'PILIH DATA KAB/ KOTA',
                'result' =>  BparKabKotaModel::get()
            ];
            return view('private.vmodal.show_kabkota', $data);
        } else {
            exit('Maaf, request tidak dapat diproses');
        }
    }
}
