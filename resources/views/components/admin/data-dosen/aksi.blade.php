<a href="javascript:void(0)" data-id="{{ $dosen->id_dosen }}" class="detail rounded px-4 py-2 text-white text-xs font-medium bg-[var(--blue-tertiary)] hover:bg-blue-700 mr-1">
    Detail
</a>
<a href="javascript:void(0)" data-target="edit-dosen" data-id="{{ $dosen->id_dosen }}" class="open edit rounded px-4 py-2 text-white text-xs font-medium bg-[var(--yellow-tertiary)] hover:bg-yellow-500 mr-1">
    Edit
</a>
<form action="{{ route('admin.data-dosen.hapus', ['id' => $dosen->id_dosen]) }}" method="POST" class="inline-block">
    @csrf
    @method('DELETE')
    <button
        type="submit"
        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
        class="cursor-pointer rounded px-4 py-2 text-white text-xs font-medium bg-[var(--red-tertiary)] hover:bg-red-600"
    >
        Hapus
</form>