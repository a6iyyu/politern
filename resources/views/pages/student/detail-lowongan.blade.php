@extends('layouts.main')

@section('judul')
    Lowongan {{ $lowongan->bidang->nama_bidang }}
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header :title="'Lowongan '"/>
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="py-6 px-12 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            <span class="cursor-default flex items-center mb-2 mt-2">
                <a href="{{ route('mahasiswa.lowongan') }}" class="text-gray-500">Lowongan Magang</a>
                <h5 class="mx-1 text-gray-400">&gt;</h5>
                <h5 class="text-[#5955B2] font-semibold">
                    {{ $lowongan->bidang->nama_bidang ?? '-' }}
                </h5>
            </span>
            <hr class="mb-6 border-t-2 border-[var(--primary)]">
            <div class="grid grid-cols-1 gap-8 xl:grid-cols-2">
                @include('components.student.detail-lowongan.informasi')
                @include('components.student.detail-lowongan.ringkasan')
                @include('components.student.detail-lowongan.lamar')
            </div>
        </section>
    </main>
@endsection