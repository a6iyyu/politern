@extends('layouts.main')

@section('judul')
    Kelola Lamaran
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="flex flex-col p-10 lg:pl-76">
        <x-header title="Kelola Lamaran Anda" />
        @include('components.student.kelola-lamaran.tabel-histori')
    </main>
@endsection