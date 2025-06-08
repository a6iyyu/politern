@extends('layouts.main')

@section('judul')
    Periode Magang
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Periode Magang" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="py-6 px-12 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @include('components.admin.periode-magang.tabel')
        </section>
        @include('components.admin.periode-magang.tambah')
        @include('components.admin.periode-magang.edit')
        @include('components.admin.periode-magang.detail')
        <section class="py-6 px-12 mt-6 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @include('components.admin.durasi-magang.tabel')
        </section>
    </main>
@endsection