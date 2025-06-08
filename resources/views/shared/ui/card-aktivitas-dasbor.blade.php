<article class="border border-[var(--stroke)] px-6 py-4 rounded-lg mb-4">
    <section class="flex items-center justify-between text-sm">
        <div class="flex gap-4 items-center">
            <h5 class="text-[var(--primary)] font-semibold">Minggu ke-{{ $minggu ?? 'N/A' }}</h5>
            <span class="bg-[var(--primary)] text-white text-xs px-4 py-1 rounded-full">{{ $judul ?? 'N/A' }}</span>
        </div>
        <a href="#" class="text-xs px-4 py-2 border border-[var(--blue-tertiary)] text-[var(--blue-tertiary)] rounded-lg hover:bg-[var(--blue-tertiary)] hover:text-white transition">
            Lihat Aktivitas
        </a>
    </section>

    <section class="mt-4 text-sm">
        <div class="flex items-center gap-3 mb-2">
            <h5 class="text-[var(--primary-text)] font-medium">{{ $nama ?? 'N/A' }}</h5>
            <h6 class="text-[var(--secondary-text)]">{{ $nim ?? 'N/A' }}</h6>
        </div>
        <div class="flex gap-2">
            <h5 class="text-[var(--secondary-text)]">Deskripsi:</h5>
            <p class="text-[var(--primary-text)] leading-relaxed font-medium max-w-[600px]">
                {{ $deskripsi ?? 'N/A' }}
            </p>
        </div>
    </section>
</article>
