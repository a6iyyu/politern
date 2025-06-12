@if (isset($pengajuan) && !empty($pengajuan))
    <a
        href="javascript:void(0)"
        data-id="{{ $pengajuan->id_pengajuan_magang }}"
        class="detail flex items-center gap-2 bg-[var(--primary)] text-white px-5 py-2.5 rounded-md text-xs transition-all duration-300 ease-in-out lg:hover:bg-[var(--primary)]/90"
    >
        <i class="fa-solid fa-pen-to-square"></i>
        <h5>Detail</h5>
    </a>
@endif