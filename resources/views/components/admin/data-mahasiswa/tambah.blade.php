<section class="modal modal-tambah-mahasiswa fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form action="{{ route('admin.data-mahasiswa.tambah') }}" method="POST" class="max-h-[90vh] overflow-y-auto w-full max-w-2xl rounded-xl bg-white py-7 px-10 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('POST')
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                    Tambah Mahasiswa
                </h2>
                <i class="close fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-6 border border-[var(--primary)]"/>
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
            </span>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Semester"
                    name="semester"
                    placeholder="Semester"
                    type="number"
                    :required="true"
                />
                <x-select
                    label="Angkatan"
                    name="angkatan"
                    placeholder="-- Semua Angkatan --"
                    :options="$angkatan"
                    :required="true"
                />
            </span>
            <span class="mb-3 mt-6 flex items-center">
                <x-select
                    label="Pilih Program Studi"
                    name="program_studi"
                    placeholder="-- Semua Program Studi --"
                    :options="$program_studi->pluck('nama', 'id_prodi')->toArray()"
                    :required="true"
                />
            </span>
            <button type="submit" class="cursor-pointer mt-4 mb-2 w-full bg-[var(--primary)] text-white text-sm px-5 py-3 rounded-md transition-all hover:bg-[#5955b2]/90 duration-300 ">
                Simpan
            </button>
        </form>
    </div>
</section>