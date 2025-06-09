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
            <nav class="mb-2 mt-2">
                <span class="text-gray-500">Lowongan Magang</span>
                <span class="mx-1 text-gray-400">&gt;</span>
                <span class="text-[#5955B2] font-semibold">
                    {{ $lowongan->bidang->nama_bidang ?? '-' }}
                </span>
            </nav>
            <hr class="mb-6 border-t-2" style="border-color: #5955B2;">
            <div class="flex flex-col lg:flex-row">
                <div class="w-full lg:w-2/3">
                    @include('components.student.detail-lowongan.informasi')
                </div>
                @include('components.student.detail-lowongan.ringkasan')
            </div>
        </section>
    </main>
@endsection