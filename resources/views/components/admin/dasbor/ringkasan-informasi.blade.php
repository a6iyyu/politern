<h5 class="cursor-default mt-1 font-semibold text-xl text-[#585858]">
    Selamat Datang, {{ ucfirst($nama) ?? "N/A" }}!
</h5>
<section class="mt-7 w-full overflow-x-auto">
    <div class="flex gap-4 min-w-max">
        <x-info
            background="#ebf2fe"
            color="#2c6cd3"
            icon="fa-solid fa-user-graduate"
            info="total semua mahasiswa"
            title="Total Mahasiswa"
            total="{{ $total_mahasiswa }}"
        />
        <x-info
            background="#e7f8f2"
            color="#10b981"
            icon="fa-solid fa-user-group"
            info="total semua dosen"
            title="Total Dosen"
            total="{{ $total_dosen }}"
        />
        <x-info
            background="#fef5e6"
            color="#f59e0b"
            icon="fa-solid fa-building"
            info="total semua perusahaan mitra"
            title="Perusahaan Mitra"
            total="{{ $total_perusahaan_mitra }}"
        />
        <x-info
            background="#fdecec"
            color="#ef4545"
            icon="fa-solid fa-briefcase"
            info="total semua lowongan magang"
            title="Lowongan Tersedia"
            total="{{ $total_lowongan }}"
        />
    </div>
</section>