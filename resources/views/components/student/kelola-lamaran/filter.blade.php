<form action="{{ route('mahasiswa.kelola-lamaran') }}" method="GET" class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-5">
    <x-select
        label="Status Lamaran"
        name="waktu"
        placeholder="-- Semua Status --"
        :options="['MENUNGGU' => 'Menunggu', 'DISETUJUI' => 'Disetujui', 'DITOLAK' => 'Ditolak']"
        :selected="request('waktu', '')"
        :required="false"
    />
    <x-select
        label="Periode Magang"
        name="periode"
        placeholder="-- Semua Periode --"
        :options="$periode_magang"
        :selected="request('periode', '')"
        :required="false"
    />
    <x-select
        label="Bidang"
        name="bidang"
        :options="['' => 'Semua Bidang'] + $bidang->toArray()"
        :selected="request('bidang')"
        :required="false"
    />
    <x-select
        label="Perusahaan"
        name="perusahaan"
        :options="['' => 'Semua Perusahaan'] + $perusahaan->toArray()"
        :selected="request('perusahaan', '')"
        :required="false"
    />
    <div class="flex items-end">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb] w-full sm:w-auto">
            Cari
        </button>
    </div>
</form>