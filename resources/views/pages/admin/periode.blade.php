@extends('layouts.main')

@section('judul')
    Periode
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Periode" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="py-6 px-12 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @include('components.admin.periode.tabel')
        </section>
        @include('components.admin.periode.tambah')
        @include('components.admin.periode.edit')
        @include('components.admin.periode.detail')
    </main>
@endsection