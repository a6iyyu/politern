<div class="flex flex-col gap-4 items-start justify-between mb-6 lg:flex-row">
    <h3 class="cursor-default text-[var(--primary-text)] font-medium text-base flex items-center gap-2">
        <i class="fa-regular fa-clock"></i> Aktivitas Mahasiswa Terbaru
    </h3>
    <a href="{{ route('dosen.log-aktivitas') }}" class="open w-fit text-xs bg-[var(--primary)] text-white font-medium px-5 py-3 rounded cursor-pointer hover:bg-[var(--primary)]/90 transition-colors">
        Lihat Semua
    </a>
</div>
@if (isset($log_aktivitas) || !empty($log_aktivitas))
    @foreach ($log_aktivitas as $log)
        <x-log
            :comment="($log->status === 'DITOLAK' || $log->status === 'DISETUJUI') ? ($log->komentar ?? null) : null"
            :confirmation_date="$log->tanggal_konfirmasi ? $log->tanggal_konfirmasi->format('d/m/Y') : null"
            :description="$log->deskripsi ?? 'N/A'"
            :id="$log->id_log ?? 'N/A'"
            :name="$log->magang->pengajuan_magang->mahasiswa->nama_lengkap ?? 'N/A'"
            :nim="$log->magang->pengajuan_magang->mahasiswa->nim ?? 'N/A'"
            :photo="$log->foto ?? 'Tidak ada foto yang tersedia.'"
            :profile_photo="$log->magang->pengajuan_magang->mahasiswa->foto_profil ?? null"
            :status="$log->status ?? 'N/A'"
            :title="$log->judul ?? 'N/A'"
            :week="$log->minggu ?? 'N/A'"
        />
    @endforeach
    <h5 class="text-xs text-[var(--secondary-text)] mt-3">
        Menampilkan {{ count($log_aktivitas) }} dari {{ $total_aktivitas }} aktivitas magang mahasiswa
    </h5>
@else
    <div class="mt-12 flex flex-col items-center justify-center h-full">
        <i class="fa-solid fa-triangle-exclamation text-5xl text-center text-[var(--primary)]"></i>
        <h5 class="text-xs text-[var(--secondary-text)] mt-3">
            Tidak ada aktivitas magang mahasiswa
        </h5>
    </div>
@endif