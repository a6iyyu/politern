@extends('layouts.main')

@section('judul')
    {{ $admin->nama }}
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header :title="$admin->nama" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300"></main>
@endsection