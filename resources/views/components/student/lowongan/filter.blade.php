<section class="overflow-x-auto">
    <div class="min-w-[900px] grid grid-cols-3 gap-4 px-7 pt-7 pb-4 bg-white border border-slate-200 border-b-0 rounded-t-xl">
        <x-input
            icon="fa-solid fa-magnifying-glass"
            name="nama"
            placeholder="Cari Nama Pekerjaan"
            type="search"
            :required="false"
        />
        <x-input
            icon="fa-solid fa-location-dot"
            name="lokasi"
            placeholder="Lokasi"
            type="search"
            :required="false"
        />
        <x-input
            icon="fa-solid fa-building"
            name="perusahaan"
            placeholder="Perusahaan"
            type="search"
            :required="false"
        />
    </div>
</section>
<section class="overflow-x-auto">
    <div class="min-w-[900px] grid grid-cols-5 gap-4 px-7 pb-7 bg-white border border-slate-200 border-t-0 rounded-b-xl">
        <x-input
            icon="fa-solid fa-money-bill-wave"
            name="gaji_min"
            placeholder="Gaji Minimal"
            type="number"
            :required="false"
        />
        <x-input
            icon="fa-solid fa-money-check-dollar"
            name="gaji_max"
            placeholder="Gaji Maksimal"
            type="number"
            :required="false"
        />
        <x-select
            label="Status"
            name="status"
            placeholder="-- Semua Status --"
            :options="['REMOTE' => 'Remote', 'ONSITE' => 'Onsite', 'HYBRID' => 'Hybrid']"
            :selected="request('status', '')"
            :required="false"
        />
        <x-select
            label="Waktu Posting"
            name="waktu"
            placeholder="-- Semua Waktu Posting --"
            :options="['1' => '1 hari terakhir', '3' => '3 hari terakhir', '7' => '7 hari terakhir', '30' => '30 hari terakhir']"
            :selected="request('waktu', '')"
            :required="false"
        />
        <span class="flex items-end justify-end">
            <button type="submit" class="w-3/4 bg-[#e86bb1] text-white rounded-lg py-2.5 text-sm hover:bg-opacity-90 transition">
                Cari
            </button>
        </span>
    </div>
</section>