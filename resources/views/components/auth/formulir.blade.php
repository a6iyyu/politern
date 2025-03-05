<section
    class="w-full flex flex-col items-center justify-center bg-cover bg-center bg-no-repeat bg-gradient-to-lr from-[#a9d6ff] to-[#edf2f7] text-black lg:w-1/2 lg:px-4"
    style="background: url({{ asset('img/latar-belakang.svg') }})"
>
    <h3 class="cursor-default font-bold text-xl text-[#1a4167] lg:text-3xl">
        Selamat Datang
    </h3>
    <h5 class="mb-5 mt-1 cursor-default text-sm text-gray-600 lg:text-base">
        Silakan masuk ke akun Anda.
    </h5>
    <form action="{{ route('login') }}" method="POST" class="w-3/4 lg:w-[65%]">
        @csrf
        @if ($errors->any())
            <ul class="mb-5 p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="mt-5 space-y-5">
            <x-input
                name="nama_lengkap"
                label="Nama Lengkap"
                icon="fa-solid fa-id-card"
                placeholder="Masukkan Nama Lengkap Anda"
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
        <button type="submit" class="mt-10 cursor-pointer w-full p-4 rounded-lg font-semibold transform transition-all duration-200 bg-emerald-500 text-white focus:outline-none hover:scale-[1.02] hover:bg-emerald-400">
            <i class="fa-solid fa-right-to-bracket"></i>
            &ensp;Masuk
        </button>
    </form>
    <h5 class="mt-8 cursor-default text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Politern
        <br />
        Jurusan Teknologi Informasi Politeknik Negeri Malang
    </h5>
</section>