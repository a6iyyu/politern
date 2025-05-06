@extends('layouts.main')

@section('judul')
    Log Aktivitas
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="flex flex-col p-10 lg:pl-76">
        <x-header title="Log Aktivitas" />
        @include('components.student.log-aktivitas.selamat-datang')
    </main>
@endsection