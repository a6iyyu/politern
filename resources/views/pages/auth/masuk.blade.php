@extends('layouts.main')

@section('judul')
    Masuk
@endsection

@section('deskripsi')
    Selamat datang di Politern!
@endsection

@section('konten')
    <main class="min-h-screen h-full w-full flex bg-gradient-to-br from-blue-50 to-gray-100">
        @include('components.auth.gambar')
        @include('components.auth.formulir')
    </main>
@endsection