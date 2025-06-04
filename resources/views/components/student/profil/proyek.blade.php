@php
    use App\Models\Mahasiswa;
    use Carbon\Carbon;

    /** @var Mahasiswa $mahasiswa */
    foreach ($mahasiswa->proyek()->get() as $proyek) {
        $mulai = Carbon::parse($proyek->tanggal_mulai)->translatedFormat('d F Y');
        $selesai = Carbon::parse($proyek->tanggal_selesai)->translatedFormat('d F Y');
    }
@endphp

@if ($mahasiswa->proyek)
    @foreach ($mahasiswa->proyek()->get() as $proyek)
        <h5 class="cursor-default text-sm font-semibold text-[var(--primary)]">
            {{ ucfirst($proyek->nama_proyek) }}
        </h5>
        <h5 class="cursor-default text-sm text-[var(--primary)]">
            Peran: <strong>{{ $proyek->peran }}</strong>
        </h5>
        <hr class="my-1 border border-[var(--stroke)]" />
        <h5 class="cursor-default font-semibold text-sm text-[var(--secondary-text)]">
            Deskripsi
        </h5>
        <h5 class="cursor-default text-sm text-[var(--primary)]">
            {{ $proyek->deskripsi }}
        </h5>
        <h5 class="cursor-default text-sm">
            <i class="fa-solid fa-link mr-3 text-[var(--secondary)]"></i>
            <span class="font-semibold text-[var(--secondary-text)]">Tautan:</span>
            <a href="{{ $proyek->tautan }}" class="ml-2 text-[var(--secondary)] underline">
                {{ $proyek->tautan }}
            </a>
        </h5>
        <span class="cursor-default flex text-sm gap-2">
            <h5 class="font-semibold text-[var(--secondary-text)]">Tanggal Mulai - Selesai:</h5>
            <h5 class="text-[var(--primary)]">
                {{ $mulai }} - {{ $selesai }}
            </h5>
        </span>
        <h5 class="cursor-default font-semibold text-sm text-[var(--secondary-text)]">
            Alat:
        </h5>
        <span class="cursor-default flex flex-wrap gap-3 text-sm text-[var(--primary)]">
            @foreach ($proyek->alat as $alat)
                <h5 class="cursor-pointer border border-[var(--primary)] px-5 py-1.5 rounded-full transition-all duration-300 ease-in-out lg:hover:bg-[var(--primary)] lg:hover:text-white">
                    {{ $alat }}
                </h5>
            @endforeach
        </span>
        <hr class="my-1 border border-[var(--primary)] last:hidden" />
    @endforeach
@endif