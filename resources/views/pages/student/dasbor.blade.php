@extends('layouts.main')

@section('judul')
    Dasbor
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Dasbor" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.student.dasbor.informasi')
        <section class="py-8 px-12 mt-8 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            @include('components.student.dasbor.rekomendasi-magang')
        </section>
    </main> 
@endsection