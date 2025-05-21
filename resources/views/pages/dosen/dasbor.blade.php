@extends('layouts.main')

@section('judul')
    Dasbor
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Dasbor" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.dosen.dasbor.informasi')
        @include('components.dosen.dasbor.tabel')
        @include('components.dosen.dasbor.log-aktivitas')
    </main> 
@endsection