<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckMaster
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user login dan memiliki is_master = 1
        if (auth()->check() && auth()->user()->is_master == 1) {
            return $next($request);
        }

        // Jika bukan master, redirect ke dashboard dengan pesan error
        return redirect()->route('admin.dashboard')
            ->with('error', '⚠️ Akses ditolak! Hanya akun MASTER yang dapat mengakses halaman ini.');
    }
}
