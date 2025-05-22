@extends('layouts.main')

@section('judul')
    Dasbor
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Dasbor" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.lecturer.dasbor.informasi')
        @include('components.lecturer.dasbor.tabel')
        @include('components.lecturer.dasbor.log-aktivitas')
    </main> 
@endsection