<?php

namespace App\Providers;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ProfilePhotoProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('shared.ui.profile-photo', function ($views) {
            $pengguna = Auth::user();
            $mahasiswa = ($pengguna && $pengguna->tipe === 'MAHASISWA') ? Mahasiswa::where('id_pengguna', $pengguna->id_pengguna)->first() : null;
            $nama_lengkap = $mahasiswa->nama_lengkap ?? '';
            $nim = $mahasiswa->nim ?? '';
            $views->with(compact('nama_lengkap', 'nim'));
        });
    }
}