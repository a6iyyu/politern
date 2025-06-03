<section class="modal modal-edit-mahasiswa fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="min-h-screen flex items-center justify-center w-full px-4">
        <form action="#" method="POST" id="form-edit-mahasiswa"
            class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')

            <h2 class="text-lg font-semibold text-center text-gray-800 mb-3">
                Edit Data Mahasiswa
            </h2>
            <hr class="mb-4 border border-[var(--primary)]" />

            <h5 class="cursor-default mt-6 px-6 py-4 rounded-md text-sm bg-[var(--secondary)] text-white">
                Data Pengguna
            </h5>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-user-group"
                    label="Nama Pengguna"
                    name="nama_pengguna"
                    type="text"
                    placeholder="Nama Pengguna"
                    :required="true"
                    :value="$mahasiswa->pengguna->nama_pengguna ?? ''"
                />
                <x-input
                    icon="fa-solid fa-key"
                    label="Kata Sandi"
                    type="password"
                    name="kata_sandi"
                    placeholder="Masukkan Kata Sandi"
                    :required="true"
                    :value="$mahasiswa->pengguna->kata_sandi ?? ''"
                />
            </span>
            <x-input
                icon="fa-solid fa-envelope"
                label="Email"
                name="email"
                type="email"
                placeholder="Email"
                :required="true"
                :value="$mahasiswa->pengguna->email ?? ''"
            />

            <h5 class="cursor-default my-6 px-6 py-4 rounded-md text-sm bg-[var(--secondary)] text-white">
                Data Mahasiswa
            </h5>
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
                    icon="fa-solid fa-calendar"
                    label="Semester"
                    name="semester"
                    type="number"
                    placeholder="Semester"
                    :required="true"
                    :value="$mahasiswa->semester ?? ''"
                />
            </span>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-select
                    label="Pilih Program Studi"
                    name="program_studi"
                    placeholder="-- Semua Program Studi --"
                    :options="$program_studi->pluck('nama', 'id_prodi')->toArray()"
                    :required="true"
                    :selected="old('program_studi', $mahasiswa->id_prodi ?? '')"
                />
                <x-select
                    label="Angkatan"
                    name="angkatan"
                    placeholder="-- Semua Angkatan --"
                    :options="['2023' => '2023', '2024' => '2024']"
                    :required="true"
                    :selected="old('angkatan', $mahasiswa->angkatan ?? '')"
                />
            </span>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-calculator"
                    label="IPK"
                    name="ipk"
                    type="number"
                    step="0.01"
                    placeholder="IPK"
                    :required="true"
                    :value="$mahasiswa->ipk ?? ''"
                />
            </span>

            <span class="flex justify-end gap-3 items-center mt-6">
                <button type="button" class="close bg-red-500 text-white px-5 py-2 rounded hover:bg-red-600 transition-all duration-300">
                    Tutup
                </button>
                <button type="submit" class="bg-[var(--blue-tertiary)] text-white px-5 py-2 rounded hover:bg-[#66c2a3] transition-all duration-300">
                    Edit
                </button>
            </span>
        </form>
    </div>
</section>
