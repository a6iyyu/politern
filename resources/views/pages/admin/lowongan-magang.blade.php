@extends('layouts.main')

@section('judul')
    Lowongan Magang
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Lowongan Magang" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="py-6 px-12 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @include('components.admin.lowongan-magang.tabel')
        </section>
        @include('components.admin.lowongan-magang.detail')
        @include('components.admin.lowongan-magang.edit')
        @include('components.admin.lowongan-magang.tambah')
    </main>
@endsection

@vite('resources/ts/edit-intern.ts')