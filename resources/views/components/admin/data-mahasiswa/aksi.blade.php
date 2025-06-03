<a href="javascript:void(0)" data-id="{{ $mhs->id_mahasiswa }}" class="detail rounded px-4 py-2 text-white text-xs font-medium bg-[var(--blue-tertiary)] transition-all duration-300 ease-in-out hover:bg-blue-700 mr-1">
    Detail
</a>
<a href="javascript:void(0)" data-target="edit-mahasiswa" data-id="{{ $mhs->id_mahasiswa }}" class="open edit rounded px-4 py-2 text-white text-xs font-medium bg-[var(--yellow-tertiary)] transition-all duration-300 ease-in-out hover:bg-yellow-500 mr-1">
    Edit
</a>
<form action="{{ route('admin.data-mahasiswa.hapus', ['id' => $mhs->id_mahasiswa]) }}" method="POST" class="inline-block">
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