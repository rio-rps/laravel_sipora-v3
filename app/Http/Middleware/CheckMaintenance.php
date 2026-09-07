<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\MaintenanceModel;

class CheckMaintenance
{
    public function handle(Request $request, Closure $next)
    {
        $maintenance = MaintenanceModel::first();

        // Tidak ada data atau maintenance OFF
        if (!$maintenance || $maintenance->status == 0) {
            return $next($request);
        }

        /*
        |--------------------------------------------------------------------------
        | MAINTENANCE ON
        |--------------------------------------------------------------------------
        */

        // Jika user login dan mempunyai akses maintenance
        if (auth()->check() && auth()->user()->maintenance_access == 1) {
            return $next($request);
        }

        // Selain itu tampilkan halaman maintenance
        return response()->view('maintenance.page', [
            'maintenance' => $maintenance,
        ]);
    }
}
