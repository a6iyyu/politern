@extends('layouts.main')

@section('judul')
    Data Perusahaan {{ $perusahaan->id_perusahaan_mitra }}
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Data Perusahaan" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300"></main>
@endsection