<figure class="border border-[var(--stroke)] rounded-lg shadow-lg p-6 bg-white">
    <div class="flex flex-col gap-4 justify-between items-center mb-4 lg:flex-row">
        <h5 class="cursor-default font-semibold text-sm text-[#2d2d2d]">
            <i class="fa-solid fa-clock-rotate-left mr-2"></i> Kategori Pengajuan Bidang Magang Terbanyak
        </h5>
        <a href="{{ route('admin.pengajuan-magang') }}" class="open w-fit text-xs bg-[var(--primary)] text-white font-medium px-5 py-3 rounded cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            Lihat Semua
        </a>
    </div>
    <hr class="my-3 border border-[#cecece]" />
    <figcaption class="mt-8 w-full flex items-center gap-6 md:flex-col xl:flex-row">
        <div class="relative w-full max-w-xs h-[250px]">
            <canvas id="kategori-bidang-magang-terbanyak" class="absolute top-0 left-0 w-full h-full"></canvas>
        </div>
        <legend id="keterangan-kategori-bidang-magang-terbanyak" class="w-full flex flex-col gap-2 text-sm pr-8"></legend>
    </figcaption>
</figure>