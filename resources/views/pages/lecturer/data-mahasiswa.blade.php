@extends('layouts.main')

@section('judul')
    Data Mahasiswa
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Data Mahasiswa" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.lecturer.data-mahasiswa.filter')
        @include('components.lecturer.data-mahasiswa.daftar')
    </main> 
@endsection