<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Profil extends Controller
{
    /**
     * @return Factory|RedirectResponse|View
     *
     * Fungsi ini bertujuan untuk menampilkan identitas pengguna.
     */
    public function identitas(): Factory|RedirectResponse|View
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