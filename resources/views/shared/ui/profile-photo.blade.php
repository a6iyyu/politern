{{-- 
    🧩 Komponen Foto Profil Otomatis (shared.ui.profile-photo)
    -----------------------------------------------------------

    Komponen ini menampilkan nama lengkap dan NIM mahasiswa secara otomatis,
    tanpa perlu mengoper variabel dari controller.

    🔧 Cara kerja:
    - Data di-inject otomatis melalui View Composer di file `App\Providers\ProfilePhotoProvider`
    - Menambahkan registrasi Providers di file `config/app.php`
    - Provider ini mendaftarkan composer khusus untuk view `shared.ui.profile-photo`
    - Data yang diberikan otomatis: $nama_lengkap dan $nim

    ✅ Tidak perlu lagi:
        @include('shared.ui.profile-photo', ['nama_lengkap' => ..., 'nim' => ...])

    💡 Cukup panggil seperti biasa:
        @include('shared.ui.profile-photo')

    📁 Pastikan provider sudah terdaftar di config/app.php:
        App\Providers\ProfilePhotoProvider::class,

    📌 Catatan:
    - Data hanya diberikan jika pengguna bertipe 'MAHASISWA'
    - Ubah logic di provider jika ingin support tipe lain seperti 'ADMIN'
--}}

@php
    $route = match(Auth::check() ? Auth::user()->tipe : null) {
        'ADMIN'     => route('admin.profil'),
        'DOSEN'     => route('dosen.profil'),
        'MAHASISWA' => route('mahasiswa.profil'),
    }
@endphp

<figure class="relative cursor-pointer flex items-center gap-4 font-medium text-[#585858]">
    <figcaption class="hidden flex-col text-right text-sm tracking-wider sm:flex">
        {{ $nama }}
        <br />
        {{ Auth::check() && Auth::user()->tipe === 'MAHASISWA' ? $nim : $nip }}
    </figcaption>
    <img
        src="{{ asset('shared/profil.png') }}"
        alt="Foto Profil"
        id="profile-picture"
        class="h-12 w-12 object-cover rounded-full"
        loading="lazy"
    />
    <section id="profile-menu" class="absolute top-14 right-0 hidden bg-white shadow rounded px-5 py-3 z-50 flex-col border border-[#d3d3d3] gap-2.5 text-sm">
        <a href="{{ $route }}" class="flex items-center transition-all duration-300 ease-in-out gap-3 hover:text-blue-500">
            <i class="fa-solid fa-user"></i>
            <h6>Profil</h6>
        </a>
        <hr class="border border-[#cecece50]" />
        <a href="{{ route('keluar') }}" class="flex items-center transition-all duration-300 ease-in-out gap-3 hover:text-red-500">
            <i class="fa-solid fa-right-from-bracket"></i>
            <h6>Keluar</h6>
        </a>
    </section>
</figure>