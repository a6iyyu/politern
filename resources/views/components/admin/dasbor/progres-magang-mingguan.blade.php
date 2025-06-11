<figure class="border border-[var(--stroke)] rounded-lg shadow-lg p-6 bg-white">
    <h5 class="cursor-default font-semibold text-sm text-[#2d2d2d]">
        <i class="fa-solid fa-clock-rotate-left mr-2"></i> Progres Magang Mingguan
    </h5>
    <hr class="my-3 border border-[#cecece]" />
    <figcaption class="relative h-[250px] my-4 w-full flex flex-col items-center gap-6 xl:flex-col xl:flex-row">
        <canvas id="progres-magang-mingguan"></canvas>
    </figcaption>
    <x-table
        :headers="['No', 'Nama Mahasiswa', 'Aksi']"
        :sortable="['Nama Mahasiswa']"
        :rows="$log_aktivitas"
    />
</figure>