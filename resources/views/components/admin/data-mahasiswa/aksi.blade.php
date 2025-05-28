<a
    href="{{ route('admin.data-mahasiswa.detail', ['id' => $mhs->id_mahasiswa]) }}"
    class="inline-flex items-center rounded px-4 py-2 text-white text-xs font-medium bg-[var(--blue-tertiary)] hover:bg-blue-700 mr-2"
>
    Detail
</a>
<form action="{{ route('admin.data-mahasiswa.hapus', ['id' => $mhs->id_mahasiswa]) }}" method="POST" class="inline-block">
    @csrf
    @method('DELETE')
    <button
        type="submit"
        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
        class="inline-flex items-center rounded px-4 py-2 text-white text-xs font-medium bg-[var(--red-tertiary)] hover:bg-red-600"
    >
        Hapus
    </button>
</form>