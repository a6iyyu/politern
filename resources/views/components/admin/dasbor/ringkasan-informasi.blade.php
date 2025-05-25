<h5 class="cursor-default mt-1 font-semibold text-xl text-[#585858]">
    Selamat Datang, {{ ucfirst($nama) ?? "N/A" }}!
</h5>
<section class="mt-7 w-full overflow-x-auto">
    <div class="flex gap-4 min-w-max">
        <x-info
            background="#ebf2fe"
            color="#2c6cd3"
            icon="fa-solid fa-user-group"
            info="+12% dari tahun lalu"
            title="Total Mahasiswa Magang"
            total="256"
        />
        <x-info
            background="#e7f8f2"
            color="#10b981"
            icon="fa-solid fa-user-graduate"
            info="73% dari total mahasiswa"
            title="Mahasiswa Aktif Magang"
            total="189"
        />
        <x-info
            background="#fef5e6"
            color="#f59e0b"
            icon="fa-solid fa-building"
            info="Bertambah 5 perusahaan bulan ini"
            title="Perusahaan Mitra"
            total="42"
        />
        <x-info
            background="#fdecec"
            color="#ef4545"
            icon="fa-solid fa-briefcase"
            info="18 lowongan baru minggu ini"
            title="Lowongan Tersedia"
            total="68"
        />
    </div>
</section>