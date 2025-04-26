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
        if (!in_array($user->tipe, ['admin', 'mahasiswa', 'perusahaan'])) abort(403, 'Anda tidak memiliki akses.');

        return match ($user->tipe) {
            'admin'         => view('pages.admin.dasbor'),
            'mahasiswa'     => view('pages.student.dasbor'),
            'perusahaan'    => view('pages.company.dasbor'),
            default         => abort(403),
        };
    }
}