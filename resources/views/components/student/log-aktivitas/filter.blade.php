<section class="flex items-center gap-4">
    <i class="fa-solid fa-clock text-[var(--secondary-text)]"></i>
    <h5 class="cursor-default font-semibold text-sm text-[var(--secondary-text)] lg:text-base">
        Cari Log Aktivitas
    </h5>
</section>
<section class="mt-4 grid grid-cols-1 gap-4 lg:grid-cols-3">
    <fieldset class="relative">
        <label for="nama_lengkap" class="sr-only">Pilih Nama Mahasiswa</label>
        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <select name="nama_lengkap" id="nama_lengkap" class="appearance-none w-full text-sm border border-[var(--stroke)] text-[var(--secondary-text)] rounded-md px-12 py-3">
            <option value="">Semua Mahasiswa</option>
            @if (!empty($mahasiswa))
                @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs->id_mahasiswa }}">{{ $mhs->nama_lengkap }}</option>
                @endforeach
            @else
                <option value="">Tidak ada data</option>
            @endif
        </select>
        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 text-xs -translate-y-1/2 text-slate-400"></i>
    </fieldset>
    <fieldset class="relative">
        <label for="nama_perusahaan" class="sr-only">Pilih Perusahaan</label>
        <i class="fa-solid fa-building absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <select name="nama_perusahaan" id="nama_perusahaan" class="appearance-none w-full text-sm border border-[var(--stroke)] text-[var(--secondary-text)] rounded-md px-12 py-3">
            <option value="">Pilih Perusahaan</option>
            @if (!empty($mahasiswa))
                @foreach ($mahasiswa as $mhs)
                    <option value="{{ $mhs->id_mahasiswa }}">{{ $mhs->nama_lengkap }}</option>
                @endforeach
            @else
                <option value="">Tidak ada data</option>
            @endif
        </select>
        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 text-xs -translate-y-1/2 text-slate-400"></i>
    </fieldset>
    <fieldset class="relative">
        <label for="pilih_status" class="sr-only">Status</label>
        <i class="fa-solid fa-clock absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <select name="pilih_status" id="pilih_status" class="appearance-none w-full text-sm border border-[var(--stroke)] text-[var(--secondary-text)] rounded-md px-12 py-3">
            <option value="">Status</option>
            <option value="">Dikonfirmasi</option>
            <option value="">Ditolak</option>
            <option value="">Menunggu</option>
        </select>
        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 text-xs -translate-y-1/2 text-slate-400"></i>
    </fieldset>
</section>