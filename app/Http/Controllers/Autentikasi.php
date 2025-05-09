<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class Autentikasi extends Controller
{
    public function daftar(): void
    {
        try {
            // Fais Restu
        } catch (Exception $exception) {
            // Fais Restu
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     * @throws Exception
     *
     * Fungsi ini bertujuan untuk melakukan proses masuk ke dalam sistem
     * berdasarkan data yang telah dimasukkan oleh pengguna.
     */
    public function masuk(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'nama_pengguna' => 'required|string|max:50',
                'kata_sandi' => 'required|string|max:50',
            ], [
                'nama_pengguna.required' => 'Harap mengisikan nama pengguna Anda!',
                'nama_pengguna.string' => 'Nama pengguna harus berupa kalimat!',
                'nama_pengguna.max' => 'Nama pengguna tidak boleh lebih dari 50 karakter!',
                'kata_sandi.required' => 'Isi kata sandi terlebih dahulu!',
                'kata_sandi.string' => 'Kata sandi harus berupa kalimat!',
                'kata_sandi.max' => 'Kata sandi tidak boleh lebih dari 50 karakter!',
            ]);

            $pengguna = Pengguna::where('nama_pengguna', $request->nama_pengguna)->first();

            if (!$pengguna || !Hash::check($request->kata_sandi, $pengguna->kata_sandi)) {
                Log::warning('Upaya masuk gagal dilakukan: ', ['nama_pengguna' => $request->nama_pengguna]);
                return back()->withErrors(['errors' => 'Nama pengguna atau kata sandi salah.'])->withInput($request->except('kata_sandi'));
            }

            Auth::login($pengguna);
            Session::put([
                'id_pengguna'   => $pengguna->id_pengguna,
                'nama_pengguna' => $pengguna->nama_pengguna,
                'tipe'          => $pengguna->tipe,
            ]);

            switch ($pengguna->tipe) {
                case 'ADMIN':
                    $admin = $pengguna->admin;
                    Session::put(['id_admin' => $admin->id_admin, 'nama_admin' => $admin->nama_admin]);
                    return redirect()->route('admin.dasbor');
                case 'MAHASISWA':
                    $mahasiswa = $pengguna->mahasiswa;
                    Session::put(['id_mahasiswa' => $mahasiswa->id_mahasiswa, 'nim' => $mahasiswa->nim, 'nama_lengkap' => $mahasiswa->nama_lengkap]);
                    return redirect()->route('mahasiswa.dasbor');
                default:
                    return back()->withErrors(['errors' => 'Tipe pengguna tidak valid.'])->withInput($request->except('kata_sandi'));
            }
        } catch (ValidationException $validation) {
            return back()->withErrors($validation->errors())->withInput($request->except('kata_sandi'));
        } catch (Exception $exception) {
            Log::error("Terjadi kesalahan: ", ['errors' => $exception->getMessage()]);
            return back()->withErrors(['errors' => 'Terjadi kesalahan pada sistem.'])->withInput($request->except('kata_sandi'));
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     *
     * Fungsi ini bertujuan untuk melakukan proses keluar dari akun pengguna.
     */
    public function keluar(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('masuk');
    }
}