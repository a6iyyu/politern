@extends('layouts.main')

@section('judul')
    Pengajuan Magang
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Pengajuan Magang" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="py-6 px-12 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @include('components.admin.pengajuan-magang.tabel')
        </section>
        @include('components.admin.pengajuan-magang.detail')
        @include('components.admin.pengajuan-magang.detail-konfirmasi', [
            'pengajuan' => null,
            'dosen' => $dosen ?? []
        ])
    </main>
@endsection