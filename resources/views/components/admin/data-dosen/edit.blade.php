<section class="modal modal-edit-dosen fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="min-h-screen flex items-center justify-center w-full px-4">
        <form action="" method="POST"
            class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')
            <h2 class="text-lg font-semibold text-center text-gray-800 mb-3">
                Edit Data Dosen
            </h2>
            <hr class="mb-4 border border-[var(--primary)]" />
            <h5 class="cursor-default mt-6 px-6 py-4 rounded-md text-sm bg-[var(--secondary)] text-white">
                Data Pengguna
            </h5>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-user"
                    label="Nama Pengguna"
                    type="text"
                    name="nama_pengguna"
                    placeholder="Masukkan Nama Pengguna"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-key"
                    label="Kata Sandi"
                    type="password"
                    name="kata_sandi"
                    placeholder="Masukkan Kata Sandi"
                    :required="true"
                />
            </span>
            <x-input
                icon="fa-solid fa-envelope"
                label="Email"
                type="email"
                name="email"
                placeholder="Masukkan Email"
                :required="true"
            />
            <h5 class="cursor-default my-6 px-6 py-4 rounded-md text-sm bg-[var(--secondary)] text-white">
                Data Pengguna
            </h5>
            <div class="my-6 flex flex-col gap-3">
                <x-input
                    icon="fa-solid fa-envelope"
                    label="Nama Lengkap"
                    type="text"
                    name="nama"
                    placeholder="Masukkan nama lengkap"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-id-card"
                    label="NIP"
                    type="text"
                    name="nip"
                    placeholder="Masukkan NIP"
                    :required="true"
                />
            </div>
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
