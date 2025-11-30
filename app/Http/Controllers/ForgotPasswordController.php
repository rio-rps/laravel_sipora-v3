<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordLink;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    public function sendResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak terdaftar dalam sistem.',
        ]);

        $token = Str::random(64);

        // Simpan token ke tabel password_resets
        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now(),
            ]
        );


        // $resetUrl = url("/reset-password/{$token}?email={$request->email}");
        // Kirim email manual
        // Mail::send('mail.reset-password-link', ['url' => $resetUrl], function ($message) use ($request) {
        //     $message->to($request->email);
        //     $message->subject('Link Reset Password SIPORA');
        // });
        $resetUrl = url("/reset-password/{$token}?email={$request->email}");
        Mail::to($request->email)
            ->bcc(config('mail.from.address'))
            ->send(new ResetPasswordLink($resetUrl, $request->email));

        // Kirim response ke frontend
        return response()->json([
            'success' => true,
            'message' => 'Link Reset Password sudah dikirim, silakan cek email Anda pada kotak masuk/spam',
            //'route' => route('register_success', ['name' => $name, 'email' => $email]),
            'action' => 'hide_resetpassword',
        ]);
    }

    public function showResetPasswordForm(Request $r, $token = null)
    {
        $comp = [
            'content' => view('mail.reset-password-form', [
                'token' => $token,
                'email' => $r->email
            ]),
        ];
        return view('public.layout.main', $comp);
    }


    public function resetPassword(Request $r)
    {
        if ($r->ajax()) {
            $validator = Validator::make($r->all(), [
                'email' => 'required|email|exists:users,email',
                'token' => 'required',
                'password' => [
                    'required',
                    'min:8',
                    'confirmed',
                ],
            ], [
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password tidak sama',
            ]);

            $validator->after(function ($validator) use ($r) {
                $password = $r->password;

                if (!preg_match('/[A-Z]/', $password)) {
                    $validator->errors()->add('password', ' Password harus mengandung setidaknya satu huruf besar');
                }

                if (!preg_match('/[a-z]/', $password)) {
                    $validator->errors()->add('password', ' Password harus mengandung setidaknya satu huruf kecil');
                }

                if (!preg_match('/\d/', $password)) {
                    $validator->errors()->add('password', ' Password harus mengandung setidaknya satu angka');
                }

                if (!preg_match('/[@$!%*#?&.,:;^_\-]/', $password)) {
                    $validator->errors()->add('password', ' Password harus mengandung setidaknya satu simbol');
                }
            });

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Cek token dan email cocok di tabel password_resets
            $passwordReset = DB::table('password_resets')
                ->where('email', $r->email)
                ->where('token', $r->token)
                ->first();

            if (!$passwordReset) {
                return response()->json([
                    'success' => false,
                    'message' => 'Token reset tidak valid atau email tidak sesuai.',
                ], 400);
            }

            // Lanjut reset password
            $user = User::where('email', $r->email)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Pengguna tidak ditemukan.',
                ], 404);
            }

            $user->password = Hash::make($r->password);
            $user->setRememberToken(Str::random(60));
            $user->save();

            // Hapus token dari table
            DB::table('password_resets')->where('email', $r->email)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Reset berhasil, silakan login dengan password baru Anda.',
                'route' => route('login'),
                'action' => 'reset_success',
            ]);
        } else {
            abort(403, 'Tidak dapat diproses.');
        }
    }



    public function mshow_lupa_email()
    {
        if (request()->ajax()) {
            $data = [];
            return view('public.content.mshow-lupa-email', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }

    public function mshow_lupa_password()
    {
        if (request()->ajax()) {
            $data = [];
            return view('public.content.mshow-lupa-password', $data);
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }
}
