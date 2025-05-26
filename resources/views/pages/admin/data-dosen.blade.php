@extends('layouts.main')

@section('judul')
    Data Dosen
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Data Dosen" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.admin.data-dosen.informasi')
        @include('components.admin.data-dosen.tabel')
    </main>
@endsection