<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;

class Profil extends Controller
{
    public function index(): RedirectResponse|View
    {
        try {
            $pengguna = Auth::user()->tipe;
            if ($pengguna == null) return back()->withErrors(['errors' => 'Pengguna tidak ditemukan.']);

            return match ($pengguna) {
                'ADMIN'     => $this->admin(),
                'DOSEN'     => $this->lecturer(),
                'MAHASISWA' => $this->student(),
            };
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Data Anda tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam mengambil data Anda karena kesalahan pada server.']);
        }
    }

    public function edit(): RedirectResponse|View
    {
        try {
            $pengguna = Auth::user()->tipe;
            if ($pengguna == null) return back()->withErrors(['errors' => 'Pengguna tidak ditemukan.']);

            return match ($pengguna) {
                'ADMIN'     => $this->admin(),
                'DOSEN'     => $this->lecturer(),
                'MAHASISWA' => $this->student(),
            };
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Data Anda tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam mengambil data Anda karena kesalahan pada server.']);
        }
    }

    public function update(Request $request): RedirectResponse
    {
        try {
            $request->validate([]);

            /** @var Pengguna $pengguna  */
            $pengguna = Auth::user();
            $pengguna->update($request->all());
            return back()->with('success', 'Profil Anda berhasil diubah.');
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam mengubah profil Anda karena kesalahan pada server.']);
        }
    }

    private function admin(): RedirectResponse|View
    {
        try {
            $pengguna = Auth::user();
            $admin = $pengguna->admin;
            $route = Request::route() instanceof Route ? Request::route()->getName() : null;

            if ($route === 'admin.profil.edit') return view('pages.admin.edit-profil', compact('admin'));
            return view('pages.admin.profil', compact('admin'));
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Data Anda tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam mengambil data Anda karena kesalahan pada server.']);
        }
    }

    private function lecturer(): RedirectResponse|View
    {
        try {
            $pengguna = Auth::user();
            $dosen = $pengguna->dosen;
            $route = Request::route() instanceof Route ? Request::route()->getName() : null;

            if ($route === 'dosen.profil.edit') return view('pages.lecturer.edit-profil', compact('dosen'));
            return view('pages.lecturer.profil', compact('dosen'));
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Data Anda tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam mengambil data Anda karena kesalahan pada server.']);
        }
    }

    private function student(): RedirectResponse|View
    {
        try {
            $pengguna = Auth::user();
            $mahasiswa = $pengguna->mahasiswa;
            $route = Request::route() instanceof Route ? Request::route()->getName() : null;

            if ($route === 'mahasiswa.profil.edit') return view('pages.student.edit-profil', compact('mahasiswa'));
            return view('pages.student.profil', compact('mahasiswa'));
        } catch (ModelNotFoundException $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Data Anda tidak ditemukan.']);
        } catch (Exception $exception) {
            report($exception);
            Log::error($exception->getMessage());
            return back()->withErrors(['errors' => 'Gagal dalam mengambil data Anda karena kesalahan pada server.']);
        }
    }
}