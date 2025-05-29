@extends('layouts.main')

@section('judul')
    Periode Magang
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Periode Magang" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="p-6 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            <span class="flex items-center justify-between mb-7">
                <h5 class="text-base font-semibold text-[var(--primary-text)]">
                    Periode Magang
                </h5>
                <button data-target="periode" class="open text-sm bg-[var(--primary)] text-white px-4 py-3 rounded-md cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
                    Tambah Periode
                </button>
            </span>
            @include('livewire.periode-magang')
            <x-table
                :headers="['No', 'Nama Periode', 'Tahun', 'Semester', 'Tanggal Mulai', 'Tanggal Selesai', 'Status', 'Aksi']"
                :sortable="['Nama Periode', 'Tahun']"
                :rows="$data"
            />
            @include('components.admin.periode-magang.tambah')
        </section>
    </main>
@endsection