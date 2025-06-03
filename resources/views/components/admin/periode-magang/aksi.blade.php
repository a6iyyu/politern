<a href="javascript:void(0)" data-id="{{ $periode->id_periode }}" class="detail inline-flex items-center rounded px-4 py-2 text-white text-xs font-medium bg-[var(--blue-tertiary)] hover:bg-blue-700 mr-2">
    Detail
</a>
<a href="javascript:void(0)" data-target="edit-periode" data-id="{{ $periode->id_periode }}" class="open edit inline-flex items-center rounded px-4 py-2 text-white text-xs font-medium bg-[var(--yellow-tertiary)] hover:bg-yellow-500 mr-1">
    Edit    
</a>
<form action="{{ route('admin.periode-magang.hapus', ['id' => $periode->id_periode]) }}" class="inline-block" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
        class="inline-flex items-center rounded px-4 py-2 text-white text-xs font-medium bg-[var(--red-tertiary)] hover:bg-red-600">
        Hapus
    </button>
</form>