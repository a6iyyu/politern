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
<section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
    @foreach ($lowongan as $item)
        <x-card
            :category="$item->bidang->first()->nama_bidang ?? 'N/A'"
            :createdAt="$item->created_at ?? 'N/A'"
            :industry="$item->perusahaan->nama ?? 'N/A'"
            :location="$item->perusahaan->lokasi->nama_lokasi ?? 'N/A'"
            :logo="asset($item->perusahaan->logo) ?? 'N/A'"
            :name="$item->judul ?? 'N/A'"
            :salary="$item->gaji ?? 'N/A'"
            :status="$item->status ?? 'N/A'"
            :type="$item->jenis_lokasi->nama_jenis_lokasi ?? 'N/A'"
            :url="route('mahasiswa.lowongan.detail', ['id' => $item->perusahaan->id_perusahaan_mitra, 'from' => 'lowongan'])"
        />
    @endforeach
</section>