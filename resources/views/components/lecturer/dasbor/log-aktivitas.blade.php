<section class="border border-[var(--stroke)] rounded-xl p-7 bg-white flex-2">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-[var(--primary-text)] font-medium text-base flex items-center gap-2">
            <i class="fa-regular fa-clock"></i> Aktivitas Mahasiswa Terbaru
        </h3>
        <a href="{{ route('dosen.log-aktivitas') }}" class="open text-xs bg-[var(--primary)] text-white font-medium px-5 py-3 rounded cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
            Lihat Semua
        </a>
    </div>
    @foreach ($log_aktivitas as $log)
        <article class="border border-[var(--stroke)] px-6 py-4 rounded-lg mb-4">
            <section class="flex items-center justify-between text-sm">
                <div class="flex gap-4 items-center">
                    <h5 class="text-[var(--primary)] font-semibold">
                        Minggu ke-{{ $log->minggu ?? 'N/A' }}
                    </h5>
                    <h5 class="bg-[var(--primary)] text-white text-xs px-4 py-1 rounded-full">
                        {{ $log->judul ?? 'N/A' }}
                    </h5>
                </div>
                <a href="#" class="text-xs px-4 py-2 border border-[var(--blue-tertiary)] text-[var(--blue-tertiary)] rounded-lg hover:bg-[var(--blue-tertiary)] hover:text-white transition">
                    Lihat Aktivitas
                </a>
            </section>
            <section class="mt-4 text-sm">
                <div class="flex items-center gap-3 mb-2">
                    <h5 class="text-[var(--primary-text)] font-medium">{{ $log->nama ?? 'N/A' }}</h5>
                    <h6 class="text-[var(--secondary-text)]">{{ $log->nim ?? 'N/A' }}</h6>
                </div>
                <div class="flex gap-2">
                    <h5 class="text-[var(--secondary-text)]">Deskripsi:</h5>
                    <p class="text-[var(--primary-text)] leading-relaxed font-medium max-w-[600px]">
                        {{ $deskripsi ?? 'N/A' }}
                    </p>
                </div>
            </section>
        </article>
    @endforeach
    <p class="text-xs text-[var(--secondary-text)] mt-3">
        Menampilkan {{ count($log_aktivitas) }} dari {{ $total_aktivitas }} aktivitas magang mahasiswa
    </p>
</section>