<form action="{{ route('mahasiswa.lowongan') }}" method="GET" class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-6">
    <x-select
        label="Bidang"
        name="bidang"
        :options="['' => 'Semua Bidang'] + ($bidang->pluck('nama_bidang', 'id_bidang')->toArray() ?? [])"
        :selected="request('bidang')"
        :required="false"
    />
    <x-select
        label="Perusahaan"
        name="perusahaan"
        :options="['' => 'Semua Perusahaan'] + ($perusahaan->pluck('nama', 'id_perusahaan_mitra')->toArray() ?? 'Tidak ada data.')"
        :selected="request('perusahaan', '')"
        :required="false"
    />
    <x-select
        label="Tipe Gaji"
        name="tipe_gaji"
        :options="[
            '' => 'Semua Gaji',
            'paid' => 'PAID',
            'unpaid' => 'UNPAID'
        ]"
        :selected="request('tipe_gaji', '')"
        :required="false"
    />
    <div class="flex items-end">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb] w-full sm:w-auto">
            Cari
        </button>
    </div>
</form>
@if (isset($periode_magang) && !empty($periode_magang))
    <div class="flex justify-between items-center mb-6">
        <div class="cursor-default flex items-center gap-2">
            <h5 class="text-sm text-[var(--secondary-text)]">Periode Aktif:</h5>
            <h5 class="px-4 py-2 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                {{ $periode_magang->nama_periode }}
            </h5>
        </div>
        <h5 class="text-sm text-[var(--secondary-text)]">
            Menampilkan {{ $jumlah_lowongan ?? "N/A" }} lowongan
        </h5>
    </div>
@endif