@extends('layouts.main')

@section('judul')
    Data {{ $mahasiswa->nama_lengkap }}
@endsection

@section('deskripsi')
    Detail informasi dari mahasiswa bimbingan Anda yang bernama {{ $mahasiswa->nama_lengkap }}.
@endsection

@section('konten')
    <x-header title="Data Mahasiswa Bimbingan" />
    <main class="cursor-default flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.lecturer.detail-mahasiswa-bimbingan.informasi-pengguna')
        @include('components.lecturer.detail-mahasiswa-bimbingan.data-mahasiswa')
        @include('components.lecturer.detail-mahasiswa-bimbingan.informasi-mahasiswa')
        @include('components.lecturer.detail-mahasiswa-bimbingan.pengalaman')
    </main>
@endsection