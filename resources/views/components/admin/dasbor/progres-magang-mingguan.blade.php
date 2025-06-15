<figure class="border border-[var(--stroke)] rounded-lg shadow-lg p-6 bg-white">
    <div class="flex flex-col gap-4 justify-between items-center mb-4 lg:flex-row">
        <h5 class="cursor-default font-semibold text-sm text-[#2d2d2d]">
            <i class="fa-solid fa-clock-rotate-left mr-2"></i> Progres Magang Mingguan
        </h5>
        <a href="{{ route('admin.aktivitas-magang') }}" class="open w-fit text-xs bg-[var(--primary)] text-white font-medium px-5 py-3 rounded cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            Lihat Semua
        </a>
    </div>
    <hr class="my-3 border border-[#cecece]" />
    <figcaption class="relative h-[250px] my-4 w-full flex flex-col items-center gap-6 xl:flex-row">
        <canvas id="progres-magang-mingguan"></canvas>
    </figcaption>
    <div class="flex flex-col gap-4 justify-between items-center mt-4 pt-4 border-t border-[#cecece] md:flex-row">
        <div class="flex items-center gap-2">
            <i class="fa-regular fa-calendar-check text-[var(--primary)]"></i>
            <span class="text-sm text-[var(--primary-text)]">
                @if(isset($periodeAktif) && $periodeAktif)
                    Periode {{ $periodeAktif->nama_periode }}
                @else
                    Tidak ada periode aktif
                @endif
            </span>
        </div>
        <a href="{{ route('admin.aktivitas-magang') }}" class="open w-fit text-sm text-[var(--primary-text)]">
            Total Log Aktivitas: {{ $total_aktivitas ?? 0 }}
        </a>
    </div>
</figure>