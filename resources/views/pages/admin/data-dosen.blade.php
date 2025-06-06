@extends('layouts.main')

@section('judul')
    Data Dosen
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Data Dosen" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.admin.data-dosen.informasi')
        <section class="py-6 px-12 mt-6 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @include('components.admin.data-dosen.tabel')
        </section>
        @include('components.admin.data-dosen.edit')
        @include('components.admin.data-dosen.tambah')
        @include('components.admin.data-dosen.detail')
    </main>
@endsection