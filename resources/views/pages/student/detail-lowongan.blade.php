@extends('layouts.main')

@section('judul')
    Lowongan {{ $lowongan->bidang->nama_bidang }}
@endsection

@section('deskripsi')
@endsection


@section('konten')
    <x-header :title="'Lowongan ' . $lowongan->bidang->nama_bidang" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300"></main>
@endsection