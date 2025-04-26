<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Dasbor extends Controller
{
    public function index(): RedirectResponse|View
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('masuk');
        if (!in_array($user->tipe_pengguna, ['ADMIN', 'MAHASISWA', 'PERUSAHAAN'])) abort(403, 'Anda tidak memiliki akses.');

        return match ($user->tipe_pengguna) {
            'ADMIN'         => view('pages.admin.dasbor'),
            'MAHASISWA'     => view('pages.student.dasbor'),
            'PERUSAHAAN'    => view('pages.company.dasbor'),
            default         => abort(403),
        };
    }
}