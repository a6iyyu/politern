<section class="modal modal-tambah-mahasiswa fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="min-h-screen flex items-center justify-center w-full px-4">
        <form action="{{ route('admin.data-mahasiswa.tambah') }}" method="POST" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white py-7 px-10 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('POST')
            <h2 class="cursor-default mb-3 font-semibold text-sm text-[var(--primary)]">
                Tambah Mahasiswa
            </h2>
            <hr class="mb-3 border border-1 border-[var(--primary)] rounded-xl" />
            @if ($errors->any())
                <ul class="p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <h5 class="cursor-default mt-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                Data Pengguna
            </h5>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-user-group"
                    label="Nama Pengguna"
                    name="nama_pengguna"
                    placeholder="Nama Pengguna"
                    type="text"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-lock"
                    label="Kata Sandi"
                    name="kata_sandi"
                    placeholder="Kata Sandi"
                    type="password"
                    :required="true"
                />
            </span>
            <x-input
                icon="fa-solid fa-envelope"
                label="Email"
                name="email"
                placeholder="Email"
                type="email"
                :required="true"
            />
            <h5 class="cursor-default my-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                Data Mahasiswa
            </h5>
            <x-input
                icon="fa-solid fa-user"
                label="Nama Lengkap"
                name="nama_lengkap"
                placeholder="Nama Lengkap"
                type="text"
                :required="true"
            />
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-id-card"
                    label="NIM"
                    name="nim"
                    placeholder="NIM"
                    type="number"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Semester"
                    name="semester"
                    placeholder="Semester"
                    type="number"
                    :required="true"
                />
            </span>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-select
                    label="Pilih Program Studi"
                    name="program_studi"
                    placeholder="-- Semua Program Studi --"
                    :options="$program_studi->pluck('nama', 'id_prodi')->toArray()"
                    :required="true"
                    :selected="old('program_studi', '')"
                />
                <x-select
                    label="Angkatan"
                    name="angkatan"
                    placeholder="-- Semua Angkatan --"
                    :selected="old('angkatan', $mahasiswa->angkatan ?? '')"
                    :options="['2023' => '2023', '2024' => '2024']"
                    :required="true"
                />
            </span>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-calculator"
                    label="IPK"
                    name="ipk"
                    placeholder="IPK"
                    type="number"
                    step="0.01"
                    :required="true"
                />
            </span>
            <span class="flex justify-end gap-3 items-center mt-6">
                <button type="button" class="close bg-red-500 text-white px-5 py-2 rounded hover:bg-red-600 transition-all duration-300">
                    Tutup
                </button>
                <button type="submit" class="bg-[var(--blue-tertiary)] text-white px-5 py-2 rounded hover:bg-[#66c2a3] transition-all duration-300">
                    Kirim
                </button>
            </span>
        </form>
    </div>
</section>