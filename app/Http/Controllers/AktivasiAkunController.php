<?php

namespace App\Http\Controllers;

use App\Models\UserAktivasiAkunModel;
use App\Models\UserRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AktivasiAkunController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'AKTIVASI AKUN',
        ];
        return view('private.aktivasi_akun.view')->with($data);
    }

    public function store(Request $r)
    {

        $id_user = Auth::user()->id;
        $post =  UserAktivasiAkunModel::create([
            'id_user'  => $id_user,
            'id_biodata' => "2",
            'level' => "3"
        ]);
        return redirect()->route('panel.index')->with([
            'status' => 'Berhasil',
            'message' => 'Aktivasi Akun Berhasil',
            'icon' => 'success',
        ]);
    }
}
