@extends('layouts.main')

@section('judul')
    Dasbor
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Dasbor" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.lecturer.dasbor.informasi')
        <div class="flex flex-col lg:flex-row gap-4 items-baseline">
            <section class="p-7 mt-6 rounded-xl overflow-hidden bg-white border border-[var(--stroke)] flex-3">
                @include('components.lecturer.dasbor.tabel')
            </section>
            @include('components.lecturer.dasbor.log-aktivitas')
        </div>
    </main> 
@endsection