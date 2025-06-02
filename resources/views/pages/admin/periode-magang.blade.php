@extends('layouts.main')

@section('judul')
    Periode Magang
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Periode Magang" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="p-6 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @if(session('success'))
                <div class="alert alert-success px-4 py-3 mb-4 rounded bg-green-100 text-green-800">
                    {{ session('success') }}
                </div>
            @endif
            <section class="p-6 mt-8 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
                @include('components.admin.periode-magang.tabel')
            </section>
            @include('components.admin.data-dosen.edit')
            @include('components.admin.data-dosen.tambah')
            @include('components.admin.data-dosen.detail')
        </section>
    </main>
@endsection