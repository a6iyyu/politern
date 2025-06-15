@extends('layouts.main')

@section('judul')
    Lupa Kata Sandi
@endsection

@section('deskripsi')
    Atur ulang kata sandi Anda
@endsection

@section('konten')
    <main class="bg-white rounded-xl my-20 p-10 w-4/5 border border-slate-300/50 md:w-3/5 lg:w-[45%]">
        <span class="flex items-center justify-center gap-4">
            <img src="{{ asset('shared/logo.png') }}" alt="Politern" class="h-14 w-14" />
            <img src="{{ asset('shared/polinema.png') }}" alt="Polinema" class="h-14 w-14" />
        </span>
        <h4 class="mt-4 cursor-default text-lg text-center font-semibold tracking-wide">
            Lupa Kata Sandi
        </h4>
        <h5 class="mt-1.5 mb-7 cursor-default text-sm text-slate-600 text-center tracking-wide">
            Masukkan email Anda untuk mengatur ulang kata sandi
        </h5>
        @if (session('status'))
            <div class="cursor-default p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('kirim-tautan-reset') }}" method="POST">
            @csrf
            @method('POST')
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
                    placeholder="Masukkan email terdaftar Anda"
                    :required="true"
                    value="{{ old('email') }}"
                />
            </div>
            <button type="submit" class="mt-7 text-sm cursor-pointer w-full py-4 rounded-lg font-semibold transform transition-all duration-500 bg-[#5955b2] text-white lg:focus:outline-none lg:hover:scale-[1.02] lg:hover:bg-[#4f4bad]">
                <i class="fa-solid fa-right-to-bracket"></i>
                &ensp;Kirim Tautan Reset Kata Sandi
            </button>
            <div class="mt-4 text-center text-sm">
                <span class="text-slate-600">Ingat kata sandi Anda?</span>
                <a href="{{ route('masuk') }}" class="text-[var(--primary)] hover:underline">
                    Masuk disini
                </a>
            </div>
        </form>
    </main>
@endsection