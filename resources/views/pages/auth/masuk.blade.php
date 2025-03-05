@extends('layouts.main')

@section('judul')
    Masuk
@endsection

@section('deskripsi')
    Selamat datang!
@endsection

@section('konten')
    <main class="min-h-screen w-full relative flex flex-grow">
        @include('components.auth.gambar')
        @include('components.auth.formulir')
    </main>
@endsection