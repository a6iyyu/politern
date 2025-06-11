<a href="javascript:void(0)" data-id="{{ $lowongan->id_lowongan }}" class="detail mr-1 rounded px-4 py-2 text-white text-xs font-medium bg-[var(--blue-tertiary)] transition-all duration-300 ease-in-out lg:hover:bg-blue-700">
    Detail
</a>
<a href="javascript:void(0)" data-id="{{ $lowongan->id_lowongan }}" class="btn-edit-lowongan mr-1 rounded px-4 py-2 text-white text-xs font-medium bg-[var(--yellow-tertiary)] transition-all duration-300 ease-in-out lg:hover:bg-yellow-500">
    Edit
</a>
<form action="{{ route('admin.lowongan-magang.hapus', ['id' => $lowongan->id_lowongan]) }}" method="POST">
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