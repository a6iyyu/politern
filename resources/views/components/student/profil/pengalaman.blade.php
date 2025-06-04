@php
    use App\Models\Mahasiswa;
    use Carbon\Carbon;

    /** @var Mahasiswa $mahasiswa */
    foreach ($mahasiswa->pengalaman()->get() as $pengalaman) {
        $mulai = Carbon::parse($pengalaman->tanggal_mulai)->translatedFormat('d F Y');
        $selesai = Carbon::parse($pengalaman->tanggal_selesai)->translatedFormat('d F Y');
    }
@endphp

@if ($mahasiswa->pengalaman)
    @foreach ($mahasiswa->pengalaman()->get() as $pengalaman)
        <h5 class="cursor-default font-semibold text-[var(--primary)]">
            {{ ucfirst($pengalaman->jenis_pengalaman) }}
        </h5>
        <div class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
            <span class="flex flex-col gap-2">
                <h5 class="cursor-default font-semibold text-[var(--primary)]">
                    {{ $pengalaman->posisi }}
                </h5>
                <h5 class="cursor-default text-[var(--primary)]">
                    {{ $pengalaman->nama_lembaga }}
                </h5>
            </span>
            <span class="flex flex-col gap-2">
                <h5 class="cursor-default font-semibold text-[var(--secondary-text)]">
                    Bukti Pendukung
                </h5>
                <a href="{{ $pengalaman->bukti_pendukung }}" class="underline transition-all duration-300 ease-in-out text-[var(--primary)] lg:hover:text-[var(--primary)]/50">
                    {{ $pengalaman->bukti_pendukung }}
                </a>
            </span>
        </div>
        <hr class="my-1 border border-[var(--stroke)]" />
        <h5 class="cursor-default font-semibold text-sm text-[var(--primary)]">
            Deskripsi
        </h5>
        <h5 class="cursor-default text-sm text-[var(--primary-text)]">
            {{ $pengalaman->deskripsi }}
        </h5>
        <h5 class="cursor-default font-semibold text-sm text-[var(--primary)]">
            Tanggal Mulai - Selesai
        </h5>
        <h5 class="cursor-default text-sm text-[var(--primary-text)]">
            {{ $mulai }} - {{ $selesai }}
        </h5>
        <hr class="my-3 border border-[var(--primary)] last:hidden" />
    @endforeach
@else
    <i class="fa-solid fa-triangle-exclamation mt-12 text-5xl text-center text-[var(--primary)]"></i>
    <h5 class="mb-12 cursor-default text-center text-[var(--primary)]">
        Tidak ada pengalaman yang tercatat.
    </h5>
@endif