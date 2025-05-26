<a
    href="{{ route('admin.data-dosen.detail', ['id' => $dsn->id_dosen]) }}"
    class="inline-flex items-center rounded px-4 py-2 text-white text-xs font-medium bg-[var(--blue-tertiary)] hover:bg-blue-700 mr-2"
>
    Detail
</a>

<a
    href="{{ route('admin.data-dosen.edit', ['id' => $dsn->id_dosen]) }}"
    class="inline-flex items-center rounded px-4 py-2 text-white text-xs font-medium bg-[var(--yellow-tertiary)] hover:bg-yellow-500 mr-2"
>
    Edit
</a>

<form action="{{ route('admin.data-dosen.destroy', ['id' => $dsn->id_dosen]) }}" method="POST" class="inline-block">
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
