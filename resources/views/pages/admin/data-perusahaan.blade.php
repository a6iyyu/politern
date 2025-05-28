@extends('layouts.main')

@section('judul')
    Data Perusahaan
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Data Perusahaan" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.admin.data-perusahaan.filter')
        @foreach ($perusahaan as $id)
            @include('components.admin.data-perusahaan.daftar', compact('id'))
        @endforeach
    </main>
@endsection