<section class="flex items-center justify-between mb-5 pt-2">
    <h2 class="cursor-default text-base font-semibold text-[var(--primary-text)]">
        Daftar Aktivitas Magang Mahasiswa Bimbingan
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
@include('components.lecturer.log-aktivitas.filter')
@if (!empty($log_aktivitas))
    @foreach ($log_aktivitas as $log)
        <x-log
            confirmation_date="{{ $log->tanggal_konfirmasi?->format('d/m/Y') }}"
            profile_photo="{{ asset($log->magang->pengajuan_magang->mahasiswa->foto_profil ?? 'images/default-avatar.png') }}"
            :comment="($log->status === 'DITOLAK' || $log->status === 'DISETUJUI') ? ($log->komentar ?? null) : null"
            :description="$log->deskripsi"
            :id="$log->id_log"
            :name="$log->magang->pengajuan_magang->mahasiswa->nama_lengkap ?? 'N/A'"
            :nim="$log->magang->pengajuan_magang->mahasiswa->nim ?? 'N/A'"
            :photo="$log->foto"
            :status="$log->status"
            :title="$log->judul"
            :week="$log->minggu ?? 'N/A'"
            context="dosen"
        />
    @endforeach
@else
    <section class="my-10 cursor-default flex flex-col items-center justify-center text-[var(--secondary-text)]">
        <i class="fa-solid fa-triangle-exclamation text-5xl"></i>
        <h5 class="mt-4">Tidak ada log aktivitas yang tercatat.</h5>
    </section>
@endif