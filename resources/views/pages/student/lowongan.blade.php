@extends('layouts.main')

@section('judul')
    Lowongan
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Lowongan Magang" />
    <main class="flex flex-col pb-10 px-10 transition-all duration-300">
        @include('components.student.lowongan.filter')
    </main>
@endsection