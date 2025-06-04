<a href="javascript:void(0)" data-id="{{ $perusahaan->id_perusahaan_mitra }}" class="detail mr-1 cursor-pointer rounded px-4 py-2 text-white text-xs font-medium transition-all duration-300 ease-in-out bg-[var(--blue-tertiary)] lg:hover:bg-blue-700">
    Detail
</a>
<a href="javascript:void(0)" data-target="edit-perusahaan" data-id="{{ $perusahaan->id_perusahaan_mitra }}" class="open edit mr-1 cursor-pointer rounded px-4 py-2 text-white text-xs font-medium transition-all duration-300 ease-in-out bg-[var(--yellow-tertiary)] lg:hover:bg-yellow-500">
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