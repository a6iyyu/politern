<section id="modal-edit-prodi" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form action="#" method="POST" id="form-edit-prodi"
            class="max-h-[90vh] overflow-y-auto w-full max-w-2xl rounded-xl bg-white p-10 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')

            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                    Edit Program Studi
                </h2>
                <i id="close-edit" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-6 border border-[var(--primary)]" />

            <x-input
                icon="fa-solid fa-user"
                label="Nama Program Studi"
                name="nama"
                type="text"
                placeholder="Nama Program Studi"
                :required="true"
                :value="$prodi->nama ?? ''"
            />
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-id-card"
                    label="Kode Program Studi"
                    name="kode_prodi"
                    type="text"
                    placeholder="Kode Program Studi"
                    :required="true"
                    :value="$prodi->kode_prodi ?? ''"
                />
                <x-select
                    label="Jenjang"
                    name="jenjang_prodi"
                    placeholder="-- Jenjang --"
                    :options="['D2' => 'D2', 'D3' => 'D3', 'D4' => 'D4']"
                    :required="true"
                    :selected="old('jenjang_prodi', $prodi->jenjang_prodi ?? '')"
                />
            </span>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Jurusan"
                    name="jurusan_prodi"
                    type="text"
                    placeholder="Jurusan"
                    :required="true"
                    :value="$prodi->jurusan_prodi ?? ''"
                />
                <x-select
                    label="Status"
                    name="status_prodi"
                    placeholder="-- Status --"
                    :options="['AKTIF' => 'AKTIF', 'NONAKTIF' => 'NONAKTIF']"
                    :required="true"
                    :selected="old('status_prodi', $prodi->status_prodi ?? '')"
                />
            </span>
            
            <button type="submit" class="mt-4 w-full bg-[var(--primary)] text-white text-sm px-5 py-3 rounded-md hover:bg-[#5955b2]/90 transition-all duration-300">
                Simpan
            </button>
        </form>
    </div>
</section>