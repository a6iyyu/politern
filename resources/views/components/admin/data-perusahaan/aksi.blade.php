<a href="javascript:void(0)" 
   data-id="{{ $perusahaan->id_perusahaan_mitra }}" 
   class="detail rounded px-4 py-2 text-white text-xs font-medium bg-[var(--blue-tertiary)] hover:bg-blue-700 mr-1">
    Detail
</a>
<a href="javascript:void(0)" 
   data-target="edit-perusahaan" data-id="{{ $perusahaan->id_perusahaan_mitra }}" 
   class="open edit rounded px-4 py-2 text-white text-xs font-medium bg-[var(--yellow-tertiary)] hover:bg-yellow-500 mr-1">
    Edit
</a>
<form action="{{ route('admin.data-perusahaan.hapus', ['id' => $perusahaan->id_perusahaan_mitra]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button
        type="submit"
        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
        class="cursor-pointer rounded px-4 py-2 text-white text-xs font-medium bg-[var(--red-tertiary)] transition-all duration-300 ease-in-out lg:hover:bg-red-600"
    >
        Hapus
</form>