@extends('layouts.main')

@section('judul')
    Data Mahasiswa
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Data Mahasiswa" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="mt-2 p-6 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            <h5 class="mb-6 text-base font-semibold text-[var(--primary-text)]">
                <i class="fa-solid fa-user-graduate mr-3"></i> Data Mahasiswa
            </h5>
            @include('livewire.data-mahasiswa')
            <x-table
                :headers="['No', 'Mahasiswa', 'NIM', 'Program Studi', 'Perusahaan', 'Magang', 'Status', 'Aksi']"
                :sortable="['Mahasiswa', 'Status']"
                :rows="$data ?? [[1, 'Mahasiswa 1', 2341720000, 'D-IV Teknik Informatika', 'PT. A', 'Front End Developer', 'Aktif', ''], [2, 'Mahasiswa 2', 2341720001, 'D-IV Teknik Informatika', 'PT. B', 'Back End Developer', 'Selesai', '']]"
            />
        </section>
    </main> 
@endsection