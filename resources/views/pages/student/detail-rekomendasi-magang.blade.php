@extends('layouts.main')

@section('judul')
    Detail Lowongan {{ $lowongan_magang->perusahaan->nama }}
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header :title="'Lowongan ' . $lowongan_magang->judul" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300"></main>
@endsection