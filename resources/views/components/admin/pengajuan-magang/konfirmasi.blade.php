@if ($pengajuan->status === 'MENUNGGU')
    <a href="javascript:void(0)" data-id="{{ $pengajuan->id_pengajuan_magang }}" class="konfirmasi cursor-pointer rounded px-5 py-2 text-[var(--primary)] text-xs font-semibold transition-all duration-300 ease-in-out border border-[var(--primary)] hover:bg-[var(--primary)] hover:text-white">
        Konfirmasi
    </a>
@endif