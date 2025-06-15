<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\Pengguna;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class Autentikasi extends Controller
{
    public function send_reset_link(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'email'             => 'required|email|exists:pengguna,email',
            ], [
                'email.required'    => 'Email wajib diisi!',
                'email.email'       => 'Format email tidak valid!',
                'email.exists'      => 'Email tidak terdaftar di sistem kami.',
            ]);

            $pengguna = Pengguna::where('email', $request->email)->first();

            if (!$pengguna) {
                return back()->withErrors(['errors' => 'Email tidak terdaftar di sistem kami.'])->withInput();
            }

            $pengguna->reset_token = Str::random(60);
            $pengguna->reset_token_created_at = now();

            if (!$pengguna->save()) {
                Log::error("Gagal menyimpan token reset kata sandi untuk email {$pengguna->email}.");
                return back()->withErrors(['errors' => 'Gagal menyimpan token reset password. Silakan coba lagi.']);
            }

            Mail::to($pengguna->email)->send(new ResetPasswordMail($pengguna, $pengguna->reset_token));
            return back()->with('status', 'Tautan reset kata sandi telah dikirim ke email Anda!');
        } catch (ValidationException $validation) {
            report($validation);
            Log::error($validation->getMessage());
            return back()->withErrors($validation->errors())->withInput();
        } catch (Exception $e) {
            report($e);
            Log::error("Terjadi kesalahan saat reset kata sandi: " . $e->getMessage());
            $error = str_contains($e->getMessage(), 'Authentication') ? 'Gagal mengirim email. Silakan periksa konfigurasi email server.' : 'Terjadi kesalahan saat memproses permintaan Anda. Silakan coba lagi.';
            return back()->withErrors(['error' => $error])->withInput();
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
    public function login(Request $request): RedirectResponse
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

    public function show_reset_password($token): RedirectResponse|View
    {
        try {
            $pengguna = Pengguna::where('reset_token', $token)->first();

            $data = [
                'token' => $token,
                'email' => $pengguna->email ?? '',
            ];

            if (!$pengguna) {
                Log::warning("Token tidak ditemukan: {$token}");
                $data['error'] = 'Link reset password tidak valid.';
                return view('pages.auth.reset-password', $data);
            }

            if (now()->gt(Carbon::parse($pengguna->reset_token_created_at)->addMinutes(60))) {
                Log::warning("Token sudah kadaluarsa untuk email: {$pengguna->email}.");
                $data['error'] = 'Tautan reset kata sandi sudah kadaluarsa. Silakan minta tautan yang baru.';
                return view('pages.auth.reset-password', $data);
            }

            return view('pages.auth.reset-password', $data);
        } catch (Exception $e) {
            report($e);
            Log::error($e->getMessage());
            return redirect()->route('lupa-kata-sandi')->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function reset_password(Request $request): RedirectResponse
    {
        try {
            $request->validate([
                'token'     => 'required',
                'email'     => 'required|email|exists:pengguna,email',
                'password'  => 'required|min:6|confirmed',
            ]);

            $pengguna = Pengguna::where('email', $request->email)->where('reset_token', $request->token)->first();

            if (!$pengguna) {
                Log::warning("Token tidak valid untuk email {$request->email}.");
                return back()->withErrors(['errors' => 'Token tidak valid.'])->withInput();
            }

            if (now()->gt(Carbon::parse($pengguna->reset_token_created_at)->addMinutes(60))) {
                Log::warning("Token sudah kadaluarsa untuk email: {$pengguna->email}.");
                return back()->withErrors(['errors' => 'Tautan reset kata sandi sudah kadaluarsa. Silakan minta tautan yang baru.'])->withInput();
            }

            $pengguna->update([
                'kata_sandi'                => Crypt::encrypt($request->password),
                'reset_token'               => null,
                'reset_token_created_at'    => null
            ]);

            return redirect()->route('masuk')->with('success', 'Katavalue:  sandi berhasil direset. Silakan masuk dengan kata sandi baru Anda.');
        } catch (ValidationException $e) {
            report($e);
            Log::warning($e->getMessage());
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            report($e);
            Log::error($e->getMessage());
            return back()->withInput()->with('errors', 'Terjadi kesalahan saat mereset kata sandi. Silakan coba lagi.');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('masuk');
    }
}