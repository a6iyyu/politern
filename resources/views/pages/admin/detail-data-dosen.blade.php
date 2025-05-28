@extends('layouts.main')

@section('judul')
    Data {{ $dosen->nama }}
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header :title="'Data Dosen ' . $dosen->nama" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300"></main>
@endsection