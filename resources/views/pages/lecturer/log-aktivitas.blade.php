@extends('layouts.main')

@section('judul')
    Log Aktivitas
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Log Aktivitas" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.lecturer.log-aktivitas.filter')
        @include('components.lecturer.log-aktivitas.daftar')
    </main> 
@endsection