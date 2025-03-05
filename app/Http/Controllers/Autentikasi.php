<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class Autentikasi extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'kata_sandi' => 'required|string|max:255',
            ], [
                'nama_lengkap.required' => 'Harap mengisikan nama lengkap Anda!',
                'kata_sandi.required' => 'Isi kata sandi terlebih dahulu!',
            ]);

            $user = DB::table('users')->where('nama_lengkap', $request->nama_lengkap)->first();

            if ($user && Hash::check($request->kata_sandi, $user->kata_sandi)) {
                Auth::loginUsingId($user->id_user, true);
                $request->session()->regenerate();
                return redirect()->intended(route('beranda'));
            };

            Log::warning('Upaya masuk gagal dilakukan:', ['nama_lengkap' => $request->nama_lengkap]);
            return back()->withErrors(['errors' => 'Nama pengguna atau kata sandi salah.'])->withInput($request->except('kata_sandi'));
        } catch (ValidationException $validation) {
            return back()->withErrors($validation->errors())->withInput($request->except('kata_sandi'));
        } catch (Exception $exception) {
            Log::error("Terjadi kesalahan: ", ['errors' => $exception->getMessage()]);
            return back()->withErrors(['errors' => 'Terjadi kesalahan pada sistem.'])->withInput($request->except('kata_sandi'));
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('masuk');
    }
}