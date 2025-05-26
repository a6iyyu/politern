<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DataDosen extends Controller {
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_dosen = Dosen::count();
            $total_dosen_pembimbing = DosenPembimbing::count();
            
              $rows = Dosen::select()->get()->map(function ($dsn): array {
                return [
                    $dsn->id_dosen,
                    '<div class="flex items-center gap-2">
                        <img src="' . asset('shared/profil.png') . '" alt="avatar" class="w-8 h-8 rounded-full" /> ' . e($dsn->nama) . '
                    </div>',
                    $dsn->nip,
                    $dsn->nomor_telepon,
                    $dsn->nama,
                    view('components.admin.data-dosen.aksi', compact('dsn'))->render(),
                ];
            })->toArray();
            return view('pages.admin.data-dosen', compact('total_dosen', 'total_dosen_pembimbing', 'rows'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function show($id) {
        $dosen = Dosen::findOrFail($id);
        return view('pages.admin.data-dosen.show', compact('dosen'));
    }
    
    public function edit($id) {
        $dosen = Dosen::findOrFail($id);
        return view('pages.admin.data-dosen.edit', compact('dosen'));
    }

    public function destroy($id) {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        return redirect()->route('pages.admin.data-dosen.index')->with('success', 'Data Dosen berhasil dihapus.');
    }
}