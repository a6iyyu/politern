@extends('layouts.main')

@section('judul')
    Periode Magang
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Aktivitas Magang" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="py-6 px-12 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            <h2 class="mb-4 text-base font-semibold text-[var(--primary-text)]">
                <i class="fa-solid fa-clock mr-3"></i>
                Log Aktivitas Mahasiswa
            </h2>
            @include('components.admin.aktivitas-magang.filter')
            @include('components.admin.aktivitas-magang.daftar')
        </section>
    </main>
@endsection