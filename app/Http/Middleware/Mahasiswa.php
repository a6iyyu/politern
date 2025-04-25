<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class Mahasiswa
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::has('tipe_pengguna') || Session::get('tipe_pengguna') !== 'MAHASISWA') return redirect()->route('masuk')->withErrors(['errors' => 'Anda tidak memiliki izin untuk mengakses halaman ini.']);
        return $next($request);
    }
}