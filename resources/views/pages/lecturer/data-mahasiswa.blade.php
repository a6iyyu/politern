@extends('layouts.main')

@section('judul')
    Data Mahasiswa
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Data Mahasiswa" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="py-6 px-12 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @include('components.lecturer.data-mahasiswa.tabel')
        </section>
        @include('components.lecturer.data-mahasiswa.detail')
    </main>
@endsection