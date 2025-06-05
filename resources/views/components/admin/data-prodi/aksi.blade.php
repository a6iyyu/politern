<a href="javascript:void(0)" data-id="{{ $prodi->id_prodi }}" class="detail cursor-pointer rounded px-4 py-2 text-white text-xs font-medium transition-all duration-300 ease-in-out bg-[var(--blue-tertiary)] hover:bg-blue-700 mr-1">
    Detail
</a>
<a href="javascript:void(0)" data-target="edit-prodi" data-id="{{ $prodi->id_prodi }}" class="open edit cursor-pointer rounded px-4 py-2 text-white text-xs font-medium transition-all duration-300 ease-in-out bg-[var(--yellow-tertiary)] hover:bg-yellow-500 mr-1">
    Edit
</a>
<form action="{{ route('admin.data-prodi.hapus', ['id' => $prodi->id_prodi]) }}" method="POST" class="inline-block">
    @csrf
    @method('DELETE')
    <button
        type="submit"
        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
        class="cursor-pointer rounded px-4 py-2 text-white text-xs font-medium bg-[var(--red-tertiary)] transition-all duration-300 ease-in-out hover:bg-red-600"
    >
        Hapus
    </button>
</form>