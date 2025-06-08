<section class="modal modal-log-mahasiswa fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-[#5955B2]">Tambah Log Aktivitas</h2>
                <button type="button" class="text-gray-400 hover:text-gray-600 close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <hr class="mb-3 border border-[var(--stroke)]" />

            <div class="mb-6 rounded-lg bg-gray-100 px-5 py-4 border-l-4 border-[#5955B2]">
                <div class="text-sm font-semibold text-[#5955B2] mb-1">
                    {{ $perusahaan ?? 'Nama Perusahaan' }}
                </div>
                <div class="text-lg font-bold text-black leading-tight">
                    {{ $posisi ?? 'Posisi Magang' }}
                </div>
                <div class="text-sm text-gray-500 mb-2">
                    {{ $lokasi ?? 'Lokasi Magang' }}
                </div>
                <div class="text-sm text-[#5955B2]">
                    Dosen Pembimbing : {{ $dospem ?? '-' }}
                </div>
            </div>

            <figcaption class="space-y-4">
                <form action="{{ route('mahasiswa.log-aktivitas.tambah') }}" method="POST" class="mt-4 flex flex-col gap-4" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <span class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                        <x-input
                            icon="fa-solid fa-calendar"
                            label="Minggu"
                            name="minggu"
                            placeholder="Masukkan Minggu"
                            type="number"
                            :required="true"
                        />
                        <x-input
                            icon="fa-solid fa-note-sticky"
                            label="Judul"
                            name="judul"
                            placeholder="Masukkan Judul Log"
                            type="text"
                            :required="true"
                        />
                    </span>
                    <fieldset class="flex flex-col gap-1">
                        <label for="deskripsi" class="text-sm font-medium text-gray-700">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            class="p-3 border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring focus:border-blue-300"
                            placeholder="Tuliskan deskripsi aktivitas di sini..."
                            rows="4"
                            required
                        ></textarea>
                    </fieldset>
                    <x-input
                        icon="fa-solid fa-image"
                        label="Foto Dokumentasi"
                        name="foto"
                        placeholder="Unggah file disini"
                        type="file"
                        :required="true"
                    />

                    {{-- Tombol submit besar di bawah --}}
                    <button
                        type="submit"
                        class="w-full mt-6 px-5 py-3 bg-[#5955B2] text-white rounded-lg font-semibold text-base transition-all duration-300 ease-in-out hover:bg-[#4743a0]"
                    >
                        Tambah Aktivitas
                    </button>
                </form>
            </figcaption>
        </figure>
    </div>
</section>