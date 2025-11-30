<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QrcodeController extends Controller
{

    public function index(Request $r)
    {


        $data = [
            'title' => 'SCAN QR CODE ANDA',
        ];
        return view('private.qrcode.view')->with($data);
    }
}
