@php
    use Carbon\Carbon;
@endphp

@if (isset($pengalaman) && $pengalaman->id_pengalaman > 0)
    @foreach ($mahasiswa->pengalaman()->get() as $pengalaman)
        @php
            $mulai = Carbon::parse($pengalaman->tanggal_mulai)->translatedFormat('d F Y');
            $selesai = Carbon::parse($pengalaman->tanggal_selesai)->translatedFormat('d F Y');
        @endphp
        <div class="flex flex-col gap-2 justify-between md:items-center md:flex-row">
            <h5 class="cursor-default font-semibold text-[var(--primary)]">
                {{ ucfirst($pengalaman->jenis_pengalaman) }}
            </h5>
            <span class="flex gap-3">
                <button data-id="{{ $pengalaman->id_pengalaman }}" class="edit cursor-pointer w-fit text-xs bg-[var(--yellow-tertiary)] text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out lg:hover:bg-[var(--yellow-tertiary)]/80">
                    Edit
                </button>
                <form action="{{ route('mahasiswa.profil.pengalaman.hapus', ['id' => $pengalaman->id_pengalaman]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                        class="delete cursor-pointer w-fit text-xs bg-red-500 text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out hover:bg-red-600"
                    >
                        Hapus
                    </button>
                </form>
            </span>
        </div>
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
                <a href="{{ asset("storage/{$pengalaman->bukti_pendukung}") }}" target="_blank" class="underline transition-all duration-300 ease-in-out text-[var(--primary)] lg:hover:text-[var(--primary)]/50">
                    Lihat Bukti
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