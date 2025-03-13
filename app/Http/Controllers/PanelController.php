<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use App\Models\PostModel;
use App\Models\UserAktivasiAkunModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function index()
    {
        //AktivasiAkunHelper();
        if (Auth::user()) {
            $data = [];
            return view('private.layout.beranda', $data);
        } else {
            return redirect('/login');
        }
    }
}
