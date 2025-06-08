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
        <x-card-aktivity-dasbor 
            :minggu="$log->minggu ?? 'N/A'"
            :judul="$log->judul"
            :deskripsi="$log->deskripsi"
            :nama="$log->magang->pengajuan_magang->mahasiswa->nama_lengkap ?? 'N/A'"
            :nim="$log->magang->pengajuan_magang->mahasiswa->nim ?? 'N/A'"
        />
    @endforeach

    <p class="text-xs text-[var(--secondary-text)] mt-3">
        Menampilkan {{ count($log_aktivitas) }} dari {{ $total_aktivitas }} aktivitas magang mahasiswa
    </p>
</section>
