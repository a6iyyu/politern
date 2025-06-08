<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
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
        $pengguna = Auth::user()->tipe;
        return match ($pengguna) {
            'ADMIN'     => $this->admin(),
            'DOSEN'     => $this->lecturer(),
            'MAHASISWA' => $this->student('edit'),
        };
    }

    public function update(Request $request): RedirectResponse
    {
        $pengguna = Auth::user()->tipe;
        return match ($pengguna) {
            'ADMIN'     => $this->admin(),
            'DOSEN'     => $this->lecturer(),
            'MAHASISWA' => $this->student('update', $request),
        };
    }

    public function destroy(): RedirectResponse
    {
        $pengguna = Auth::user()->tipe;
        return match ($pengguna) {
            'ADMIN'     => $this->admin(),
            'DOSEN'     => $this->lecturer(),
            'MAHASISWA' => $this->student('destroy'),
        };
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

    private function student(string $action = 'index', $request = null): RedirectResponse|View
    {
        try {
            $pengguna = Auth::user();
            $route = Request::route() instanceof Route ? Request::route()->getName() : null;

            /** @var Mahasiswa $mahasiswa */
            $mahasiswa = $pengguna->mahasiswa;

            if ($action === 'index') return view('pages.student.profil', compact('mahasiswa'));

            if ($action === 'edit') {
                if ($route === 'mahasiswa.profil.pengalaman.edit') return view('pages.student.edit-pengalaman', compact('mahasiswa'));
                if ($route === 'mahasiswa.profil.sertifikasi.edit') return view('pages.student.edit-sertifikasi', compact('mahasiswa'));
                if ($route === 'mahasiswa.profil.proyek.edit') return view('pages.student.edit-proyek', compact('mahasiswa'));
                return view('pages.student.edit-profil', compact('mahasiswa'));
            }

            if ($action === 'update' && $request) {
                if ($route === 'mahasiswa.profil.pengalaman.perbarui') {
                    $mahasiswa->pengalaman()->update($request->all());
                    return back()->with('success', 'Pengalaman berhasil diperbarui.');
                }

                if ($route === 'mahasiswa.profil.sertifikasi.perbarui') {
                    $mahasiswa->sertifikasi_pelatihan()->update($request->all());
                    return back()->with('success', 'Sertifikasi berhasil diperbarui.');
                }

                if ($route === 'mahasiswa.profil.proyek.perbarui') {
                    $mahasiswa->proyek()->update($request->all());
                    return back()->with('success', 'Proyek berhasil diperbarui.');
                }

                $mahasiswa->update($request->all());
                return back()->with('success', 'Profil berhasil diperbarui.');
            }

            if ($action === 'destroy') {
                if ($route === 'mahasiswa.profil.pengalaman.hapus') {
                    $mahasiswa->pengalaman()->delete();
                    return back()->with('success', 'Pengalaman berhasil dihapus.');
                }

                if ($route === 'mahasiswa.profil.sertifikasi.hapus') {
                    $mahasiswa->sertifikasi_pelatihan()->delete();
                    return back()->with('success', 'Sertifikasi berhasil dihapus.');
                }

                if ($route === 'mahasiswa.profil.proyek.hapus') {
                    $mahasiswa->proyek()->delete();
                    return back()->with('success', 'Proyek berhasil dihapus.');
                }

                return back()->withErrors(['errors' => 'Data yang ingin dihapus tidak ditemukan.']);
            }

            return back()->withErrors(['errors' => 'Aksi tidak dikenal.']);
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