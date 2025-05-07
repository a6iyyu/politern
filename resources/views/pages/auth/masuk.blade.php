@extends('layouts.main')

@section('judul')
    Masuk
@endsection

@section('deskripsi')
    Selamat datang!
@endsection

@section('konten')
    <main class="bg-white rounded-xl my-20 p-10 w-4/5 border border-slate-300/50 md:w-3/5 lg:w-[45%]">
        <span class="absolute flex space-x-4 top-4 left-6">
            <img src="{{ asset('shared/polinema.png') }}" alt="Polinema" class="h-14 w-14" />
            <section></section>
        </span>
        <h4 class="cursor-default text-xl text-center font-semibold tracking-wide">Selamat Datang 👋🏻</h4>
        <h5 class="mt-2 mb-7 cursor-default text-slate-600 text-center tracking-wide">Silakan masuk dengan akun Anda.</h5>
        <form action="{{ route('login') }}" method="POST">
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
                    name="kata_sandi"
                    label="Kata Sandi"
                    type="password"
                    icon="fa-solid fa-lock"
                    placeholder="Masukkan Kata Sandi Anda"
                    required
                />
            </div>
            <div class="mt-5 flex items-center justify-between text-sm">
                <span class="flex items-center gap-2 text-[#a5a5a5]">
                    <input type="checkbox" name="" id="" />
                    <label for="">Ingat Saya?</label>
                </span>
                <a href="{{ route('lupa-kata-sandi') }}"
                    class="text-[#5955b2] lg:hover:underline transition-all duration-300 lg:hover:text-[#4f4bad]">
                    Lupa Kata Sandi?
                </a>
            </div>
            <button type="submit" class="mt-7 text-sm cursor-pointer w-full py-4 rounded-lg font-semibold transform transition-all duration-500 bg-[#5955b2] text-white lg:focus:outline-none lg:hover:scale-[1.02] lg:hover:bg-[#4f4bad]">
                <i class="fa-solid fa-right-to-bracket"></i>
                &ensp;Masuk
            </button>
        </form>
        <div class="flex mt-10 flex-col items-start justify-between space-y-3 text-sm text-[#5955b2] sm:flex-row sm:items-center">
            <span>
                <i class="fa-solid fa-globe mr-2"></i>
                <a href="https://polinema.ac.id" class="font-semibold">polinema.ac.id</a>
            </span>
            <span class="flex items-center">
                <i class="fa-solid fa-phone mr-2"></i>
                <h4 class="font-semibold">0341 - 404424/404425</h4>
            </span>
        </div>
    </main>
@endsection