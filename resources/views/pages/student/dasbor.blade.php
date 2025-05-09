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
        <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            @include('components.student.dasbor.rekomendasi-magang')
            @include('components.student.dasbor.linimasa')
        </section>
    </main> 
@endsection