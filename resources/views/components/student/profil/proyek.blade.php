@php
    use Carbon\Carbon;
@endphp

@if (isset($proyek) && $proyek->id_proyek > 0)
    @foreach ($mahasiswa->proyek()->get() as $proyek)
        @php
            $mulai = Carbon::parse($proyek->tanggal_mulai)->translatedFormat('d F Y');
            $selesai = Carbon::parse($proyek->tanggal_selesai)->translatedFormat('d F Y');
        @endphp
        <div class="flex flex-col gap-2 justify-between md:items-center md:flex-row">
            <h5 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                {{ ucfirst($proyek->nama_proyek) }}
            </h5>
            <span class="flex gap-3">
                <button data-id="{{ $proyek->id_proyek }}" class="edit-project cursor-pointer w-fit text-xs bg-[var(--yellow-tertiary)] text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out lg:hover:bg-[var(--yellow-tertiary)]/80">
                    Edit
                </button>
                <form action="{{ route('mahasiswa.profil.proyek.hapus', ['id' => $proyek->id_proyek]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="delete cursor-pointer w-fit text-xs bg-red-500 text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out hover:bg-red-600"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                    >
                        Hapus
                    </button>
                </form>
            </span>
        </div>
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
            @foreach ($proyek->alat as $id_keahlian)
                <h5 class="cursor-pointer border border-[var(--primary)] px-5 py-1.5 rounded-full transition-all duration-300 ease-in-out lg:hover:bg-[var(--primary)] lg:hover:text-white">
                    {{ $keahlian[$id_keahlian] ?? $id_keahlian }}
                </h5>
            @endforeach
        </span>
        <hr class="my-1 border border-[var(--primary)] last:hidden" />
    @endforeach
@else
    <i class="fa-solid fa-triangle-exclamation mt-12 text-5xl text-center text-[var(--primary)]"></i>
    <h5 class="mb-12 cursor-default text-center text-[var(--primary)]">
        Tidak ada pengalaman yang tercatat.
    </h5>
@endif