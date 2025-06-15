<section class="modal modal-tambah-periode fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form action="{{ route('admin.periode.tambah') }}" method="POST" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white py-7 px-10 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('POST')
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                    Tambah Periode
                </h2>
                <i class="close fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-4 border border-[var(--primary)]" />
            <x-input
                icon="fa-solid fa-calendar"
                label="Nama Periode"
                name="nama_periode"
                type="text"
                placeholder="Masukkan Nama Periode"
                :required="true"
            />
            <div class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Tanggal Mulai"
                    name="tanggal_mulai"
                    type="date"
                    placeholder="Pilih Tanggal Mulai"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Tanggal Selesai"
                    name="tanggal_selesai"
                    type="date"
                    placeholder="Pilih Tanggal Selesai"
                    :required="true"
                />
            </div>
            <button type="submit" class="cursor-pointer mt-4 mb-2 w-full bg-[var(--primary)] text-white text-sm px-5 py-3 rounded-md transition-all hover:bg-[#5955b2]/90 duration-300 ">
                Simpan
            </button>
        </form>
    </div>
</section>