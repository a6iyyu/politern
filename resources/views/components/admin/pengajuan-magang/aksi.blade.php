@include('components.admin.pengajuan-magang.konfirmasi')
<a href="javascript:void(0)" data-id="{{ $pengajuan->id_pengajuan_magang }}" class="detail cursor-pointer mr-1 rounded px-4 py-2 text-white text-xs font-medium transition-all duration-300 ease-in-out bg-[var(--blue-tertiary)] lg:hover:bg-blue-700">
    Detail
</a>
<a href="javascript:void(0)" data-id="{{ $pengajuan->id_pengajuan_magang }}" class="edit cursor-pointer mr-1 rounded px-4 py-2 text-white text-xs font-medium transition-all duration-300 ease-in-out bg-[var(--yellow-tertiary)] lg:hover:bg-yellow-500">
    Edit
</a>