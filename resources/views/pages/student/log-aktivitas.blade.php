@extends('layouts.main')

@section('judul')
    Log Aktivitas
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Log Aktivitas" />
    <main class="flex flex-col pb-10 px-10 transition-all duration-300">
        @include('components.student.log-aktivitas.selamat-datang')
    </main>
@endsection