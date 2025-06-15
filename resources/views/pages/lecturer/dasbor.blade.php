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
        <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
            <section class="p-7 mt-6 rounded-xl overflow-hidden bg-white border border-[var(--stroke)] flex-3">
                @include('components.lecturer.dasbor.tabel')
            </section>
            <section class="mt-6 border border-[var(--stroke)] rounded-xl p-7 bg-white flex-2">
                @include('components.lecturer.dasbor.log-aktivitas')
            </section>
        </div>
    </main> 
@endsection