<section class="modal modal-tambah-lowongan fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="min-h-screen flex items-center justify-center w-full px-4">
        <form action="{{ route('admin.lowongan-magang.tambah') }}" method="POST"
            class="max-h-[90vh] overflow-y-auto w-full max-w-2xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('POST')
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-[#5955B2]">Tambah Lowongan Magang</h2>
                <button id="close-tambah-lowongan" type="button" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-xmark close"></i>
                </button>
            </div>
            <hr class="border border-[var(--primary)] mb-6 " />
            <h5 class="bg-[#E86BB1] text-white text-left py-2 rounded-md text-sm font-medium mb-6 px-4">
                Data Lowongan Magang
            </h5>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <x-select label="Perusahaan" name="id_perusahaan_mitra" :required="true"
                    placeholder="Pilih nama perusahaan" />
                <x-select label="Bidang Posisi Magang" name="id_bidang" :required="true"
                    placeholder="Pilih jenis bidang" />
                <div class="md:col-span-2">
                    <div class="flex items-end gap-2">
                        <x-select label="Pilih Keahlian" name="id_keahlian" placeholder="Pilih jenis keahlian magang" class="flex-1" required="true" />
                        <button type="button" class="bg-[#E86BB1] text-white h-[42px] px-4 rounded hover:bg-pink-500 transition">
                            Tambah
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2 mt-2">
                        <span class="bg-pink-100 text-pink-700 px-3 py-1 rounded-full text-xs flex items-center"></span>
                    </div>
                </div>
                <x-select label="Periode" name="id_periode" :required="true" placeholder="Pilih periode magang" :options="[]" />
                <x-select label="Jenis Lokasi Magang" name="id_jenis_lokasi" :required="true" placeholder="Pilih jenis lokasi magang" :options="$lokasiOptions ?? []" />
            </div>
            <x-input
                icon=""
                label="Deskripsi Lowongan"
                name="deskripsi"
                placeholder="Masukkan deskripsi dan persyaratan lengkap lowongan magang" :required="true"
                class="mt-6 h-32"
              />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                <x-input icon="" label="Perkiraan Gaji" type="number" name="gaji" placeholder="Masukkan gaji" :required="true" />
                <x-input icon="" label="Minimal IPK" type="number" step="0.01" name="ipk" placeholder="Masukkan minimal IPK" :required="true" />
                <x-input icon="fa-solid fa-user-group" label="Jumlah Kuota" type="number" name="kuota" placeholder="Masukkan jumlah kuota" :required="true" />
                <x-select icon="" label="Status" name="status" :required="true" placeholder="Pilih Status" :options="['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif']" />
                <x-input icon="fa-solid fa-calendar" label="Tanggal Mulai Pendaftaran" type="date" name="tanggal_mulai_pendaftaran" :required="true" />
                <x-input icon="fa-solid fa-calendar" label="Tanggal Selesai Pendaftaran" type="date" name="tanggal_selesai_pendaftaran" :required="true" />
            </div>
            <div class="mt-8">
                <button type="submit" class="w-full bg-[#5955B2] text-white py-3 rounded hover:bg-indigo-700 transition">
                    Tambah
                </button>
            </div>
        </form>
    </div>
</section>