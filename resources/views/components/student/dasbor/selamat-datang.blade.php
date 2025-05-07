<h5 class="cursor-default mt-1 font-medium text-[#585858]">
    Selamat Datang, {{ ucfirst($nama_pengguna) }}!
</h5>
<section class="mt-5 flex flex-wrap gap-3 text-sm tracking-wide">
    <h5 class="text-[#585858] cursor-pointer w-fit px-5 py-2 font-medium rounded-full shadow-lg bg-[#fbecf1] border-2 border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
        Program Studi {{ $jenjang }} {{ $nama_prodi }}
    </h5>
    <h5 class="text-[#585858] cursor-pointer w-fit px-5 py-2 font-medium rounded-full shadow-lg bg-[#fbecf1] border-2 border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
        IPK {{ $ipk }}
    </h5>
    <h5 class="text-[#585858] cursor-pointer w-fit px-5 py-2 font-medium rounded-full shadow-lg bg-[#fbecf1] border-2 border-[#f9d4e2] transition-all duration-300 ease-in-out lg:hover:bg-[#f9d4e2]">
        Semester {{ $semester }}
    </h5>
</section>