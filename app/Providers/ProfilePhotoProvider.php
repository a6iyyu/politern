<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as Views;

class ProfilePhotoProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('shared.ui.profile-photo', function ($views): RedirectResponse|Views
        {
            $pengguna = Auth::user();
            if (!$pengguna) return back()->withErrors(['errors' => 'Terjadi kesalahan pada server.']);

            $nama = '';
            $nim = '';
            $nip = '';

            if ($pengguna->tipe === 'MAHASISWA') {
                $mahasiswa = Mahasiswa::where('id_pengguna', $pengguna->id_pengguna)->first();
                $nama = $mahasiswa->nama_lengkap ?? '';
                $nim = $mahasiswa->nim ?? '';
            }

            if ($pengguna->tipe === 'ADMIN') {
                $admin = Admin::where('id_pengguna', $pengguna->id_pengguna)->first();
                $nama = $admin->nama ?? '';
                $nip = $admin->nip ?? '';
            }

            if ($pengguna->tipe === 'DOSEN') {
                $dosen = Dosen::where('id_pengguna', $pengguna->id_pengguna)->first();
                $nama = $dosen->nama ?? '';
                $nip = $dosen->nip ?? '';
            }

            return $views->with(compact('nama', 'nim', 'nip'));
        });
    }
}