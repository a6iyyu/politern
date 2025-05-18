@extends('layouts.main')

@section('judul')
    Log Aktivitas
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Log Aktivitas" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.student.log-aktivitas.informasi')
        <div class="border border-[var(--stroke)] rounded-lg p-6 mt-5 bg-white shadow-sm">
            @include('components.student.log-aktivitas.filter')
            @include('components.student.log-aktivitas.log-aktivitas')
        </div>
    </main>
@endsection