<section class="modal modal-edit-prodi fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form action="#" method="POST" id="form-edit-prodi" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white py-7 px-10 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                    Edit Program Studi
                </h2>
                <i id="close-edit" class="fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-6 border border-[var(--primary)]" />
            @if ($errors->any())
                <ul class="p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
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
                    name="kode"
                    type="text"
                    placeholder="Kode Program Studi"
                    :required="true"
                    :value="$prodi->kode ?? ''"
                />
                <x-select
                    label="Jenjang"
                    name="jenjang"
                    placeholder="-- Jenjang --"
                    :options="$jenjang_options"
                    :required="true"
                    :selected="old('jenjang', $prodi->jenjang ?? '')"
                />
            </span>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Jurusan"
                    name="jurusan"
                    type="text"
                    placeholder="Jurusan"
                    :required="true"
                    :value="$prodi->jurusan ?? ''"
                />
                <x-select
                    label="Status"
                    name="status"
                    placeholder="-- Status --"
                    :options="$status_options"
                    :required="true"
                    :selected="old('status', $prodi->status ?? '')"
                />
            </span>
            <button type="submit" class="mt-4 mb-2 w-full bg-[var(--primary)] text-white text-sm px-5 py-3 rounded-md transition-all hover:bg-[#5955b2]/90 duration-300 ">
                Simpan
            </button>
        </form>
    </div>
</section>