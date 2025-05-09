@extends('layouts.main')

@section('judul')
    Lowongan
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Lowongan" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('livewire.filter-lowongan')
        @include('components.student.lowongan.daftar-lowongan')
    </main>
@endsection