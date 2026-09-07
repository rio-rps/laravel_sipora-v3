<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLogModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MaintenanceLoginController extends Controller
{
    public function login()
    {
        //echo bcrypt(password);
        return view('maintenance.login');
    }

    public function proses(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email wajib diisi.',
                'password.required' => 'Password wajib diisi.',
            ]
        );

        // Cari user
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email atau password salah.');
        }

        // Cek password
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email atau password salah.');
        }

        // Cek level dan hak akses maintenance
        if (
            (int) $user->level !== 1 ||
            (int) $user->maintenance_access !== 1
        ) {

            // Logout langsung
            Auth::logout();

            // Hapus session maintenance jika ada
            $request->session()->forget([
                'maintenance_logged_in',
                'maintenance_user_id',
            ]);

            return redirect()
                ->route('maintenance.login')
                ->with('error', 'Anda tidak memiliki akses maintenance.');
        }

        // Session maintenance
        $request->session()->put([
            'maintenance_logged_in' => true,
            'maintenance_user_id' => $user->id,
        ]);

        // Regenerate session
        $request->session()->regenerate();

        // Pastikan session maintenance tetap ada setelah regenerate
        $request->session()->put([
            'maintenance_logged_in' => true,
            'maintenance_user_id' => $user->id,
        ]);

        return redirect()
            ->route('panel.index')
            ->with('success', 'Login maintenance berhasil.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->forget(['maintenance_logged_in', 'maintenance_user_id']);

        $request->session()->regenerateToken();

        return redirect()->route('maintenance.login')->with('success', 'Anda telah logout.');
    }
}
