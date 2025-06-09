<section class="modal modal-konfirmasi-pengajuan fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        @if(isset($pengajuan))
            <form id="konfirmasiForm" method="POST" action="{{ route('admin.pengajuan-magang.konfirmasi', ['id' => $pengajuan->id_pengajuan_magang]) }}" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white p-7 shadow-lg border border-[var(--stroke)]">
                @csrf
                @method('PUT')
                <!-- Modal header -->
                <span class="mb-3 flex items-center justify-between">
                    <h2 class="cursor-default text-sm font-semibold text-[var(--primary)] lg:text-base">Konfirmasi Pengajuan Magang</h2>
                    <i id="close-konfirmasi" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
                </span>
                <hr class="mb-6 border border-[var(--primary)]" />

                <input type="hidden" name="status" id="statusInput" value="">
                <input type="hidden" name="pengajuan_id" id="pengajuanId" value="{{ $pengajuan->id_pengajuan_magang }}">

                <!-- Dosen select -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Dosen Pembimbing</label>
                    <select name="dosen_pembimbing_id" id="dosenPembimbing" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required>
                        <option value="">-- Pilih Dosen --</option>
                        @foreach($dosen as $d)
                            <option value="{{ $d->id_dosen }}">{{ $d->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Buttons -->
                <div class="mt-8 flex justify-end space-x-3">
                    <button type="button" id="tolakBtn" class="px-4 py-2 text-sm font-medium text-red-600 border border-red-600 rounded-md hover:bg-red-50">Tolak</button>
                    <button type="button" id="terimaBtn" class="px-4 py-2 text-sm font-medium text-white bg-[var(--primary)] rounded-md hover:bg-[var(--primary-hover)]">Terima</button>
                </div>
            </form>
        @endif
    </div>
</section>
