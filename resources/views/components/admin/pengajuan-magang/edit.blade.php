<div class="modal-edit-pengajuan fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-3xl bg-white rounded-lg shadow-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Pengajuan Magang</h3>
                    <button type="button" class="close-edit text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="editPengajuanForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="pengajuan_id" id="editPengajuanId">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIM</label>
                            <input type="text" id="editNim" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
                            <input type="text" id="editNama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" readonly>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                            <input type="text" id="editProdi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">IPK</label>
                            <input type="text" id="editIpk" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" readonly>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="editStatus" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="editStatus" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="MENUNGGU">Menunggu</option>
                            <option value="DISETUJUI">Disetujui</option>
                            <option value="DITOLAK">Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="editCatatan" class="block text-sm font-medium text-gray-700">Catatan</label>
                        <textarea name="catatan" id="editCatatan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button" class="close-edit px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>