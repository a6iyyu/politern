<h5 class="cursor-default mt-1 font-medium text-[#585858]">
    Selamat Datang, {{ ucfirst($nama_pengguna) ?? "N/A" }}!
</h5>
<section class="mt-5 flex flex-wrap gap-3 text-sm tracking-wide">
    <h5 class="text-[#585858] cursor-pointer w-fit px-5 py-2 font-medium rounded-full bg-[#fbecf1] border-2 border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
        Program Studi {{ $jenjang ?? "N/A" }} {{ $nama_prodi ?? "N/A" }}
    </h5>
    <h5 class="text-[#585858] cursor-pointer w-fit px-5 py-2 font-medium rounded-full bg-[#fbecf1] border-2 border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
        IPK {{ $ipk ?? "N/A" }}
    </h5>
    <h5 class="text-[#585858] cursor-pointer w-fit px-5 py-2 font-medium rounded-full bg-[#fbecf1] border-2 border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
        Semester {{ $semester ?? "N/A" }}
    </h5>
</section>
<section class="mt-7 w-full overflow-x-auto">
    <div class="flex gap-4 min-w-max">
        <x-info
            background="#ebf2fe"
            color="#2c6cd3"
            icon="fa-solid fa-user-group"
            info="Disetujui sejak 2 minggu yang lalu"
            title="Status Magang"
            :total="$status ?? 'N/A'"
        />
        <x-info
            background="#e7f8f2"
            color="#10b981"
            icon="fa-solid fa-user-graduate"
            info="Jumlah log minggu ini"
            title="Log Aktivitas"
            total="12"
        />
        <x-info
            background="#fdecec"
            color="#ef4545"
            icon="fa-solid fa-briefcase"
            info="1 diterima"
            title="Pengajuan"
            total="3"
        />
    </div>
</section>