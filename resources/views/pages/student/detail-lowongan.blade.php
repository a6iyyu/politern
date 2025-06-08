@extends('layouts.main')

@section('judul')
    Lowongan {{ $lowongan->bidang->nama_bidang }}
@endsection

@section('deskripsi')
@endsection


@section('konten')
    <x-header :title="'Lowongan ' . $lowongan->bidang->nama_bidang" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="py-6 px-12 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            <span class="flex items-center gap-3">
                <a href="{{ route('mahasiswa.lowongan') }}">
                    Lowongan Magang
                </a>
            </span>
        </section>
    </main>
@endsection