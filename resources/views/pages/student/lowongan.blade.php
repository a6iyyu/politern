@extends('layouts.main')

@section('judul')
    Lowongan
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="flex flex-col p-10 lg:pl-76">
        @include('components.student.lowongan.filter')
    </main>
@endsection