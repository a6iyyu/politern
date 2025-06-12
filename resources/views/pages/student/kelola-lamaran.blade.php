@extends('layouts.main')

@section('judul')
    Kelola Lamaran
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Kelola Lamaran"/>
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="py-6 px-12 mt-6 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @include('components.student.kelola-lamaran.filter')
            @include('components.student.kelola-lamaran.tabel')
        </section>
            @include('components.student.kelola-lamaran.detail')
            @include('components.student.kelola-lamaran.aksi')
    </main> 

@endsection