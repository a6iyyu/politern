<section class="flex items-center justify-between mb-5 pt-2">
    <h2 class="cursor-default text-base font-semibold text-[var(--primary-text)]">
        Daftar Aktivitas Magang
    </h2>
</section>
@if (session('success'))
    <h5 class="mb-7 p-4 cursor-default rounded-lg bg-emerald-50 border border-emerald-500 list-disc list-inside text-sm text-emerald-500">
        {{ session('success') }}
    </h5>
@elseif ($errors->any())
    <ul class="mb-7 p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@include('components.admin.aktivitas-magang.filter')
@if (!empty($log_aktivitas))
    @foreach ($log_aktivitas as $log)
        <x-card-aktivity 
            :minggu="$log->minggu ?? 'N/A'"
            :judul="$log->judul"
            :status="$log->status"
            :deskripsi="$log->deskripsi"
            :foto="$log->foto"
            :id-log="$log->id_log"
            :komentar="($log->status === 'DITOLAK' || $log->status === 'DISETUJUI') ? ($log->komentar ?? null) : null"
            :nama="$log->magang->pengajuan_magang->mahasiswa->nama_lengkap ?? 'N/A'"
            :nim="$log->magang->pengajuan_magang->mahasiswa->nim ?? 'N/A'"
            :foto-profil="$log->magang->pengajuan_magang->mahasiswa->foto_profil ?? null"
            :tanggal-konfirmasi="$log->tanggal_konfirmasi ? $log->tanggal_konfirmasi->format('d/m/Y') : null"
        />
    @endforeach
@else
    <section class="my-10 cursor-default flex flex-col items-center justify-center text-[var(--secondary-text)]">
        <i class="fa-solid fa-triangle-exclamation text-5xl"></i>
        <h5 class="mt-4">Tidak ada log aktivitas yang tercatat.</h5>
    </section>
@endif