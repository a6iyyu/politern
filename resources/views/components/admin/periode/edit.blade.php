<section class="modal modal-edit-periode fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form action="#" method="POST" id="form-edit-periode" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white py-7 px-10 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                    Edit Data Periode
                </h2>
                <i class="close-periode fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-6 border border-[var(--primary)]" />
            <x-input
                icon="fa-solid fa-clock"
                label="Nama Periode"
                type="text"
                name="nama_periode"
                placeholder="Masukkan Nama Periode"
                :required="true"
            />
            <div class="mb-3 mt-6 flex items-center justify-between gap-4">
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Tanggal Mulai"
                    type="date"
                    name="tanggal_mulai"
                    placeholder="Pilih Tanggal Mulai"
                    :required="true"
                />
                <x-input
                    icon="fa-solid fa-calendar"
                    label="Tanggal Selesai"
                    type="date"
                    name="tanggal_selesai"
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