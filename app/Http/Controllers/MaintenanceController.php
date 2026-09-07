<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\MaintenanceModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    /**
     * Halaman pengaturan maintenance
     */
    public function index()
    {
        if (Auth::user()->maintenance_access == 1) {
            $maintenance = MaintenanceModel::first();

            // Kalau belum ada data, buat otomatis
            if (!$maintenance) {
                $maintenance = MaintenanceModel::create([
                    'status' => false,
                    'judul' => 'Sistem Dalam Pemeliharaan',
                    'pesan' => 'Sistem sedang dalam proses pemeliharaan. Silakan coba kembali beberapa saat lagi.',
                ]);
            }

            return view('private.maintenance.view', compact('maintenance'));
        } else {
            abort(404);
        }
    }

    /**
     * Update status dan informasi maintenance
     */
    public function update(Request $request)
    {
        if (Auth::user()->maintenance_access == 1) {
            $request->validate([
                'status' => 'required|boolean',
                'judul' => 'nullable|string|max:255',
                'pesan' => 'nullable|string',
            ]);

            $maintenance = MaintenanceModel::first();

            if (!$maintenance) {
                $maintenance = new MaintenanceModel();
            }

            $maintenance->status = $request->input('status', 0);
            $maintenance->judul = $request->judul;
            $maintenance->pesan = $request->pesan;

            $maintenance->save();

            return redirect()->back()->with('success', 'Pengaturan maintenance berhasil diperbarui.');
        } else {
            abort(404);
        }
    }
}
