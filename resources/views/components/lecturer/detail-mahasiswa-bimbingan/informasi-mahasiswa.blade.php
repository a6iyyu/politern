<h5 class="mb-3.5 mt-10 px-8 py-4 font-semibold rounded-lg bg-[var(--secondary)] text-[var(--background)]">
    Informasi Mahasiswa
</h5>
<h5 class="my-1 px-8 font-semibold text-sm">
    Deskripsi
</h5>
<h5 class="mt-2 px-8 py-4 rounded-lg text-sm bg-[#eeeeee]">
    {{ $mahasiswa->pengguna->mahasiswa->deskripsi ?? 'N/A' }}
</h5>
<section class="mt-2 grid grid-cols-1 gap-8 lg:grid-cols-3">
    <div class="flex flex-col text-sm lg:col-span-2">
        <h5 class="mt-2 px-8 font-semibold">Daftar Riwayat Hidup</h5>
        <span class="mt-4 flex items-center justify-between pl-8 pr-1 py-1 rounded-lg bg-[#eeeeee]">
            <a href="" target="_blank" class="underline text-[var(--primary)]">
                CV - {{ $mahasiswa->pengguna->mahasiswa->nama_lengkap }}
            </a>
            <a href="" class="px-6 py-2 rounded-md bg-[var(--primary)] text-[var(--background)]">
                Unduh
            </a>
        </span>
    </div>
    <div class="flex flex-col text-sm">
        <h5 class="mt-2 px-8 font-semibold">Nilai Tes</h5>
        <span class="mt-4 flex items-center justify-between px-8 py-3 rounded-lg bg-[#eeeeee]">
            {{ $mahasiswa->pengguna->mahasiswa->nilai_tes ?? "N/A" }}
        </span>
    </div>
</section>
<section class="mt-2 grid grid-cols-1 px-8 pb-2 pt-4 gap-4 lg:grid-cols-2">
    <div class="flex flex-col gap-3">
        <h5 class="font-semibold text-sm">Preferensi lokasi magang</h5>
        <ul class="flex flex-wrap gap-2">
            @if ($mahasiswa->pengguna->mahasiswa->lokasi)
                @foreach ($mahasiswa->pengguna->mahasiswa->lokasi as $lokasi)
                    <li class="cursor-pointer text-xs px-5 py-2 rounded-full transition-all duration-300 ease-in-out border border-[var(--secondary)] text-[var(--secondary)] lg:hover:bg-[#fb90cc] lg:hover:text-white">
                        {{ $lokasi->nama_lokasi }}
                    </li>
                @endforeach
            @else
                <li class="text-sm">
                    Tidak ada data terkait nama bidang dari mahasiswa bimbingan ini.
                </li>
            @endif
        </ul>
    </div>
    <div class="flex flex-col gap-3">
        <h5 class="font-semibold text-sm">Preferensi bidang minat magang</h5>
        <ul class="flex flex-wrap gap-2">
            @if ($mahasiswa->pengguna->mahasiswa->bidang)
                @foreach ($mahasiswa->pengguna->mahasiswa->bidang as $bidang)
                    <li class="cursor-pointer text-xs px-5 py-2 rounded-full transition-all duration-300 ease-in-out border border-[var(--secondary)] text-[var(--secondary)] lg:hover:bg-[#fb90cc] lg:hover:text-white">
                        {{ $bidang->nama_bidang }}
                    </li>
                @endforeach
            @else
                <li class="text-sm">
                    Tidak ada data terkait nama bidang dari mahasiswa bimbingan ini.
                </li>
            @endif
        </ul>
    </div>
</section>
<h5 class="font-semibold px-8 my-4 text-sm">
    Keahlian
</h5>
<ul class="flex flex-wrap gap-2 px-8">
    @foreach ($mahasiswa->pengguna->mahasiswa->keahlian as $keahlian)
        <li class="cursor-pointer text-xs px-5 py-2 rounded-full transition-all duration-300 ease-in-out bg-[var(--secondary)] text-white lg:hover:bg-[#fb90cc]">
            {{ $keahlian->nama_keahlian }}
        </li>
    @endforeach
</ul>