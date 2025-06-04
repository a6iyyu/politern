<a href="javascript:void(0)" data-id="{{ $prodi->id_prodi }}" class="detail mr-1 rounded px-4 py-2 text-white text-xs font-medium bg-[var(--blue-tertiary)] transition-all duration-300 ease-in-out lg:hover:bg-blue-700">
    Detail
</a>
<a href="javascript:void(0)" data-target="edit-prodi" data-id="{{ $prodi->id_prodi }}" class="open edit mr-1 rounded px-4 py-2 text-white text-xs font-medium bg-[var(--yellow-tertiary)] transition-all duration-300 ease-in-out lg:hover:bg-yellow-500">
    Edit
</a>
<form action="{{ route('admin.data-prodi.hapus', ['id' => $prodi->id_prodi]) }}" method="POST" class="inline-block">
    @csrf
    @method('DELETE')
    <button
        type="submit"
        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
        class="cursor-pointer rounded px-4 py-2 text-white text-xs font-medium bg-[var(--red-tertiary)] transition-all duration-300 ease-in-out lg:hover:bg-red-600"
    >
        Hapus
    </button>
</form>