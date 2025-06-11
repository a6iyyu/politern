<a href="javascript:void(0)" data-id="{{ $periode->id_periode }}" class="detail rounded px-4 py-2 text-white text-xs font-medium bg-[var(--blue-tertiary)] transition-all duration-300 ease-in-out lg:hover:bg-blue-700 mr-2">
    Detail
</a>
<a href="javascript:void(0)" data-target="edit-periode" data-id="{{ $periode->id_periode }}" class="open edit mr-1 rounded px-4 py-2 text-white text-xs font-medium bg-[var(--yellow-tertiary)] transition-all duration-300 ease-in-out lg:hover:bg-yellow-500">
    Edit    
</a>
<form action="{{ route('admin.periode.hapus', ['id' => $periode->id_periode]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="cursor-pointer rounded px-4 py-2 text-white text-xs font-medium bg-[var(--red-tertiary)] transition-all duration-300 ease-in-out lg:hover:bg-red-600">
        Hapus
    </button>
</form>