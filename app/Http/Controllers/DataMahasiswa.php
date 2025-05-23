<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DataMahasiswa extends Controller {
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            return view('pages.admin.data-mahasiswa');
        } else if ($pengguna === "DOSEN") {
            return view('pages.lecturer.data-mahasiswa');
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function show() {}
}