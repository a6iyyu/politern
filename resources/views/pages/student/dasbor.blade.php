@extends('layouts.main')

@section('judul')
    Dasbor
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Dasbor" />
    <main class="flex flex-col pb-10 px-10 transition-all duration-300">
        @include('components.student.dasbor.selamat-datang')
        @include('components.student.dasbor.rekomendasi-magang')
    </main> 
@endsection