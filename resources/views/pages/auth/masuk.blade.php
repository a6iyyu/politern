@extends('layouts.main')

@section('judul')
    Masuk
@endsection

@section('deskripsi')
    Selamat datang!
@endsection

@section('konten')
    <main class="bg-white rounded-xl my-20 p-10 w-4/5 border border-slate-300/50 md:w-3/5 lg:w-[45%]">
        <div class="flex items-center justify-center gap-4">
            <img src="{{ asset('shared/logo.png') }}" alt="Politern" class="h-14 w-14" />
            <img src="{{ asset('shared/polinema.png') }}" alt="Polinema" class="h-14 w-14" />
        </div>
        <h4 class="mt-4 cursor-default text-lg text-center font-semibold tracking-wide">
            Selamat Datang 👋🏻
        </h4>
        <h5 class="mt-1.5 mb-7 cursor-default text-sm text-slate-600 text-center tracking-wide">
            Silakan masuk dengan akun Anda.
        </h5>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            @method('POST')
            @if ($errors->any())
                <ul class="p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="mt-5 space-y-5">
                <x-input
                    icon="fa-solid fa-id-card"
                    label="Nama Pengguna"
                    name="nama_pengguna"
                    placeholder="Masukkan Nama Pengguna Anda"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-lock"
                    label="Kata Sandi"
                    name="kata_sandi"
                    placeholder="Masukkan Kata Sandi Anda"
                    type="password"
                    :required="true"
                />
            </div>
            <div class="mt-5 flex items-center justify-between text-sm">
                <fieldset class="flex items-center gap-2 text-[#a5a5a5]">
                    <input type="checkbox" name="" id="" />
                    <label for="">Ingat Saya?</label>
                </fieldset>
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