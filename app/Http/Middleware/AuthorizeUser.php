<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) return to_route('beranda');
        if (!Session::has('tipe') || strtoupper(Session::get('tipe')) !== strtoupper($role)) return to_route('masuk')->withErrors(['errors' => 'Anda tidak memiliki izin untuk mengakses halaman ini.']);
        return $next($request);
    }
}