<a href="javascript:void(0)" data-id="{{ $pengajuan->id_pengajuan_magang }}" class="detail inline-flex items-center rounded px-4 py-2 text-white text-xs font-medium bg-[var(--blue-tertiary)] transition-all duration-300 ease-in-out hover:bg-blue-700 mr-1">
    Detail
</a>
<a href="javascript:void(0)" data-id="{{ $pengajuan->id_pengajuan_magang }}" class="edit inline-flex items-center rounded px-4 py-2 text-white text-xs font-medium bg-[var(--yellow-tertiary)] transition-all duration-300 ease-in-out hover:bg-yellow-500 mr-1">
    Edit
</a>
<form action="{{ route('admin.pengajuan-magang.hapus', ['id' => $pengajuan->id_pengajuan_magang]) }}" method="POST" class="inline-block">
    @csrf
    @method('DELETE')
    <button
        type="submit"
        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
        class="cursor-pointer inline-flex items-center rounded px-4 py-2 text-white text-xs font-medium bg-[var(--red-tertiary)] transition-all duration-300 ease-in-out hover:bg-red-600"
    >
        Hapus
</form>