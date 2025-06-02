<section class="modal modal-edit-periode fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="min-h-screen flex items-center justify-center w-full px-4">
        <form action="" method="POST" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')
            <h2 class="text-lg font-semibold text-center text-gray-800 mb-3">
                Edit Periode Magang
            </h2>
            <hr class="mb-4 border border-[var(--primary)]" />

            <x-input
                label="Nama Periode"
                type="text"
                name="nama_periode"
                placeholder="Masukkan Nama Periode"
                :required="true"
                :value="$periode->nama_periode ?? ''"
            />

            <div class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    label="Tanggal Mulai"
                    type="date"
                    name="tanggal_mulai"
                    placeholder="Pilih Tanggal Mulai"
                    :required="true"
                    :value="$periode->tanggal_mulai ?? ''"
                />
                <x-input
                    label="Tanggal Selesai"
                    type="date"
                    name="tanggal_selesai"
                    placeholder="Pilih Tanggal Selesai"
                    :required="true"
                    :value="$periode->tanggal_selesai ?? ''"
                />
            </div>

            <div class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-select 
                    label="Durasi" 
                    name="durasi" 
                    :options="['6' => '6 Bulan', '3' => '3 Bulan']" 
                    placeholder="Pilih Durasi" 
                    required
                    :selected="$periode->durasi ?? ''"
                />
                <x-select 
                    label="Status" 
                    name="status" 
                    :options="['aktif' => 'Aktif', 'tidak aktif' => 'Tidak Aktif']" 
                    placeholder="Pilih Status" 
                    required 
                    :selected="$periode->status ?? ''"
                />
            </div>

            <span class="flex justify-end gap-3 text-sm items-center mt-6">
                <button type="button" class="close cursor-pointer bg-red-500 text-white px-5 py-2 rounded hover:bg-red-600 transition-all duration-300">
                    Tutup
                </button>
                <button type="submit" class="cursor-pointer bg-[var(--blue-tertiary)] text-white px-5 py-2 rounded hover:bg-[#3d65a5] transition-all duration-300">
                    Update
                </button>
            </span>
        </form>
    </div>
</section>
