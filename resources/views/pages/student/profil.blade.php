@extends('layouts.main')

@section('judul')
    {{ $mahasiswa->nama_lengkap }}
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header :title="$mahasiswa->nama_lengkap" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        @include('components.student.profil.edit-pengalaman')
        @include('components.student.profil.tambah-pengalaman')
        @include('components.student.profil.edit-proyek')
        @include('components.student.profil.tambah-proyek')
        <section class="p-6 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            <h5 class="mb-10 px-8 py-4 font-semibold rounded-lg shadow-lg bg-[var(--secondary)] text-[var(--background)]">
                Profil Mahasiswa
            </h5>
            <article class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                @include('components.student.profil.pengguna')
                <div>
                    @include('components.student.profil.detail')
                </div>
            </article>
        </section>
    </main>
@endsection