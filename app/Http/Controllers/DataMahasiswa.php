<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Magang;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
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
            
            /** @var LengthAwarePaginator $paginasi */
            $paginasi = Mahasiswa::with('program_studi')->paginate(request('per_page', 10));
            $data = $paginasi->getCollection()->map(fn($mhs) => [
                $mhs->id_mahasiswa,
                '<div class="flex items-center gap-2">
                    <img src="' . asset('shared/profil.png') . '" alt="avatar" class="w-8 h-8 rounded-full" /> ' . e($mhs->nama_lengkap) . '
                </div>',
                $mhs->nim,
                $mhs->program_studi->nama,
                $mhs->angkatan,
                $mhs->semester,
                $mhs->status,
                view('components.admin.data-mahasiswa.aksi', compact('mhs'))->render(),
            ])->toArray();
            return view('pages.admin.data-mahasiswa', compact('data', 'paginasi', 'total_mahasiswa', 'total_mahasiswa_magang', 'mahasiswa_belum_magang', 'mahasiswa_sedang_magang', 'mahasiswa_selesai_magang'));
        } else if ($pengguna === "DOSEN") {
            return view('pages.lecturer.data-mahasiswa');
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create() {}
    
    public function show($id): View
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('pages.admin.detail-data-mahasiswa', compact('mahasiswa'));
    }
    
    public function edit($id): View
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('pages.admin.edit-data-mahasiswa', compact('mahasiswa'));
    }
    
    public function destroy($id): RedirectResponse
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        
        return to_route('admin.data-mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}