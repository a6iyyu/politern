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
        if (!Session::has('tipe_pengguna') || Session::get('tipe_pengguna') !== 'MAHASISWA') abort(403, 'Anda tidak memiliki izin untuk mengakses halaman ini.');
        return $next($request);
    }
}