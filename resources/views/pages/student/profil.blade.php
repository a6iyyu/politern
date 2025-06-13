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
            <article class="mt-6 flex flex-col gap-4">
                <h5 class="font-semibold text-[var(--primary)]">
                    Kompetensi Mahasiswa
                </h5>
                @if (session('success'))
                    <h5 class="mb-7 p-4 cursor-default rounded-lg bg-emerald-50 border border-emerald-500 list-disc list-inside text-sm text-emerald-500">
                        {{ session('success') }}
                    </h5>
                @elseif ($errors->any())
                    <ul class="mb-7 p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="flex flex-col gap-2 justify-between md:items-center md:flex-row">
                    <h6 class="cursor-default font-semibold text-[var(--secondary-text)]">
                        Pengalaman
                    </h6>
                    <button
                        type="button"
                        class="open cursor-pointer w-fit text-xs bg-[var(--green-tertiary)] text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out lg:hover:bg-[#66c2a3]"
                        data-target="tambah-pengalaman-mahasiswa"    
                    >
                        Tambah
                    </button>
                </div>
                <figure class="flex flex-col p-6 rounded-lg gap-4 border border-[var(--stroke)]">
                    @include('components.student.profil.pengalaman')
                </figure>
                <div class="flex flex-col gap-2 justify-between md:items-center md:flex-row">
                    <h6 class="cursor-default font-semibold text-[var(--secondary-text)]">
                        Sertifikasi Pelatihan
                    </h6>
                    <button
                        type="button"
                        class="open cursor-pointer w-fit text-xs bg-[var(--green-tertiary)] text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out lg:hover:bg-[#66c2a3]"
                        data-target="tambah-sertifikasi-pelatihan-mahasiswa"    
                    >
                        Tambah
                    </button>
                </div>
                <figure class="flex flex-col p-6 rounded-lg gap-4 border border-[var(--stroke)]">
                    @include('components.student.profil.sertifikasi')
                </figure>
                <div class="flex flex-col gap-2 justify-between md:items-center md:flex-row">
                    <h6 class="cursor-default font-semibold text-[var(--secondary-text)]">
                        Proyek
                    </h6>
                    <button
                        type="button"
                        class="open cursor-pointer w-fit text-xs bg-[var(--green-tertiary)] text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out lg:hover:bg-[#66c2a3]"
                        data-target="tambah-proyek-mahasiswa"    
                    >
                        Tambah
                    </button>
                </div>
                <figure class="flex flex-col p-6 rounded-lg gap-4 border border-[var(--stroke)]">
                    @include('components.student.profil.proyek')
                </figure>
            </article>
        </section>
    </main>
@endsection