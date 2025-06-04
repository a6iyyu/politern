TODO: Membuat komponen ini menjadi dinamis menggunakan foreach.

<section class="mt-6 flex flex-col justify-between lg:items-center lg:flex-row">
    <h5 class="cursor-default mt-4 font-medium text-sm text-[var(--secondary-text)]">
        {{ $mitra ?? "N/A" }} Perusahaan Mitra Ditemukan
    </h5>
    <fieldset class="flex items-center gap-1 mt-4 text-sm text-[var(--secondary-text)]">
        <h5 class="cursor-default">Urut berdasarkan</h5>
        <select name="sortir" id="sortir" class="rounded-md py-1 text-slate-700 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]">
            <option value="relevansi">relevansi</option>
            <option value="terbaru">terbaru</option>
            <option value="terlama">terlama</option>
            <option value="gaji_tertinggi">gaji tertinggi</option>
            <option value="gaji_terendah">gaji terendah</option>
        </select>
    </fieldset>
</section>
<section class="mt-6 flex flex-col gap-4 overflow-x-auto">
    <figure class="min-w-[800px] flex-shrink-0 flex items-center justify-between border border-[var(--primary)] gap-10 rounded-xl px-10 py-6">
        <section class="flex flex-1 items-center justify-between">
            <div class="cursor-default flex flex-col">
                <figcaption class="flex items-center gap-2">
                    <h5 class="cursor-default font-semibold text-[var(--primary)] text-sm">
                        {{ $id->nama ?? "Politeknik Negeri Malang" }}
                    </h5>
                    <h5 class="cursor-default text-sm text-[var(--secondary-text)]">
                        {{ $id->lokasi->nama ?? "Jl. Raya Malang No. 1" }}
                    </h5>
                </figcaption>
                <span class="mt-4 flex items-center gap-10">
                    <h5 class="flex items-center text-sm text-[var(--secondary-text)]">
                        <i class="fa-solid fa-building mr-4"></i>
                        <p>{{ $id->nib ?? "1234567890" }}</p>
                    </h5>
                    <h5 class="flex items-center text-sm text-[var(--secondary-text)]">
                        <i class="fa-solid fa-phone mr-4"></i>
                        <p>{{ $id->nomor_telepon ?? "1234567890" }}</p>
                    </h5>
                </span>
            </div>
            <div class="cursor-default flex items-center justify-end">
                <h5 class="text-sm text-white px-6 py-2 rounded-lg @if ("AKTIF") bg-[var(--green-tertiary)] @endif @if ("TIDAK AKTIF") bg-[var(--red-tertiary)] @endif">
                    {{ $id->status ?? "N/A" }}
                </h5>
            </div>
        </section>
        <section class="flex items-center justify-between gap-7">
            <a href="{{ route('admin.data-perusahaan.detail', ['id' => $id->id_perusahaan_mitra]) }}" class="fa-solid fa-eye text-lg text-[var(--primary-text)]"></a>
            <a href="{{ route('admin.data-perusahaan.edit', ['id' => $id->id_perusahaan_mitra]) }}" class="fa-solid fa-pencil text-[var(--primary-text)]"></a>
            <a href="{{ route('admin.data-perusahaan.hapus', ['id' => $id->id_perusahaan_mitra]) }}" class="fa-solid fa-trash text-[var(--primary-text)]"></a>
        </section>
    </figure>
</section>