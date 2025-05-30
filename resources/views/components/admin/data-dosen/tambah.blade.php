<section class="modal modal-tambah-dosen fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="w-full max-w-2xl rounded-xl bg-white p-6 shadow-lg border border-[var(--stroke)]">
            <h2 class="text-lg font-semibold text-center text-gray-800 mb-3">
                Tambah Data Dosen </h2>
            <hr class="mb-4 border border-[var(--primary)]" />
                <div class="mb-4">
                    <h2 class="bg-pink-400 text-white font-semibold px-4 py-2 rounded-t-md text-sm">Data Pengguna</h2>
                    <div class="p-4 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-input
                                icon="fa-solid fa-user"
                                label="Nama Pengguna"
                                type="text"
                                name="nama_pengguna"
                                placeholder="Masukkan nama pengguna"
                                :required="true"
                            />
                            <x-input 
                                icon="fa-solid fa-key"
                                label="Password"
                                type="password"
                                name="password"
                                placeholder="Masukkan password"
                                :required="true"
                            />
                        </div>
                        <div>
                            <x-input
                                icon="fa-solid fa-envelope"
                                label="Email"
                                type="email"
                                name="email"
                                placeholder="Masukkan email"
                                :required="true"
                            />
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <h2 class="bg-pink-400 text-white font-semibold px-4 py-2 rounded-t-md text-sm">Data Dosen</h2>
                    <div class="p-4 space-y-4">
                        <x-input 
                        icon="fa-solid fa-envelope"
                        label="Nama Legkap"
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
                </div>
                <div class="flex justify-end gap-3 items-center mt-6">
                    <button type="button" class="close bg-red-500 text-white px-5 py-2 rounded hover:bg-red-600 transition-all duration-300">
                        Tutup
                    </button>
                    <button type="submit" class="bg-[var(--blue-tertiary)] text-white px-5 py-2 rounded hover:bg-[#66c2a3] transition-all duration-300">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
