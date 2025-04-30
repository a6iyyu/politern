@extends('layouts.main')

@section('judul')
    Dasbor
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="flex flex-col p-10 lg:pl-76">
        @include('components.student.dasbor.selamat-datang')
        @include('components.student.dasbor.rekomendasi-magang')
    </main>
@endsection