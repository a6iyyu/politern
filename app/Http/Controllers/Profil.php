<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pengguna;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class Profil extends Controller
{
    public function index(): RedirectResponse|View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna == null) return back()->withErrors(['errors' => 'Pengguna tidak ditemukan.']);

        return match($pengguna) {
            'ADMIN'     => $this->admin(),
            'DOSEN'     => $this->lecturer(),
            'MAHASISWA' => $this->student(),
        };
    }

    public function edit(): RedirectResponse|View
    {
        try {
            /** @var Pengguna $pengguna */
            $pengguna = Auth::user();
            return view('pages.profil.edit', compact('pengguna'));
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception);
            return back()->withErrors(['errors' => 'Data Anda tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception);
            return back()->withErrors(['errors' => 'Gagal dalam mengambil data Anda karena kesalahan pada server.']);
        }
    }

    public function update(Request $request): RedirectResponse
    {
        try {
            /** @var Pengguna $pengguna  */
            $pengguna = Auth::user();
            $pengguna->update($request->all());
            return back()->with('success', 'Profil Anda berhasil diubah.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception);
            return back()->withErrors(['errors' => 'Gagal dalam mengubah profil Anda karena kesalahan pada server.']);
        }
    }

    private function admin(): RedirectResponse|View
    {
        try {
            /** @var Pengguna $pengguna */
            $pengguna = Auth::user();
            $admin = $pengguna->admin;
            return view('pages.admin.profil', compact('admin'));
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception);
            return back()->withErrors(['errors' => 'Data Anda tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception);
            return back()->withErrors(['errors' => 'Gagal dalam mengambil data Anda karena kesalahan pada server.']);
        }
    }

    private function lecturer(): RedirectResponse|View
    {
        try {
            /** @var Pengguna $pengguna */
            $pengguna = Auth::user();
            $dosen = $pengguna->dosen;
            return view('pages.lecturer.profil', compact('dosen'));
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception);
            return back()->withErrors(['errors' => 'Data Anda tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception);
            return back()->withErrors(['errors' => 'Gagal dalam mengambil data Anda karena kesalahan pada server.']);
        }
    }

    private function student(): RedirectResponse|View
    {
        try {
            /** @var Pengguna $pengguna */
            $pengguna = Auth::user();
            $mahasiswa = $pengguna->mahasiswa;
            return view('pages.student.profil', compact('mahasiswa'));
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception);
            return back()->withErrors(['errors' => 'Data Anda tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception);
            return back()->withErrors(['errors' => 'Gagal dalam mengambil data Anda karena kesalahan pada server.']);
        }
    }
}