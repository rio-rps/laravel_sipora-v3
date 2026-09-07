<?php

namespace App\Http\Controllers;

use App\Models\PengaturanAkunModel;
use App\Models\UserLogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PengaturanAkunController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'PENGATURAN AKUN',
        ];
        return view('private/pengaturan_akun/view')->with($data);
    }

    public function updatepassword(Request $r, $id)
    {
        if (request()->ajax()) {

            $validator = Validator::make(
                $r->all(),
                [
                    'password_old' => 'required',
                    'password_new' => 'required|min:8|confirmed',
                ],
                [
                    'password_old.required' => 'Password lama tidak boleh kosong.',
                    'password_new.required' => 'Password baru tidak boleh kosong.',
                    'password_new.min' => 'Password baru minimal 8 karakter.',
                    'password_new.confirmed' => 'Konfirmasi password baru tidak sama.',
                ],
            );

            $validator->after(function ($validator) use ($r) {

                $password = $r->password_new;

                if (!preg_match('/[A-Z]/', $password)) {
                    $validator->errors()->add(
                        'password_new',
                        'Password harus mengandung setidaknya satu huruf besar.'
                    );
                }

                if (!preg_match('/[a-z]/', $password)) {
                    $validator->errors()->add(
                        'password_new',
                        'Password harus mengandung setidaknya satu huruf kecil.'
                    );
                }

                if (!preg_match('/\d/', $password)) {
                    $validator->errors()->add(
                        'password_new',
                        'Password harus mengandung setidaknya satu angka.'
                    );
                }

                if (!preg_match('/[@$!%*#?&.,:;^_\-]/', $password)) {
                    $validator->errors()->add(
                        'password_new',
                        'Password harus mengandung setidaknya satu simbol.'
                    );
                }
            });

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            $userdata = PengaturanAkunModel::find($id);

            if (!$userdata) {
                return response()->json([
                    'errors' => [
                        'password_old' => ['Data pengguna tidak ditemukan.']
                    ]
                ], 404);
            }

            /*
            |--------------------------------------------------------------------------
            | CEK PASSWORD LAMA
            |--------------------------------------------------------------------------
            */

            if (!Hash::check($r->password_old, $userdata->password)) {

                return response()->json([
                    'errors' => [
                        'password_old' => ['Password Lama Salah']
                    ]
                ], 422);
            }


            /*
            |--------------------------------------------------------------------------
            | PASSWORD BARU TIDAK BOLEH SAMA DENGAN PASSWORD LAMA
            |--------------------------------------------------------------------------
            */

            if (Hash::check($r->password_new, $userdata->password)) {

                return response()->json([
                    'errors' => [
                        'password_new' => [
                            'Password baru tidak boleh sama dengan password lama.'
                        ]
                    ]
                ], 422);
            }


            /*
            |--------------------------------------------------------------------------
            | UPDATE PASSWORD
            |--------------------------------------------------------------------------
            */

            PengaturanAkunModel::where('id', $id)->update([
                'password' => bcrypt($r->password_new),
                'password_changed_at' => now(),
                'stts_user' => 1,
            ]);


            /*
            |--------------------------------------------------------------------------
            | LOG
            |--------------------------------------------------------------------------
            */

            UserLogModel::create([
                'id_user' => $id,
                'aktivitas' => 'Password Berhasil diganti.',
            ]);


            return response()->json([
                'success' => 'Password Berhasil diubah',
                'route' => route('logout'),
                'myReload' => 'ReloadPassword'
            ]);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function updateemail(Request $r)
    {
        if (request()->ajax()) {
            $validator = Validator::make(
                $r->all(),
                [
                    'email' => 'required|email|unique:users,email',
                ],
                [
                    'email.required' => 'Email tidak boleh kosong.',
                    'email.unique' => 'Email Sudah di gunakan.',
                    'email.email' => 'Format Email Salah.',
                ],
            );

            if ($validator->fails()) {
                $errors = $validator->errors();
                return response()->json(['errors' => $errors], 422);
            } else {
                PengaturanAkunModel::where('id', $r->id)->update([
                    'email' => $r->email,
                ]);
                return response()->json(['success' => 'Email Berhasil diubah', 'email' => $r->email, 'myReload' => 'no']);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
