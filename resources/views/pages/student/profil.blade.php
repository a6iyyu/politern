@extends('layouts.main')

@section('judul')
    {{ $mahasiswa->nama_lengkap }}
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header :title="$mahasiswa->nama_lengkap" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="p-6 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            <h5 class="mb-10 px-8 py-4 font-semibold rounded-lg shadow-lg bg-[var(--secondary)] text-[var(--background)]">
                Profil Mahasiswa
            </h5>
            <article class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                @include('components.student.profil.pengguna')
                <div>
                    @include('components.student.profil.detail')
                </div>
                <a href="{{ route('mahasiswa.profil.edit') }}" class="block w-full px-4 py-2.5 font-semibold rounded-lg text-center text-sm border border-[var(--primary)] text-[var(--primary)] transition-all duration-300 ease-in-out lg:hidden lg:hover:bg-[var(--primary)] lg:hover:text-white">
                    Edit Profil
                </a>
            </article>
            <article class="mt-6 flex flex-col gap-4">
                <h5 class="font-semibold text-[var(--primary)]">
                    Kompetensi Mahasiswa
                </h5>
                <h6 class="font-medium text-sm text-[var(--secondary-text)]">
                    Pengalaman
                </h6>
                <figure class="flex flex-col p-6 rounded-lg gap-4 border border-[var(--stroke)]">
                    @include('components.student.profil.pengalaman')
                </figure>
                <h6 class="font-medium text-sm text-[var(--secondary-text)]">
                    Sertifikasi Pelatihan
                </h6>
                <figure class="flex flex-col p-6 rounded-lg gap-4 border border-[var(--stroke)]">
                    @include('components.student.profil.sertifikasi')
                </figure>
                </figure>
                <h6 class="font-medium text-sm text-[var(--secondary-text)]">
                    Proyek
                </h6>
                <figure class="flex flex-col p-6 rounded-lg gap-4 border border-[var(--stroke)]">
                    @include('components.student.profil.proyek')
                </figure>
            </article>
        </section>
    </main>
@endsection