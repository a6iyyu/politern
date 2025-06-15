@extends('layouts.main')

@section('judul', 'Reset Kata Sandi')

@section('konten')
    <main class="bg-white rounded-xl my-20 p-10 w-4/5 border border-slate-300/50 md:w-3/5 lg:w-[45%] mx-auto">
        <span class="flex items-center justify-center gap-4">
            <img src="{{ asset('shared/logo.png') }}" alt="Politern" class="h-14 w-14" />
            <img src="{{ asset('shared/polinema.png') }}" alt="Polinema" class="h-14 w-14" />
        </span>
        <h4 class="mt-4 cursor-default text-lg text-center font-semibold tracking-wide">
            Reset Kata Sandi
        </h4>
        @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('status') }}
            </div>
        @endif
        @if (isset($error))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                {{ $error }}
            </div>
        @endif
        <form action="{{ route('perbarui-kata-sandi') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            @if ($errors->any())
                <ul class="p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500 mb-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <div class="space-y-5">
                <x-input
                    icon="fa-solid fa-envelope"
                    label="Email"
                    name="email"
                    type="email"
                    placeholder="Masukkan email Anda"
                    :required="true"
                    value="{{ old('email', $email ?? '') }}"
                    readonly
                />
                <x-input
                    icon="fa-solid fa-lock"
                    label="Kata Sandi Baru"
                    name="password"
                    type="password"
                    placeholder="Masukkan kata sandi baru"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-lock"
                    label="Konfirmasi Kata Sandi Baru"
                    name="password_confirmation"
                    type="password"
                    placeholder="Konfirmasi kata sandi baru"
                    :required="true"
                />
            </div>
            <button type="submit" class="mt-7 text-sm cursor-pointer w-full py-4 rounded-lg font-semibold transform transition-all duration-500 bg-[#5955b2] text-white lg:focus:outline-none lg:hover:scale-[1.02] lg:hover:bg-[#4f4bad]">
                <i class="fa-solid fa-key"></i>
                &ensp;Reset Kata Sandi
            </button>
        </form>
    </main>
@endsection