@extends('layouts.main')

@section('judul')
    {{ $admin->nama }}
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header :title="$admin->nama" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="p-6 mt-2 rounded-lg overflow-hidden bg-white border border-[var(--stroke)]">
            <h5 class="mb-6 px-8 py-4 font-semibold rounded-lg shadow-lg bg-[var(--secondary)] text-[var(--background)]">
                Profil Admin
            </h5>
            @include('components.admin.profil.pengguna')
        </section>
    </main>
@endsection