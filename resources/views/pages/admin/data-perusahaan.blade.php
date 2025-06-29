@extends('layouts.main')

@section('judul')
    Data Perusahaan
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Data Perusahaan" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="py-6 px-12 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @include('components.admin.data-perusahaan.tabel')
        </section>
        @include('components.admin.data-perusahaan.detail')
        @include('components.admin.data-perusahaan.tambah')
        @include('components.admin.data-perusahaan.edit')
    </main>
@endsection