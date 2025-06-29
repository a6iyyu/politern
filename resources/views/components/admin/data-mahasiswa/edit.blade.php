<section class="modal modal-edit-mahasiswa fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form action="#" method="POST" id="form-edit-mahasiswa" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white py-7 px-10 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                    Edit Data Mahasiswa
                </h2>
                <i class="close fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-6 border border-[var(--primary)]" />
            <x-input
                icon="fa-solid fa-user"
                label="Nama Lengkap"
                name="nama_lengkap"
                type="text"
                placeholder="Nama Lengkap"
                :required="true"
                :value="$mahasiswa->nama_lengkap ?? ''"
            />
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-id-card"
                    label="NIM"
                    name="nim"
                    type="number"
                    placeholder="NIM"
                    :required="true"
                    :value="$mahasiswa->nim ?? ''"
                />
                <x-input
                    icon="fa-solid fa-id-card"
                    label="IPK"
                    name="ipk"
                    type="number"
                    placeholder="IPK"
                    :required="true"
                    :value="$mahasiswa->ipk ?? ''"
                />
            </span>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Semester"
                    name="semester"
                    type="number"
                    placeholder="Semester"
                    :required="true"
                    :value="$mahasiswa->semester ?? ''"
                />
                <x-select
                    label="Angkatan"
                    name="angkatan"
                    placeholder="-- Semua Angkatan --"
                    :options="$angkatan"
                    :required="true"
                    :selected="old('angkatan', $mahasiswa->angkatan ?? '')"
                />
            </span>
            <span class="mb-3 mt-6 flex items-center">
                <x-select
                        label="Pilih Program Studi"
                        name="program_studi"
                        placeholder="-- Semua Program Studi --"
                        :options="$program_studi->pluck('nama', 'id_prodi')->toArray()"
                        :required="true"
                        :selected="old('program_studi', $mahasiswa->id_prodi ?? '')"
                    />
            </span>
            <button type="submit" class="cursor-pointer mt-4 mb-2 w-full bg-[var(--primary)] text-white text-sm px-5 py-3 rounded-md transition-all hover:bg-[#5955b2]/90 duration-300 ">
                Simpan
            </button>
        </form>
    </div>
</section>