<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Memeriksa apakah pengguna sudah login
        if (Auth::check()) {
            // Memeriksa apakah pengguna memiliki role 'admin'
            if (Auth::user()->hasRole('admin')) {
                return $next($request);
            }
            // Atau memeriksa apakah pengguna memiliki permission 'access-admin'
            // if (Auth::user()->can('access-admin')) {
            //     return $next($request);
            // }
        }

        // Jika tidak, redirect atau kembalikan sesuai kebijakan aplikasi Anda
        return redirect('/')->with('error', 'Anda tidak diizinkan mengakses halaman ini.');
    }
}
