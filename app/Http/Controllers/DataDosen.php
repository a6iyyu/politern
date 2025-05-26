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
            
            return view('pages.admin.data-dosen', compact('total_dosen', 'total_dosen_pembimbing'));
        } else {
            abort(403, "Anda tidak memiliki hak akses untuk masuk ke halaman ini.");
        }
    }

    public function show() {}
}