@if (isset($pengalaman) && $pengalaman->id_pengalaman > 0)
    <section class="modal modal-edit-pengalaman-mahasiswa fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
        <div class="flex items-center justify-center min-h-screen px-4">
            <form action="{{ route('mahasiswa.profil.pengalaman.perbarui', ['id' => $pengalaman->id_pengalaman]) }}" method="POST" enctype="multipart/form-data" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white px-7 py-5 shadow-lg border border-[var(--stroke)]">
                @csrf
                @method('PUT')
                <span class="mb-3 flex items-center justify-between">
                    <h2 class="cursor-default text-sm font-semibold text-[var(--primary)] lg:text-base">
                        Edit Pengalaman
                    </h2>
                    <i class="close fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
                </span>
                <hr class="mb-4 border border-[var(--primary)]"/>
                <span class="mb-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                    <x-input
                        icon="fa-solid fa-briefcase"
                        label="Posisi"
                        name="edit_posisi_pengalaman"
                        placeholder="Cth. Tukang Tambal Ban"
                        type="text"
                        :required="true"
                    />
                    <x-input
                        icon="fa-solid fa-building"
                        label="Nama Lembaga"
                        name="edit_nama_lembaga_pengalaman"
                        placeholder="PT. ABC Indonesia"
                        type="text"
                        :required="true"
                    />
                </span>
                <x-select
                    icon="fa-solid fa-magnifying-glass"
                    label="Jenis Pengalaman"
                    name="edit_jenis_pengalaman"
                    placeholder="-- Semua Pengalaman --"
                    :options="['kerja' => 'Kerja', 'magang' => 'Magang', 'organisasi' => 'Organisasi', 'relawan' => 'Relawan']"
                    :required="true"
                />
                <fieldset class="mt-4 flex flex-col gap-1">
                    <label for="edit_deskripsi_pengalaman" class="text-sm font-medium text-gray-700">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea
                        id="deskripsi"
                        name="edit_deskripsi_pengalaman"
                        class="p-3 border border-gray-300 rounded-lg resize-none text-sm focus:outline-none focus:ring focus:border-blue-300"
                        placeholder="Tuliskan deskripsi aktivitas di sini..."
                        rows="4"
                        required
                    ></textarea>
                </fieldset>
                <span class="my-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                    <x-input
                        icon="fa-solid fa-calendar"
                        label="Tanggal Mulai"
                        type="date"
                        name="edit_tanggal_mulai_pengalaman"
                        :required="true"
                    />
                    <x-input
                        icon="fa-solid fa-calendar"
                        label="Tanggal Selesai"
                        type="date"
                        name="edit_tanggal_selesai_pengalaman"
                        :required="true"
                    />
                </span>
                <x-input
                    icon="fa-solid fa-image"
                    label="Bukti Pendukung"
                    type="file"
                    name="edit_bukti_pendukung_pengalaman"
                    placeholder="Masukkan Bukti Pendukung"
                    :required="false"
                />
                <button type="submit" class="cursor-pointer mt-8 mb-2 w-full bg-[var(--primary)] text-white text-sm px-5 py-3 rounded-md transition-all hover:bg-[#5955b2]/90 duration-300 ">
                    Simpan
                </button>
            </form>
        </div>
    </section>
@endif