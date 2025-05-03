<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

/**
 * @param Request $request
 * @return Factory|View
 *
 * Ini merupakan kumpulan fungsi untuk halaman admin,
 * tapi saat ini hanya berisi tempat penampungan sementara.
 */
class Admin extends Controller
{
    public function index(): void
    {
        try {
            // To be announced...            
        } catch (Exception $exception) {
            Log::error('Terjadi kesalahan: ', ['errors' => $exception->getMessage()]);
        }
    }

    public function kelola_lamaran(): Factory|View
    {
        try {
            return view('pages.admin.kelola-lamaran');
        } catch (Exception $exception) {
            Log::error('Terjadi kesalahan: ', ['errors' => $exception->getMessage()]);
            return view('errors.500');
        }
    }

    public function verifikasi_data(): Factory|View
    {
        try {
            return view('pages.admin.verifikasi-data');
        } catch (Exception $exception) {
            Log::error('Terjadi kesalahan: ', ['errors' => $exception->getMessage()]);
            return view('errors.500');
        }
    }

    public function log_aktivitas(): Factory|View
    {
        try {
            return view('pages.admin.log-aktivitas');
        } catch (Exception $exception) {
            Log::error('Terjadi kesalahan: ', ['errors' => $exception->getMessage()]);
            return view('errors.500');
        }
    }
}