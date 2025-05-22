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
    public function lupa_kata_sandi(): void
    {
        try {
        } catch (Exception $exception) {
            Log::error('Terjadi kesalahan: ', ['errors' => $exception->getMessage()]);
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
                'nama_pengguna'          => 'required|string|max:150',
                'kata_sandi'             => 'required|string|max:150',
            ], [
                'nama_pengguna.required' => 'Harap mengisikan nama pengguna Anda!',
                'nama_pengguna.string'   => 'Nama pengguna harus berupa kalimat!',
                'nama_pengguna.max'      => 'Nama pengguna tidak boleh lebih dari 150 karakter!',
                'kata_sandi.required'    => 'Isi kata sandi terlebih dahulu!',
                'kata_sandi.string'      => 'Kata sandi harus berupa kalimat!',
                'kata_sandi.max'         => 'Kata sandi tidak boleh lebih dari 150 karakter!',
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
                    Session::put(['id_admin' => $admin->id_admin, 'nip' => $admin->nip, 'nama_admin' => $admin->nama]);
                    return to_route('admin.dasbor');
                case 'MAHASISWA':
                    $mahasiswa = $pengguna->mahasiswa;
                    Session::put(['id_mahasiswa' => $mahasiswa->id_mahasiswa, 'nim' => $mahasiswa->nim, 'nama_lengkap' => $mahasiswa->nama_lengkap]);
                    return to_route('mahasiswa.dasbor');
                case 'DOSEN':
                    $dosen = $pengguna->dosen;
                    Session::put(['id_dosen' => $dosen->id_dosen, 'nip' => $dosen->nip, 'nama_dosen' => $dosen->nama]);
                    return to_route('dosen.dasbor');
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
        return to_route('masuk');
    }
}