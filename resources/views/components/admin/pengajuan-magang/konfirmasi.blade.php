@if ($pengajuan->status === 'MENUNGGU')
    <div class="inline-flex overflow-hidden gap-2">
        <!-- Terima Form -->
        <form method="POST" action="{{ route('admin.pengajuan-magang.update-status', ['id' => $pengajuan->id_pengajuan_magang]) }}" class="inline">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="DISETUJUI">
            <button
                type="submit"
                onclick="return confirm('Apakah Anda yakin ingin menyetujui pengajuan magang ini?')"
                class="px-4 py-2 text-xs font-medium text-green-500 font-semibold bg-white rounded-lg border border-green-500 hover:bg-green-100 transition-all duration-200">
                Terima
            </button>
        </form>
        
        <!-- Tolak Form -->
        <form method="POST" action="{{ route('admin.pengajuan-magang.update-status', ['id' => $pengajuan->id_pengajuan_magang]) }}" class="inline">
            @csrf
            @method('PUT')
            <input type="hidden" name="status" value="DITOLAK">
            <button
                type="submit"
                onclick="return confirm('Apakah Anda yakin ingin menolak pengajuan magang ini?')"
                class="px-4 py-2 text-xs font-medium text-red-500 font-semibold rounded-lg border border-red-500 hover:bg-red-100 transition-all duration-200">
                Tolak
            </button>
        </form>
    </div>
@endif