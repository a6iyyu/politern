<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Keahlian;
use App\Models\Mahasiswa;
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
        try {
            $pengguna = Auth::user()->tipe;
            if ($pengguna === null) return back()->withErrors(['errors' => 'Pengguna tidak ditemukan.']);

            return match ($pengguna) {
                'ADMIN'     => $this->admin(),
                'DOSEN'     => $this->lecturer(),
                'MAHASISWA' => $this->student(),
                default     => back()->withErrors(['errors' => 'Tipe pengguna tidak dikenali.']),
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

    private function admin(): RedirectResponse|View
    {
        try {
            $pengguna = Auth::user();
            $admin = $pengguna->admin;
            $route = Request::route()?->getName();

            return $route === 'admin.profil.edit' ? view('pages.admin.edit-profil', compact('admin')) : view('pages.admin.profil', compact('admin'));
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
            $route = Request::route()?->getName();

            return $route === 'dosen.profil.edit' ? view('pages.lecturer.edit-profil', compact('dosen')) : view('pages.lecturer.profil', compact('dosen'));
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
            $mahasiswa = Auth::user()->mahasiswa;
            $keahlian = Keahlian::pluck('nama_keahlian', 'id_keahlian')->toArray();

            /** @var Mahasiswa $pengalaman */
            $pengalaman = $mahasiswa->pengalaman()->first();

            /** @var Mahasiswa $proyek */
            $proyek = $mahasiswa->proyek()->first();
            return view('pages.student.profil', compact('keahlian', 'mahasiswa', 'pengalaman', 'proyek'));
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