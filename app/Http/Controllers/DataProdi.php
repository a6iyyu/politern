<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class DataProdi extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_prodi = ProgramStudi::count();
            
            $paginasi = ProgramStudi::paginate(request('per_page', 10));
            $data = collect($paginasi->items())->map(fn(ProgramStudi $prodi): array => [
                $prodi->id_prodi,
                $prodi->nama,
                $prodi->jenjang,
                $prodi->jurusan,
                Mahasiswa::where('id_prodi', $prodi->id_prodi)->count(),
                view('components.admin.data-prodi.aksi', compact('prodi'))->render(),
            ])->toArray();
            return view('pages.admin.data-prodi', compact('data', 'paginasi', 'total_prodi'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }
}
