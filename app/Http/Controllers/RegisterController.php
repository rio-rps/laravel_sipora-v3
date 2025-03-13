<?php

namespace App\Http\Controllers;

use App\Models\DataUserModel;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('login.view_register');
    }

    public function do_register(Request $r)
    {
        $r->validate(
            [
                'name' => 'required', // dari inputan
                'email' => 'required|email', // dari inputan 
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Format Email Salah',
            ],
        );

        $cek = DataUserModel::where('email', $r->email)->count();

        if ($cek > 0) {
            return back()->withErrors([
                'keterangan' => "Email sudah terdaftar di database, gunakan email lain"
            ]);
        } else {
            DataUserModel::create([
                'name' => $r->name,
                'email' => $r->email,
                'password' =>  bcrypt('123456'),
                'level' => '3'
            ]);

            return redirect()->route('success', [
                'name' => $r->name,
                'email' => $r->email,
            ]);
        }
    }

    public function success($name, $email)
    {
        $data = [
            'name' => $name,
            'email' => $email,
        ];
        return view('private/aktivasi_akun/sukses_daftar', $data);
    }
}
