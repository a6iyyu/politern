@php
    use Carbon\Carbon;
@endphp

<section class="flex items-center justify-between py-2">
    <h5 class="cursor-default mt-4 font-medium text-sm">
        {{ $jumlah_lowongan ?? "N/A" }} lowongan
    </h5>
    <fieldset class="flex items-center gap-1 mt-4 text-sm text-slate-700">
        <h5 class="cursor-default">Urut berdasarkan</h5>
        <select
            wire:model="sortir"
            name="sortir"
            id="sortir"
            class="rounded-md py-1 text-slate-700 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--primary)]"
        >
            <option value="relevansi">relevansi</option>
            <option value="terbaru">terbaru</option>
            <option value="terlama">terlama</option>
            <option value="gaji_tertinggi">gaji Tertinggi</option>
            <option value="gaji_terendah">gaji Terendah</option>
        </select>
    </fieldset>
</section>

{{-- TODO: Menambahkan foreach sebagai perulangan dan mengambil data dari DB Lowongan Magang. --}}
<section class="mt-3 max-h-[70vh] overflow-y-auto pr-2">
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <x-card
            :category="$bidang_keahlian ?? 'N/A'"
            :createdAt="Carbon::now() ?? 'N/A'"
            :industry="$perusahaan->nama ?? 'N/A'"
            :location="$lokasi ?? 'N/A'"
            :logo="$perusahaan->logo ?? 'N/A'"
            :maxSalary="$gaji_maksimal ?? 'N/A'"
            :minSalary="$gaji_minimal ?? 'N/A'"
            :name="$judul ?? 'N/A'"
            :status="$status ?? 'N/A'"
            :type="$kategori ?? 'N/A'"
        />
    </div>
</section>