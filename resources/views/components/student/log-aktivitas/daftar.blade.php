<section class="mt-8 flex items-center justify-end">
    <button type="button" data-target="log-mahasiswa" class="open cursor-pointer w-fit text-sm bg-[var(--green-tertiary)] text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out lg:hover:bg-[#66c2a3]">
        Tambah Aktivitas
    </button>
</section>
<section class="mt-6 grid grid-cols-1 gap-4">
    @if (isset($log_aktivitas) || !empty($log_aktivitas))
        @foreach ($log_aktivitas as $log)
            <x-log 
                :comment="($log->status === 'DITOLAK' || $log->status === 'DISETUJUI') ? ($log->komentar ?? null) : null"
                :confirmation_date="$log->tanggal_konfirmasi ? $log->tanggal_konfirmasi->format('d/m/Y') : null"
                :description="$log->deskripsi"
                :id="$log->id_log"
                :name="$log->magang->pengajuan_magang->mahasiswa->nama_lengkap ?? 'N/A'"
                :nim="$log->magang->pengajuan_magang->mahasiswa->nim ?? 'N/A'"
                :photo="$log->foto"
                :profile_photo="$log->magang->pengajuan_magang->mahasiswa->foto_profil ?? null"
                :status="$log->status"
                :title="$log->judul"
                :week="$log->minggu ?? 'N/A'"
            />
        @endforeach
    @endif
</section>