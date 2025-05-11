@extends('layouts.main')

@section('judul')
    Kelola Lamaran
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Kelola Lamaran"/>
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.student.kelola-lamaran.filter')
        @include('components.student.kelola-lamaran.tabel-histori')
    </main>
@endsection