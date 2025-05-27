<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeMagang as PeriodeMagangModel;
use Illuminate\Support\Facades\Auth;

class PeriodeMagang extends Controller
{
    public function index()
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN"){
            $rows = PeriodeMagangModel::all()->map(function ($periode) {
                return [
                    $periode->id_periode,
                    'Periode ' . $periode->durasi, // Nama Periode dinamis dari durasi
                    date('Y', strtotime($periode->tanggal_mulai)), // Tahun dari tanggal
                    $periode->semester,
                    $periode->tanggal_mulai,
                    $periode->tanggal_selesai,
                    $periode->tanggal_selesai < now()->toDateString() ? 'SELESAI' : 'AKTIF',
                    view('components.admin.periode-magang.aksi', compact('periode'))->render(),
                ];
            })->toArray();
            
            return view('pages.admin.periode-magang', compact('rows'));
        } else if ($pengguna === 'DOSEN') {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
        
    }
}
