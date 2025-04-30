<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Profil extends Controller
{
    public function identitas(): RedirectResponse|View
    {
        $pengguna = Auth::user();
        if (!$pengguna) return redirect()->route('masuk');
        if (!in_array($pengguna->tipe, ['ADMIN', 'MAHASISWA'])) abort(403, 'Anda tidak memiliki akses.');

        $mahasiswa = Mahasiswa::where('id_pengguna', $pengguna->id_pengguna)->first();
        $nama_lengkap = $mahasiswa->nama_lengkap;
        $nim = $mahasiswa->nim;

        return view('shared.ui.profile-photo', compact('nama_lengkap', 'nim'));
    }
}