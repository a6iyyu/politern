<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\DosenPembimbing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DataDosen extends Controller
{
    public function index(): View
    {
        $pengguna = Auth::user()->tipe;
        if ($pengguna === "ADMIN") {
            $total_dosen = Dosen::count();
            $total_dosen_pembimbing = DosenPembimbing::count();

            $paginasi = Dosen::paginate(request('per_page', 10));
            $data = collect($paginasi->items())->map(fn(Dosen $dosen): array => [
                $dosen->id_dosen,
                '<div class="flex items-center gap-2">
                    <img src="' . asset('shared/profil.png') . '" alt="avatar" class="h-8 w-8 rounded-full" /> ' . e($dosen->nama) . '
                </div>',
                $dosen->nip,
                $dosen->nomor_telepon,
                view('components.admin.data-dosen.aksi', compact('dosen'))->render(),
            ])->toArray();
            return view('pages.admin.data-dosen', compact('data', 'paginasi', 'total_dosen', 'total_dosen_pembimbing'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function create() {}

    public function show($id): array
    {
        $dosen = Dosen::findOrFail($id);
        return compact('dosen');
    }

    public function edit($id): View
    {
        $dosen = Dosen::findOrFail($id);
        return view('pages.admin.edit-data-dosen', compact('dosen'));
    }

    public function destroy($id): RedirectResponse
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        return redirect()->route('admin.data-dosen')->with('success', 'Data Dosen berhasil dihapus.');
    }
}