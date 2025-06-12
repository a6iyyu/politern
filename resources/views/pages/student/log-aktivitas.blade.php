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
            <section class="py-6 px-12 mt-6 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
                @if (!collect($log_aktivitas)->isEmpty())
                    @include('components.student.log-aktivitas.daftar')
                    @include('components.student.log-aktivitas.detail')
                    @include('components.student.log-aktivitas.edit')
                @else
                    <div class="flex flex-col items-center justify-center py-20 text-gray-500 gap-4">
                        <i class="fa-solid fa-circle-info cursor-default text-4xl"></i>
                        <h5 class="cursor-default text-sm text-center">
                            Belum ada log aktivitas. Silakan tambahkan aktivitas magang terlebih dahulu.
                        </h5>
                        <button
                            type="button"
                            data-target="log-mahasiswa"
                            class="mt-4 open cursor-pointer w-fit text-sm bg-[var(--green-tertiary)] text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out lg:hover:bg-[#66c2a3]">
                            Tambah Aktivitas
                        </button>
                    </div>
                @endif
            @include('components.student.log-aktivitas.tambah')
        </section>
    </main>
@endsection