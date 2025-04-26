<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Session::has('tipe_pengguna') || strtoupper(Session::get('tipe_pengguna')) !== strtoupper($role)) return redirect()->route('masuk')->withErrors(['errors' => 'Anda tidak memiliki izin untuk mengakses halaman ini.']);
        return $next($request);
    }
}