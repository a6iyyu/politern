@extends('layouts.main')

@section('judul')
    {{ $dosen->nama }}
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header :title="$dosen->nama" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="p-6 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            <h5 class="mb-6 px-8 py-4 font-semibold rounded-lg shadow-lg bg-[var(--secondary)] text-[var(--background)]">
                Profil Dosen
            </h5>
            @include('components.lecturer.profil.pengguna')
        </section>
    </main>
@endsection