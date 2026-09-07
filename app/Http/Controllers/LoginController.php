<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAktivasiAkunModel;
use App\Models\UserLogModel;
use App\Models\UserRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{


    public function login()
    {
        //echo bcrypt(password);
        $comp = [
            'content' => view('public.content.content-login'),
        ];
        return view('public.layout.main', $comp);
    }

    public function proses(Request $r)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDASI REQUEST AJAX
        |--------------------------------------------------------------------------
        */

        if (!$r->ajax()) {
            return response()->json([
                'error'   => true,
                'message' => 'Maaf, permintaan tidak valid.',
            ], 400);
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDASI INPUT
        |--------------------------------------------------------------------------
        */

        $validator = Validator::make(
            $r->all(),
            [
                'email'    => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required'    => 'Email tidak boleh kosong.',
                'email.email'       => 'Format email tidak valid.',
                'password.required' => 'Password tidak boleh kosong.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | KREDENSIAL LOGIN
        |--------------------------------------------------------------------------
        */

        $credentials = [
            'email'    => $r->email,
            'password' => $r->password,
        ];


        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN
        |--------------------------------------------------------------------------
        */

        if (!Auth::attempt($credentials)) {

            // Cari user berdasarkan email
            $userLogin = User::where('email', $r->email)->first();

            // Simpan log jika email ditemukan
            if ($userLogin) {
                UserLogModel::create([
                    'id_user'   => $userLogin->id,
                    'aktivitas' => 'Login Gagal ' . $r->email .
                        '. Email atau password salah.',
                ]);
            } else {
                UserLogModel::create([
                    'id_user'   => null,
                    'aktivitas' => 'Login Gagal ' . $r->email .
                        '. Email atau password salah.',
                ]);
            }

            return response()->json([
                'error'   => true,
                'message' => 'Login Gagal. Email atau password salah.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | LOGIN BERHASIL
        |--------------------------------------------------------------------------
        */

        $user = Auth::user();


        /*
        |--------------------------------------------------------------------------
        | USER DIBLOKIR
        |--------------------------------------------------------------------------
        */

        if ($user->stts_user == 2) {

            UserLogModel::create([
                'id_user'   => $user->id,
                'aktivitas' => 'Percobaan Login Akun Diblokir: ' . $user->email,
            ]);

            // Logout karena akun diblokir
            Auth::logout();

            return response()->json([
                'error'   => true,
                'message' => 'Mohon Maaf, User Anda Diblokir. Hubungi Admin.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | REGENERATE SESSION
        |--------------------------------------------------------------------------
        */

        $r->session()->regenerate();


        /*
        |--------------------------------------------------------------------------
        | STATUS 3
        | PASSWORD BARU DIBUAT OLEH SISTEM
        |--------------------------------------------------------------------------
        */

        if ($user->stts_user == 3) {

            UserLogModel::create([
                'id_user'   => $user->id,
                'aktivitas' => 'Login Berhasil ' . $user->email .
                    ', pengguna diwajibkan mengganti password (Created By System).',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil, Silakan Ganti Password Terlebih Dahulu.',
                'route'   => url('/cekpassword/password'),
                'action'  => 'register_success',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS 4
        | PASSWORD LEMAH / 30 hari lewat/ null tgl h30 hari/ WAJIB GANTI PASSWORD
        |--------------------------------------------------------------------------
        */

        if ($user->stts_user == 4) {

            /*
            |--------------------------------------------------------------------------
            | PASSWORD BELUM MEMILIKI TANGGAL PERUBAHAN
            |--------------------------------------------------------------------------
            */

            if (!$user->password_changed_at) {

                UserLogModel::create([
                    'id_user'   => $user->id,
                    'aktivitas' => 'Login Berhasil ' . $user->email .
                        ', tanggal perubahan password belum tersedia. Pengguna diwajibkan mengganti password.',
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Silakan ganti password terlebih dahulu untuk keamanan akun.',
                    'route'   => url('/cekpassword/password'),
                    'action'  => 'register_success',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | PASSWORD SUDAH LEWAT 30 HARI
            |--------------------------------------------------------------------------
            */

            if (
                Carbon::parse($user->password_changed_at)
                ->addDays(30)
                ->isPast()
            ) {

                UserLogModel::create([
                    'id_user'   => $user->id,
                    'aktivitas' => 'Login Berhasil ' . $user->email .
                        ', Password telah melewati masa berlaku 30 hari. Pengguna diwajibkan mengganti password.',
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Password Anda telah melewati masa berlaku 30 hari. Silakan ganti password terlebih dahulu.',
                    'route'   => url('/cekpassword/password'),
                    'action'  => 'register_success',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | STATUS 4 KARENA PASSWORD LEMAH
            |--------------------------------------------------------------------------
            */

            UserLogModel::create([
                'id_user'   => $user->id,
                'aktivitas' => 'Login Berhasil ' . $user->email .
                    ', pengguna diwajibkan mengganti password karena password lemah.',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil, Silakan Ganti Password Karena Password Termasuk Kategori Lemah!',
                'route'   => url('/cekpassword/password'),
                'action'  => 'register_success',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS 1
        | USER AKTIF
        |--------------------------------------------------------------------------
        */

        if ($user->stts_user == 1) {


            /*
            |--------------------------------------------------------------------------
            | CEK PASSWORD_CHANGED_AT
            |--------------------------------------------------------------------------
            |
            | Jika NULL:
            | Untuk keamanan, wajib ganti password.
            |
            */

            if (!$user->password_changed_at) {

                UserLogModel::create([
                    'id_user'   => $user->id,
                    'aktivitas' => 'Password belum memiliki tanggal perubahan. Pengguna diwajibkan mengganti password.',
                ]);

                User::where('id', $user->id)->update([
                    'stts_user' => 4,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Silakan ganti password terlebih dahulu untuk keamanan akun.',
                    'route'   => url('/cekpassword/password'),
                    'action'  => 'register_success',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | CEK MASA BERLAKU PASSWORD
            |--------------------------------------------------------------------------
            |
            | Password berlaku selama 30 hari.
            |
            */

            if (
                Carbon::parse($user->password_changed_at)
                ->addDays(30)
                ->isPast()
            ) {

                UserLogModel::create([
                    'id_user'   => $user->id,
                    'aktivitas' => 'Login Berhasil, Password telah melewati masa berlaku 30 hari. Akun: ' .
                        $user->email .
                        '. Pengguna diwajibkan mengganti password.',
                ]);

                // Ubah status menjadi wajib ganti password
                User::where('id', $user->id)->update([
                    'stts_user' => 4,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Password Anda telah melewati masa berlaku 30 hari. Silakan ganti password terlebih dahulu.',
                    'route'   => url('/cekpassword/password'),
                    'action'  => 'register_success',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | CEK KEKUATAN PASSWORD
            |--------------------------------------------------------------------------
            */

            $password = $r->password;


            /*
            |--------------------------------------------------------------------------
            | DAFTAR PASSWORD LEMAH
            |--------------------------------------------------------------------------
            */

            $passLemah = [
                '123456',
                '12345',
                '1234',
                'password',
                'qwerty',
                'admin',
                'sipora01#@!A',
            ];


            /*
            |--------------------------------------------------------------------------
            | VALIDASI PASSWORD
            |--------------------------------------------------------------------------
            */

            $passwordLemah =
                strlen($password) < 8 ||

                in_array(
                    strtolower($password),
                    array_map('strtolower', $passLemah)
                ) ||

                !preg_match('/[A-Z]/', $password) ||
                !preg_match('/[a-z]/', $password) ||
                !preg_match('/[0-9]/', $password) ||
                !preg_match('/[\W_]/', $password);


            /*
            |--------------------------------------------------------------------------
            | PASSWORD LEMAH
            |--------------------------------------------------------------------------
            */

            if ($passwordLemah) {

                UserLogModel::create([
                    'id_user'   => $user->id,
                    'aktivitas' => 'Login Berhasil ' . $user->email .
                        ', pengguna diwajibkan mengganti password karena password termasuk kategori lemah.',
                ]);

                User::where('id', $user->id)->update([
                    'stts_user' => 4,
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Login Berhasil, Silakan Ganti Password Karena Password Termasuk Kategori Lemah!',
                    'route'   => url('/cekpassword/password'),
                    'action'  => 'register_success',
                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | LOGIN NORMAL
            |--------------------------------------------------------------------------
            */

            UserLogModel::create([
                'id_user'   => $user->id,
                'aktivitas' => 'Login Sistem Berhasil ' . $user->email . '.',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'route'   => url('/panel'),
                'action'  => 'register_success',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | STATUS USER TIDAK VALID
        |--------------------------------------------------------------------------
        */

        UserLogModel::create([
            'id_user'   => $user->id,
            'aktivitas' => 'Login ditolak karena status user tidak valid.',
        ]);

        Auth::logout();

        return response()->json([
            'error'   => true,
            'message' => 'Status akun tidak valid. Hubungi Administrator.',
        ]);
    }


    public function logout(Request $request)
    {

        $ids =  getIdUser();
        UserLogModel::create([
            'id_user' => $ids,
            'aktivitas' => 'Logout / Keluar Dari Sistem.',
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
