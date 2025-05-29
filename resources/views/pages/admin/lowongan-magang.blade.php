@extends('layouts.main')

@section('judul')
    Lowongan Magang
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Lowongan Magang" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="p-6 mt-8 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @include('components.admin.lowongan-magang.tabel')
        </section>
    </main>
@endsection