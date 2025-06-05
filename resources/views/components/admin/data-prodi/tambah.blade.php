<section class="modal modal-tambah-prodi fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form action="{{ route('admin.data-prodi.tambah') }}" method="POST" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white py-7 px-10 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('POST')
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                    Tambah Program Studi
                </h2>
                <i class="close fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-6 border border-[var(--primary)]"/>
            @if ($errors->any())
                <ul class="p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <x-input
                icon="fa-solid fa-user-group"
                label="Nama Program Studi"
                name="nama"
                placeholder="Nama Program Studi"
                type="text"
                :required="true"
            />
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-lock"
                    label="Kode Program Studi"
                    name="kode"
                    placeholder="Kode Program Studi"
                    type="text"
                    :required="true"
                />
                <x-select
                    label="Jenjang"
                    name="jenjang"
                    placeholder="-- Jenjang --"
                    :options="['D1' => 'D1', 'D2' => 'D2', 'D3' => 'D3', 'D4' => 'D4', 'S2' => 'S2', 'S3' => 'S3']"
                    :required="true"
                    :selected="old('jenjang', '')"
                />
            </span>
            <span class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Jurusan"
                    name="jurusan"
                    placeholder="Jurusan"
                    type="text"
                    :required="true"
                />
            </span>
            <button type="submit" class="mt-4 mb-2 w-full bg-[var(--primary)] text-white text-sm px-5 py-3 rounded-md transition-all hover:bg-[#5955b2]/90 duration-300 ">
                Simpan
            </button>
        </form>
    </div>
</section>