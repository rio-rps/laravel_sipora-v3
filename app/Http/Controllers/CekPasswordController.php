<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CekPasswordController extends Controller
{
    public function password()
    {
        $user = Auth::user();

        $jenisPeringatan = null;

        /*
        |--------------------------------------------------------------------------
        | STATUS USER 3
        | Password dibuat oleh sistem
        |--------------------------------------------------------------------------
        */

        if ($user->stts_user == 3) {
            $jenisPeringatan = 'password_baru';
        }
        /*
        |--------------------------------------------------------------------------
        | STATUS USER 4
        |--------------------------------------------------------------------------
        */ elseif ($user->stts_user == 4) {
            // Jika password_changed_at belum ada
            if (!$user->password_changed_at) {
                $jenisPeringatan = 'password_belum_diubah';
            }

            // Jika password sudah lebih dari 30 hari
            elseif (Carbon::parse($user->password_changed_at)->addDays(30)->isPast()) {
                $jenisPeringatan = 'password_expired';
            }

            // Jika belum 30 hari → password lemah
            else {
                $jenisPeringatan = 'password_lemah';
            }
        }

        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        $data = [
            'jenisPeringatan' => $jenisPeringatan,
        ];

        return view('private.info_user.ganti_password', $data);
    }
}
