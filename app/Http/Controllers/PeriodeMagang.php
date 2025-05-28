<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\PeriodeMagang as PeriodeMagangModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PeriodeMagang extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $data = PeriodeMagangModel::all()->map(fn(PeriodeMagangModel $periode): array => [
                $periode->id_periode,
                "Periode $periode->durasi",
                date('Y', strtotime($periode->tanggal_mulai)),
                $periode->semester,
                $periode->tanggal_mulai,
                $periode->tanggal_selesai,
                $periode->tanggal_selesai < Carbon::now()->toDateString() ? 'SELESAI' : 'AKTIF',
                view('components.admin.periode-magang.aksi', compact('periode'))->render(),
            ])->toArray();

            return view('pages.admin.periode-magang', compact('data'));
        } else if ($pengguna === 'DOSEN') {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }
}