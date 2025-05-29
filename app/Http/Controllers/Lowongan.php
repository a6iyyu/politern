<?php

declare(strict_types=1);
namespace App\Http\Controllers;

use App\Models\LowonganMagang;  
use App\Models\Perusahaan;
use App\Models\Bidang;
use App\Models\PeriodeMagang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class Lowongan extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_lowongan = LowonganMagang::count();

            $paginasi = LowonganMagang::paginate(request('per_page', 10));
            $data = collect($paginasi->items())->map(fn(LowonganMagang $lowongan): array => [
                $lowongan->id_lowongan,
                // '<div class="flex items-center gap-2">
                //     <img src="' . asset('shared/profil.png') . '" alt="avatar" class="h-8 w-8 rounded-full" /> ' . e($lowongan->nama_perusahaan) . '
                // </div>',
                $lowongan->judul,
                $lowongan->perusahaan->nama ?? '-', 
                $lowongan->bidang->nama_bidang ?? '-',
                $lowongan->kuota,
                $lowongan->periode_magang->semester ?? '-',
                $lowongan->status,
                view('components.admin.lowongan-magang.aksi', compact('lowongan'))->render(),
                ])->toArray();
                return view('pages.admin.lowongan-magang', compact('data', 'paginasi', 'total_lowongan'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create(){}
}