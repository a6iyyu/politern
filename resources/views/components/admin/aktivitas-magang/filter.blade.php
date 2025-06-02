<div class="mb-7 ">
@if (isset($perusahaan) || !empty($perusahaan))
    <form action="" class="mb-7 grid grid-cols-1 gap-4 lg:grid-cols-4" method="GET" enctype="multipart/form-data">
        @csrf
        @method('GET')
        <x-input
            icon="fa-solid fa-magnifying-glass"
            label="Cari Mahasiswa"
            name="nama_lengkap"
            placeholder="Cari Mahasiswa"
            type="text" :required="false"
        />
        <x-select
            label="Perusahaan"
            name="perusahaan"
            placeholder="-- Semua Perusahaan --"
            :options="$perusahaan"
            :selected="request('perusahaan', '')"
            :required="false"
        />
        <x-select
            label="Status"
            name="status"
            placeholder="-- Semua Status --"
            :options="$status_aktivitas"
            :selected="request('status', '')"
            :required="false"
        />
        <section class="flex items-end lg:justify-end">
            <button type="submit"
                class="cursor-pointer bg-[var(--secondary)] text-white px-7 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:w-3/4 lg:py-2.5 lg:hover:bg-[#ff86cb]">
                Cari
            </button>
        </section>
    </form>
@endif
@if (isset($periode_magang) || !empty($periode_magang))
    <div class="w-max">
        <x-select
            label="Periode Magang"
            name="periode_magang"
            placeholder="-- Pilih Periode Magang --"
            :options="$periode_magang"
            :selected="request('periode_magang', '')"
            :required="false"
        />
    </div>
@endif
</div>
