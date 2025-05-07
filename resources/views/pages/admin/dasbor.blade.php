@extends('layouts.main')

@section('judul')
    Dasbor
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Dasbor" />
    <main class="flex flex-col pb-10 px-10 transition-all duration-300">
        @include('components.admin.dasbor.informasi')
    </main>
@endsection