<section id="modal-log-edit" class="modal fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-2xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)] max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-2">
                <h2 class="text-lg font-semibold text-[#5955B2]">Edit Log Aktivitas</h2>
                <button type="button" class="close transition-all duration-300 ease-in-out text-gray-400 lg:hover:text-gray-600">
                    <i class="fa-solid fa-xmark cursor-pointer"></i>
                </button>
            </div>
            <hr class="mb-3 border border-[var(--stroke)]" />
            <div class="cursor-default mb-6 rounded-lg bg-gray-100 px-5 py-4 border-l-4 border-[#5955B2]">
                <h5 class="text-sm font-semibold text-[#5955B2] mb-1">
                    {{ $perusahaan ?? 'Nama Perusahaan' }}
                </h5>
                <h5 class="text-lg font-bold text-black leading-tight">
                    {{ $posisi ?? 'Posisi Magang' }}
                </h5>
                <h5 class="text-sm text-gray-500 mb-2">
                    {{ $lokasi ?? 'Lokasi Magang' }}
                </h5>
                <h5 class="flex flex-col text-sm text-[#5955B2]">
                    Dosen Pembimbing
                    <span class="font-semibold">{{ $dospem ?? '-' }}</span>
                </h5>
            </div>
            <figcaption class="space-y-4">
                <form method="POST" class="mt-4 flex flex-col gap-4" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <span class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                        <x-input
                            icon="fa-solid fa-calendar"
                            label="Minggu"
                            name="minggu"
                            placeholder="Masukkan Minggu"
                            type="number"
                            :required="true"
                            :value="old('minggu')"
                        />
                        <x-input
                            icon="fa-solid fa-note-sticky"
                            label="Judul"
                            name="judul"
                            placeholder="Masukkan Judul Log"
                            type="text"
                            :required="true"
                            :value="old('judul')"
                        />
                    </span>
                    <fieldset class="flex flex-col gap-1">
                        <label for="deskripsi" class="text-sm font-medium text-gray-700">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            class="p-3 text-sm border border-gray-300 rounded-lg resize-none focus:outline-none focus:ring focus:border-blue-300"
                            placeholder="Tuliskan deskripsi aktivitas di sini..."
                            rows="4"
                            required
                        ></textarea>
                    </fieldset>
                    <img id="foto" src="" alt="Foto dokumentasi" class="w-full max-h-80 object-cover rounded-lg hidden" />
                    <x-input
                        icon="fa-solid fa-image"
                        label="Foto Dokumentasi"
                        name="foto"
                        placeholder="Unggah file disini"
                        type="file"
                        :required="false"
                    />
                    <button type="submit" class="cursor-pointer w-full mt-6 px-5 py-3 bg-[#5955B2] text-white rounded-lg font-semibold text-xs transition-all duration-300 ease-in-out hover:bg-[#4743a0]">
                        Perbarui Aktivitas
                    </button>
                </form>
            </figcaption>
        </figure>
    </div>
</section>