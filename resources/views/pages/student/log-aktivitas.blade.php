@extends('layouts.main')

@section('judul')
    Log Aktivitas
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Log Aktivitas" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @if (!(isset($dospem) || isset($perusahaan)))   {{-- Ini akan diganti kalau sudah dinamis. --}}
            @include('components.student.log-aktivitas.informasi')
            @include('components.student.log-aktivitas.daftar')
            @include('components.student.log-aktivitas.tambah')
        @else
            <section class="mt-6 text-center shadow-lg p-10 rounded-lg border border-[var(--stroke)] bg-white text-gray-500">
                <i class="fa-solid fa-circle-info text-2xl"></i>
                <h5 class="mt-4">Log aktivitas tidak tersedia karena status magang kamu belum aktif.</h5>
            </section>
        @endif
    </main>
@endsection