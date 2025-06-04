@php
    use App\Models\Mahasiswa;
    use Carbon\Carbon;

    /** @var Mahasiswa $mahasiswa */
    foreach ($mahasiswa->sertifikasi_pelatihan()->get() as $sertifikasi) {
        $mulai = Carbon::parse($sertifikasi->tanggal_mulai)->translatedFormat('d F Y');
        $selesai = Carbon::parse($sertifikasi->tanggal_selesai)->translatedFormat('d F Y');
    }
@endphp

@if ($mahasiswa->sertifikasi_pelatihan)
    @foreach ($mahasiswa->sertifikasi_pelatihan()->get() as $sertifikasi)
        <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
            <span class="flex flex-col gap-2">
                <h5 class="cursor-default font-semibold text-[var(--primary)]">
                    {{ $sertifikasi->nama_sertifikasi_pelatihan }}
                </h5>
                <h5 class="cursor-default text-[var(--primary)]">
                    {{ $sertifikasi->nama_lembaga }}
                </h5>
            </span>
            <span class="flex flex-col gap-2">
                <h5 class="cursor-default font-semibold text-[var(--secondary-text)]">
                    Bukti Pendukung
                </h5>
                <a href="{{ $sertifikasi->bukti_pendukung }}" class="underline transition-all duration-300 ease-in-out text-[var(--primary)] lg:hover:text-[var(--primary)]/50">
                    {{ $sertifikasi->bukti_pendukung }}
                </a>
            </span>
        </div>
        <hr class="my-1 border border-[var(--stroke)] last:hidden" />
        <h5 class="cursor-default font-semibold text-sm text-[var(--secondary-text)]">
            Deskripsi
        </h5>
        <h5 class="cursor-default text-sm text-[var(--primary-text)]">
            {{ $sertifikasi->deskripsi }}
        </h5>
        <div class="mt-2 grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
            <span class="flex flex-col gap-2">
                <h5 class="cursor-default font-semibold text-[var(--secondary-text)]">
                    Tanggal Terbit
                </h5>
                <h5 class="cursor-default w-fit px-3 py-1 rounded-full border border-[var(--primary)] text-[var(--primary)]">
                    {{ $mulai }}
                </h5>
            </span>
            <span class="flex flex-col gap-2">
                <h5 class="cursor-default font-semibold text-[var(--secondary-text)]">
                    Tanggal Kedaluwarsa
                </h5>
                <h5 class="cursor-default w-fit px-3 py-1 rounded-full border border-[var(--primary)] text-[var(--primary)]">
                    {{ $selesai }}
                </h5>
            </span>
        </div>
        <hr class="my-3 border border-[var(--primary)] last:hidden" />
    @endforeach
@else
    <i class="fa-solid fa-triangle-exclamation mt-12 text-5xl text-center text-[var(--primary)]"></i>
    <h5 class="mb-12 cursor-default text-center text-[var(--primary)]">
        Tidak ada pengalaman yang tercatat.
    </h5>
@endif