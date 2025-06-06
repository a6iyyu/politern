<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\DurasiMagang as DurasiMagangModel;

class DurasiMagang extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_durasi' => 'required|string|max:100|unique:durasi_magang,nama_durasi',
        ]);

        DurasiMagangModel::create($request->only('nama_durasi'));

        return redirect()
            ->route('admin.periode-magang')
            ->with('success', 'Durasi magang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $durasi = DurasiMagangModel::findOrFail($id);
        return view('components.admin.durasi-magang.edit', compact('durasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_durasi' => 'required|string|max:100|unique:durasi_magang,nama_durasi,' . $id . ',id_durasi',
        ]);

        $durasi = DurasiMagangModel::findOrFail($id);
        $durasi->update($request->only('nama_durasi'));

        return redirect()
            ->route('admin.periode-magang')
            ->with('success', 'Durasi magang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $durasi = DurasiMagangModel::findOrFail($id);
        $durasi->delete();

        return redirect()
            ->route('admin.periode-magang')
            ->with('success', 'Durasi magang berhasil dihapus');
    }
}
