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

<figure class="cursor-pointer flex items-center gap-4 font-medium text-[#585858]">
    <figcaption class="hidden flex-col text-right text-sm tracking-wider sm:flex">
        {{ $nama }}
        <br />
        {{ Auth::check() && Auth::user()->tipe === 'MAHASISWA' ? $nim : $nip }}
    </figcaption>
    <img
        src="{{ asset('shared/profil.png') }}"
        alt="Foto Profil"
        class="h-12 w-12 object-cover rounded-full"
        loading="lazy"
    />
</figure>