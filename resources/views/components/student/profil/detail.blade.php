@php
    use App\Models\Mahasiswa;
    /** @var Mahasiswa $mahasiswa */
@endphp

<h5 class="cursor-default font-semibold text-sm">
    Deskripsi
</h5>
<h5 class="cursor-default mt-3 text-sm px-6 py-4 border border-[var(--stroke)] rounded-lg">
    {{ $mahasiswa->deskripsi ?? 'N/A' }}
</h5>
<h5 class="cursor-default mt-6 font-semibold text-sm">
    Daftar Riwayat Hidup
</h5>
<h5 class="cursor-default mt-3 text-sm px-6 py-4 border border-[var(--stroke)] rounded-lg">
    {{ $mahasiswa->cv ?? 'N/A' }}
</h5>
<h5 class="cursor-default mt-6 font-semibold text-sm">
    Preferensi Lokasi Magang
</h5>
<span class="mt-3 flex flex-wrap gap-3">
    @if ($mahasiswa->lokasi)
        @foreach ($mahasiswa->lokasi as $lokasi)
            <h5 class="cursor-pointer w-fit text-xs font-semibold px-5 py-2 border border-[var(--secondary)] text-[var(--secondary)] rounded-full transition-all duration-300 ease-in-out hover:bg-[var(--secondary)] hover:text-white">
                {{ $lokasi->nama_lokasi ?? 'N/A' }}
            </h5>
        @endforeach
    @endif
</span>
<h5 class="cursor-default mt-6 font-semibold text-sm">
    Preferensi Bidang Minat Magang
</h5>
<span class="mt-3 flex flex-wrap gap-3">
    @if (isset($mahasiswa->bidang))
        @foreach ($mahasiswa->bidang()->get() as $bidang)
            <h5 class="cursor-pointer w-fit text-xs font-semibold px-5 py-2 border border-[var(--secondary)] text-[var(--secondary)] rounded-full transition-all duration-300 ease-in-out hover:bg-[var(--secondary)] hover:text-white">
                {{ $bidang->nama_bidang ?? 'N/A' }}
            </h5>
        @endforeach
    @endif
</span>
<h5 class="cursor-default mt-6 font-semibold text-sm">
    Keahlian
</h5>
<span class="mt-3 flex flex-wrap gap-3">
    @if (isset($mahasiswa->keahlian))
        @foreach ($mahasiswa->keahlian()->get() as $keahlian)
            <h5 class="cursor-pointer w-fit text-xs font-semibold px-5 py-2 border border-[var(--secondary)] text-[var(--secondary)] rounded-full transition-all duration-300 ease-in-out hover:bg-[var(--secondary)] hover:text-white">
                {{ $keahlian->nama_keahlian ?? 'N/A' }}
            </h5>
        @endforeach
    @endif
</span>