@extends('layouts.main')

@section('judul')
    Dasbor
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Dasbor" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.admin.dasbor.ringkasan-informasi')
        <section class="mt-6 grid grid-cols-1 gap-6 2xl:grid-cols-2">
            @include('components.admin.dasbor.progres-magang-mingguan')
            @include('components.admin.dasbor.kategori-bidang-magang-terbanyak')
        </section>
        <section class="mt-6 grid grid-cols-1 gap-6 xl:grid-cols-2">
            @include('components.admin.dasbor.informasi-magang-mahasiswa')
            @include('components.admin.dasbor.informasi-mahasiswa')
        </section>
    </main>
@endsection