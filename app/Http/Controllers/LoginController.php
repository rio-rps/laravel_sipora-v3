<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAktivasiAkunModel;
use App\Models\UserLogModel;
use App\Models\UserRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        if ($r->ajax()) {
            $validator = Validator::make($r->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ], [
                'email.required' => 'Email tidak boleh kosong.',
                'email.email' => 'Format email tidak valid.',
                'password.required' => 'Password tidak boleh kosong.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            $kredensial = $r->only('email', 'password');



            if (Auth::attempt($kredensial)) {

                $user = Auth::user();
                if ($user->stts_user == 4) {
                    $r->session()->regenerate();
                    $id = User::where('email', $r->email)->first()->id;
                    UserLogModel::create([
                        'id_user' => $id,
                        'aktivitas' => 'Login Berhasil, Silakan Ganti Password Karena Termasuk kategori Lemah (Created By System)!',
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Login Berhasil, Silakan Ganti Password Karena Termasuk kategori Lemah (Created By System)!',
                        'route' => url('/cekpassword/password'),
                        'action' => 'register_success'
                    ]);
                    // } elseif ($user->stts_user == 1 or $user->stts_user == 4) {
                    //     $r->session()->regenerate();
                    //     // Periksa apakah password masih default atau terlalu lemah

                    //     $password = $r->password;
                    //     if ($r->password == '123456') {

                    //         $id = User::where('email', $r->email)->first()->id;
                    //         UserLogModel::create([
                    //             'id_user' => $id,
                    //             'aktivitas' => 'Login Berhasil, Silakan Ganti Password Karena Termasuk kategori Lemah!',
                    //         ]);

                    //         user::where('id', $id)->update([
                    //             'stts_user' => 4,
                    //         ]);

                    //         return response()->json([
                    //             'success' => true,
                    //             'message' => 'Login Berhasil, Silakan Ganti Password Karena Termasuk kategori Lemah!',
                    //             'route' => url('/cekpassword/password'),
                    //             'action' => 'register_success'
                    //         ]);
                    //     }


                    //     $id = User::where('email', $r->email)->first()->id;
                    //     UserLogModel::create([
                    //         'id_user' => $id,
                    //         'aktivitas' => 'Login Sistem Berhasil.',
                    //     ]);


                    //     return response()->json([
                    //         'success' => true,
                    //         'message' => 'Login Berhasil',
                    //         'route' => url('/panel'),
                    //         'action' => 'register_success'
                    //     ]);
                    // } 
                } elseif ($user->stts_user == 1) {
                    $r->session()->regenerate();

                    $password = $r->password;

                    // Daftar password lemah
                    $passLemah = [
                        '123456',
                        '12345',
                        '1234',
                        'password',
                        'qwerty',
                        'admin',
                    ];

                    // Tentukan status kekuatan password
                    if (strlen($password) < 8) {
                        $statusPassword = 4; // lemah
                    } elseif (in_array(strtolower($password), array_map('strtolower', $passLemah))) {
                        $statusPassword = 4; // lemah
                    } elseif (
                        !preg_match('/[A-Z]/', $password) ||   // huruf besar
                        !preg_match('/[a-z]/', $password) ||   // huruf kecil
                        !preg_match('/[0-9]/', $password) ||   // angka
                        !preg_match('/[\W_]/', $password)      // simbol
                    ) {
                        $statusPassword = 4; // lemah
                    } else {
                        $statusPassword = 1; // kuat
                    }

                    // Jika password lemah → arahkan untuk ganti password
                    if ($statusPassword == 4) {

                        $id = User::where('email', $r->email)->first()->id;

                        UserLogModel::create([
                            'id_user'   => $id,
                            'aktivitas' => 'Login Berhasil, Silakan Ganti Password Karena Termasuk kategori Lemah!',
                        ]);

                        User::where('id', $id)->update([
                            'stts_user' => 4,
                        ]);

                        return response()->json([
                            'success' => true,
                            'message' => 'Login Berhasil, Silakan Ganti Password Karena Termasuk kategori Lemah!',
                            'route'   => url('/cekpassword/password'),
                            'action'  => 'register_success'
                        ]);
                    }

                    // Jika password kuat → login normal
                    $id = User::where('email', $r->email)->first()->id;
                    UserLogModel::create([
                        'id_user' => $id,
                        'aktivitas' => 'Login Sistem Berhasil.',
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Login Berhasil',
                        'route' => url('/panel'),
                        'action' => 'register_success'
                    ]);
                } else if ($user->stts_user == 2) {

                    $id = User::where('email', $r->email)->first()->id;
                    UserLogModel::create([
                        'id_user' => $id,
                        'aktivitas' => 'Akun Login di Bokir',
                    ]);

                    return response()->json([
                        'error' => true,
                        'message' => 'Mohon Maaf User Anda diBlokir, Hubungi Admin.',
                    ]);
                } else if ($user->stts_user == 3) {
                    $r->session()->regenerate();
                    $id = User::where('email', $r->email)->first()->id;
                    UserLogModel::create([
                        'id_user' => $id,
                        'aktivitas' => 'Login Berhasil, Silakan Ganti Password (Created By System)!',
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Login Berhasil, Silakan Ganti Password (Created By System)!',
                        'route' => url('/cekpassword/password'),
                        'action' => 'register_success'
                    ]);
                }
            } else {


                $id = User::where('email', $r->email)->first()->id;
                UserLogModel::create([
                    'id_user' => $id,
                    'aktivitas' => 'Login Gagal. Email atau password salah.',
                ]);


                return response()->json([
                    'error' => true,
                    'message' => 'Login Gagal. Email atau password salah.',
                ]);
            }
        } else {
            $id = User::where('email', $r->email)->first()->id;
            UserLogModel::create([
                'id_user' => $id,
                'aktivitas' => 'Maaf, permintaan tidak valid.',
            ]);

            return response()->json([
                'error' => true,
                'message' => 'Maaf, permintaan tidak valid.',
            ], 400);
        }
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
