@extends('layouts.main')

@section('judul')
    Dasbor
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <main class="flex flex-col p-10 lg:pl-76">
        @include('components.student.dasbor.selamat-datang')
        <div class="flex flex-col w-[45%]">
            @include('components.student.dasbor.rekomendasi-magang')
        </div>
    </main> 
@endsection