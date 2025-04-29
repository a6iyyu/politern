@extends('layouts.main')

@section('judul')
    Daftar
@endsection

@section('deskripsi')
    Selamat datang!
@endsection

@section('konten')
    {{-- Ayleen --}}

    <main class="bg-white rounded-xl p-10 w-4/5 border border-slate-300/50 md:w-3/5 lg:w-3/8">
        <span class="absolute flex space-x-4 top-4 left-6">
            <img src="{{ asset('shared/polinema.png') }}" alt="Polinema" class="h-14 w-14" />
            <img src="" alt="" /> {{-- This will be an image of Politern logo. --}}
        </span>
        <h4 class="cursor-default text-xl text-center font-semibold tracking-wide">Selamat Datang</h4>
        <h5 class="mt-2 mb-7 cursor-default text-slate-600 text-center tracking-wide">Silahkan daftar untuk membuat akun baru.</h5>
        <form action="{{ route('daftar') }}" method="POST">
            @csrf
            @if ($errors->any())
                <ul class="p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="mt-5 space-y-5">
                <x-input
                    name="nama_pengguna"
                    label="Nama Pengguna"
                    icon="fa-solid fa-id-card"
                    placeholder="Masukkan Nama Pengguna Anda"
                    required
                />
                <x-input
                    name="nim"
                    label="NIM"
                    icon="fa-solid fa-user-graduate"
                    placeholder="Masukkan NIM Anda"
                    required
                />
                <x-input
                    name="kata_sandi"
                    label="Kata Sandi"
                    type="password"
                    icon="fa-solid fa-lock"
                    placeholder="Masukkan Kata Sandi Anda"
                    required
                />
                <x-input
                    name="konfirmasi_kata_sandi"
                    label="Konfirmasi Kata Sandi"
                    type="password"
                    icon="fa-solid fa-lock"
                    placeholder="Masukkan Konfirmasi Kata Sandi Anda"
                    required
                />
            </div>
            <div class="mt-5 flex items-center justify-end text-sm">
                <a href="{{ route('masuk') }}" class="text-[#5955b2] lg:hover:underline transition-all duration-300 lg:hover:text-[#4f4bad]">
                    Sudah Punya Akun?
                </a>
            </div>
            <button type="submit" class="mt-7 text-sm cursor-pointer w-full p-4 rounded-lg font-semibold transform transition-all duration-500 bg-[#5955b2] text-white lg:focus:outline-none lg:hover:scale-[1.02] lg:hover:bg-[#4f4bad]">
                <i class="fa-solid fa-right-to-bracket"></i>
                &ensp;Daftar
            </button>
        </form>
    </main>
@endsection