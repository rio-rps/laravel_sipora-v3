<?php

namespace App\Http\Controllers;

use App\Models\DataUserModel;
use App\Models\UserLogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hostname;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $comp = [
            'content' => view('public.content.content-register', [
                'title' => '',
            ]),
        ];
        return view('public.layout.main', $comp);
    }

    public function store_register(Request $r)
    {
        if (request()->ajax()) {
            $validator = Validator::make($r->all(), [
                'name' => 'required', // dari inputan
                'email' => [
                    'required',
                    'email',
                    function ($attribute, $value, $fail) {
                        $isUnique = DataUserModel::where('email', $value)
                            ->count() === 0;
                        if (!$isUnique) {
                            $fail('email sudah digunakan');
                        }
                    }
                ],
                'g-recaptcha-response' => 'required|captcha',
            ], [
                'name.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'g-recaptcha-response.required' => 'Captcha harus diisi!',
                'g-recaptcha-response.captcha' => 'Captcha tidak valid!',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors(),
                ], 422);
            } else {
                $name = $r->name;
                $email = $r->email;
                // $passwordPlain = Str::random(8); // simpan password plain utk email
                // $passwordHash = Hash::make($passwordPlain); // hash untuk database

                $passwordPlain = generateStrongPassword(8);
                $passwordHash = Hash::make($passwordPlain);


                $user = DataUserModel::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $passwordHash,
                    'level' => '3',
                ]);
                $id =  $user->id;
                UserLogModel::create([
                    'id_user' => $id,
                    'aktivitas' => 'Berhasil Buat Akun Login.',
                ]);

                try {

                    //kirim ke clien
                    // $name = strtoupper($name);
                    // Mail::html("
                    //     <p>Halo {$name},</p>
                    //     <p>Akun Anda berhasil didaftarkan.</p>
                    //     <p>Berikut adalah password default Anda: <strong>{$passwordPlain}</strong></p>
                    //     <p>Silakan login dan segera ubah password Anda demi keamanan akun.</p>
                    //     <p>Terima kasih.</p>
                    // ", function ($message) use ($email) {
                    //     $message->to($email)
                    //         ->subject('REGISTER AKUN SIPORA')
                    //         ->from(config('mail.from.address'), config('mail.from.name'));
                    // });


                    //kirim client dan vendor email
                    $name = strtoupper($name);
                    $subject = 'REGISTER AKUN SIPORA';

                    $body = "
                        <p>Halo {$name},</p>
                        <p>Akun <strong>{$email}</strong> berhasil didaftarkan di Aplikasi SIPORA.</p>
                        <p>Berikut adalah password default Anda: <strong>{$passwordPlain}</strong></p>
                        <p>Silakan login dan segera ubah password Anda demi keamanan akun.</p>
                        <p>Terima kasih.</p>
                    ";

                    Mail::html($body, function ($message) use ($email, $subject) {
                        $message->to($email)
                            ->subject($subject)
                            ->from(config('mail.from.address'), config('mail.from.name'))
                            ->bcc(config('mail.from.address')); // BCC ke pengirim
                    });
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Gagal kirim email: ' . $e->getMessage());
                }

                // Kirim response ke frontend
                return response()->json([
                    'success' => true,
                    'message' => 'Register Akun Berhasil',
                    'route' => route('register_success', ['name' => $name, 'email' => $email, 'passwordPlain' => $passwordPlain]),
                    'action' => 'register_success',
                ]);
            }
        } else {
            exit('Maaf Tidak Dapat diproses...');
        }
    }


    public function register_success(Request $r)
    {
        $comp = [
            'content' => view('public.content.content-register-success', [
                'name' => $r->name,
                'email' => $r->email,
                'passwordPlain' => $r->passwordPlain,
            ]),
        ];
        return view('public.layout.main', $comp);
    }

    // public function index()
    // {
    //     return view('login.view_register');
    // }

    // public function do_register(Request $r)
    // {
    //     $r->validate(
    //         [
    //             'name' => 'required', // dari inputan
    //             'email' => 'required|email', // dari inputan 
    //         ],
    //         [
    //             'name.required' => 'Nama tidak boleh kosong',
    //             'email.required' => 'Email tidak boleh kosong',
    //             'email.email' => 'Format Email Salah',
    //         ],
    //     );

    //     $cek = DataUserModel::where('email', $r->email)->count();

    //     if ($cek > 0) {
    //         return back()->withErrors([
    //             'keterangan' => "Email sudah terdaftar di database, gunakan email lain"
    //         ]);
    //     } else {
    //         DataUserModel::create([
    //             'name' => $r->name,
    //             'email' => $r->email,
    //             'password' =>  bcrypt('123456'),
    //             'level' => '3'
    //         ]);

    //         return redirect()->route('success', [
    //             'name' => $r->name,
    //             'email' => $r->email,
    //         ]);
    //     }
    // }

    // public function success($name, $email)
    // {
    //     $data = [
    //         'name' => $name,
    //         'email' => $email,
    //     ];
    //     return view('private/aktivasi_akun/sukses_daftar', $data);
    // }
}
