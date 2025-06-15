<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class Autentikasi extends Controller
{
    public function lupa_kata_sandi(): View
{
    try {
        return view('pages.auth.lupa-kata-sandi');
    } catch (ModelNotFoundException $exception) {
        report($exception);
        abort(404, "Halaman tidak ditemukan.");
    } catch (Exception $exception) {
        report($exception);
        abort(500, "Terjadi kesalahan pada server.");
    }
}

public function kirim_link_reset(Request $request): RedirectResponse
{
    try {
        $request->validate([
            'email' => 'required|email|exists:pengguna,email',
        ], [
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'email.exists' => 'Email tidak terdaftar di sistem kami.',
        ]);

        $pengguna = Pengguna::where('email', $request->email)->first();
        
        if (!$pengguna) {
            return back()->withErrors(['email' => 'Email tidak terdaftar di sistem kami.'])->withInput();
        }

        $token = Str::random(60);
        
        // Save token to database
        $pengguna->reset_token = $token;
        $pengguna->reset_token_created_at = now();
        $saved = $pengguna->save();

        if (!$saved) {
            Log::error('Gagal menyimpan token reset password untuk pengguna: ' . $pengguna->email);
            return back()->withErrors([
                'error' => 'Gagal menyimpan token reset password. Silakan coba lagi.'
            ]);
        }

        // Log the email being sent
        Log::info('Mengirim email reset password ke: ' . $pengguna->email);

        try {
            // Kirim email
            Mail::to($pengguna->email)->send(new ResetPasswordMail($pengguna, $token));
            Log::info('Email reset password berhasil dikirim ke: ' . $pengguna->email);
            
            return back()->with('status', 'Link reset password telah dikirim ke email Anda!');
            
        } catch (\Exception $mailException) {
            Log::error('Gagal mengirim email reset password: ' . $mailException->getMessage());
            Log::error($mailException);
            
            // Check if it's an authentication error
            if (str_contains($mailException->getMessage(), 'Authentication')) {
                return back()->withErrors([
                    'error' => 'Gagal mengirim email. Silakan periksa konfigurasi email server.'
                ])->withInput();
            }
            
            return back()->withErrors([
                'error' => 'Terjadi kesalahan saat mengirim email. Silakan coba beberapa saat lagi.'
            ])->withInput();
        }

    } catch (ValidationException $validation) {
        return back()->withErrors($validation->errors())->withInput();
    } catch (\Exception $exception) {
        Log::error('Error dalam kirim_link_reset: ' . $exception->getMessage());
        Log::error($exception);
        
        return back()->withErrors([
            'error' => 'Terjadi kesalahan sistem. Silakan coba lagi nanti.'
        ])->withInput();
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

            if (!$pengguna) {
                Log::warning('Upaya masuk gagal dilakukan: ', ['nama_pengguna' => $request->nama_pengguna]);
                return back()->withErrors(['errors' => 'Nama pengguna atau kata sandi salah.'])->withInput($request->except('kata_sandi'));
            }

            if ($request->kata_sandi !== Crypt::decrypt($pengguna->kata_sandi)) {
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
    public function tampilResetPassword($token)
    {
        try {
            $pengguna = Pengguna::where('reset_token', $token)->first();
            
            $viewData = [
                'token' => $token,
                'email' => $pengguna->email ?? '',
            ];

            if (!$pengguna) {
                Log::warning('Token tidak ditemukan: ' . $token);
                $viewData['error'] = 'Link reset password tidak valid.';
                return view('pages.auth.reset-password', $viewData);
            }

            // Cek apakah token masih berlaku (60 menit)
            $tokenCreatedAt = \Carbon\Carbon::parse($pengguna->reset_token_created_at);
            $expiryTime = $tokenCreatedAt->addMinutes(60);
            
            if (now()->gt($expiryTime)) {
                Log::warning('Token sudah kadaluarsa untuk email: ' . $pengguna->email);
                $viewData['error'] = 'Link reset password sudah kadaluarsa. Silakan request link yang baru.';
                return view('pages.auth.reset-password', $viewData);
            }

            Log::info('Menampilkan form reset password untuk: ' . $pengguna->email);
            
            return view('pages.auth.reset-password', $viewData);

        } catch (\Exception $e) {
            Log::error('Error in tampilResetPassword: ' . $e->getMessage());
            Log::error($e);
            
            return redirect()->route('lupa-kata-sandi')
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email|exists:pengguna,email',
                'password' => 'required|min:6|confirmed',
            ]);

            // Cari pengguna berdasarkan email dan token
            $pengguna = Pengguna::where('email', $request->email)
                ->where('reset_token', $request->token)
                ->first();

            if (!$pengguna) {
                Log::warning('Token tidak valid untuk email: ' . $request->email);
                return back()->withErrors([
                    'error' => 'Token tidak valid.'
                ])->withInput();
            }

            // Cek apakah token masih berlaku (60 menit)
            $tokenCreatedAt = \Carbon\Carbon::parse($pengguna->reset_token_created_at);
            $expiryTime = $tokenCreatedAt->addMinutes(60);
            
            if (now()->gt($expiryTime)) {
                Log::warning('Token sudah kadaluarsa untuk email: ' . $pengguna->email);
                return back()->withErrors([
                    'error' => 'Link reset password sudah kadaluarsa. Silakan request link yang baru.'
                ])->withInput();
            }

            // Update password
            $pengguna->update([
                'kata_sandi' => Crypt::encrypt($request->password),
                'reset_token' => null,
                'reset_token_created_at' => null
            ]);

            return redirect()->route('masuk')
                ->with('status', 'Password berhasil direset. Silakan masuk dengan password baru Anda.');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error in resetPassword: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function keluar(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('masuk');
    }
}