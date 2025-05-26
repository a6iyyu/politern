<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DataMahasiswa extends Controller {
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_mahasiswa = Mahasiswa::count();
            $total_mahasiswa_magang = Magang::count();
            $mahasiswa_belum_magang = Mahasiswa::where('status', 'BELUM MAGANG')->count();
            $mahasiswa_sedang_magang = Mahasiswa::where('status', 'SEDANG MAGANG')->count();
            $mahasiswa_selesai_magang = Mahasiswa::where('status', 'SELESAI')->count();
            
            $rows = Mahasiswa::with('program_studi')->get()->map(function ($mhs): array {
                $program_studi = $mhs->program_studi;
                return [
                    $mhs->id_mahasiswa,
                    '<div class="flex items-center gap-2">
                        <img src="' . asset('shared/profil.png') . '" alt="avatar" class="w-8 h-8 rounded-full" /> ' . e($mhs->nama_lengkap) . '
                    </div>',
                    $mhs->nim,
                    $program_studi->nama,
                    $mhs->angkatan,
                    $mhs->semester,
                    $mhs->status,
                    view('components.admin.data-mahasiswa.aksi', compact('mhs'))->render(),
                ];
            })->toArray();
            return view('pages.admin.data-mahasiswa', compact('total_mahasiswa', 'total_mahasiswa_magang', 'mahasiswa_belum_magang', 'mahasiswa_sedang_magang', 'mahasiswa_selesai_magang', 'rows'));
        } else if ($pengguna === "DOSEN") {
            return view('pages.lecturer.data-mahasiswa');
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }
    
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('pages.admin.data-mahasiswa.show', compact('mahasiswa'));
    }
    
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('pages.admin.data-mahasiswa.edit', compact('mahasiswa'));
    }
    
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        
        return redirect()->route('pages.admin.data-mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}