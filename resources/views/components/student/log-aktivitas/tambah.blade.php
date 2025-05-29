{{--
    TODO: Menambahkan beberapa input form pada modal ini,
    sesuaikan dengan database.
--}}

<section class="modal modal-log-mahasiswa fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            <h2 class="cursor-default mb-3 font-semibold text-lg text-center text-gray-800">
                Tambah Log Aktivitas
            </h2>
            <hr class="mb-3 border border-[var(--stroke)]" />
            <figcaption class="space-y-4">
                <form action="{{ route('mahasiswa.log-aktivitas.tambah') }}" method="POST" class="mt-4 flex flex-col gap-4">
                    @csrf
                    @method('POST')
                    <span class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                        <x-input
                            icon="fa-solid fa-note-sticky"
                            label="Judul"
                            name="judul"
                            placeholder="Masukkan Judul Log"
                            type="text"
                            :required="true"
                        />
                        <x-input
                            icon="fa-solid fa-calendar"
                            label="Minggu"
                            name="minggu"
                            placeholder="Masukkan Minggu"
                            type="number"
                            :required="true"
                        />
                    </span>
                    <x-input
                        icon="fa-solid fa-image"
                        label="Foto"
                        name="foto"
                        placeholder="Unggah Foto"
                        type="file"
                        :required="true"
                    />
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
                    <span class="flex items-center justify-end gap-3 text-xs text-white">
                        <button class="close cursor-pointer mt-6 w-fit px-5 py-2 bg-red-500 rounded transition-all duration-300 ease-in-out lg:hover:bg-red-600">
                            Tutup
                        </button>
                        <button type="submit" class="cursor-pointer mt-6 w-fit px-5 py-2 bg-[var(--green-tertiary)] rounded transition-all duration-300 ease-in-out lg:hover:bg-[#66c2a3]">
                            Kirim
                        </button>
                    </span>
                </form>
            </figcaption>
        </figure>
    </div>
</section>