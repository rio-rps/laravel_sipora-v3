<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CekPasswordController extends Controller
{
    public function password()
    {

        $data = [];
        return view('private.info_user.ganti_password', $data);
    }
}
