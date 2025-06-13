<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProyekMahasiswa extends Controller
{
    public function create(Request $request): RedirectResponse
    {
        try {
            $request->validate([]);

            DB::beginTransaction();

            DB::commit();
            return to_route('mahasiswa.profil')->with('success', 'Proyek berhasil ditambahkan!');
        } catch (Exception $exception) {
            DB::rollBack();
            report($exception);
            Log::error($exception->getMessage());
            return redirect()->back()->withInput()->withErrors(['errors' => 'Gagal menambahkan data pengalaman Anda!']);
        }
    }
}