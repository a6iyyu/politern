<section id="modal-detail-perusahaan" class="cursor-default fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <figure class="w-full max-w-xl rounded-xl bg-white px-7 py-6 shadow-lg border border-gray-200">
            <span class="mb-3 flex items-center justify-between">
                <h2 class="font-semibold text-sm text-indigo-600 lg:text-base">Detail Perusahaan Mitra</h2>
                <i id="close-detail" class="fa-solid fa-xmark cursor-pointer text-indigo-600"></i>
            </span>
            <hr class="mb-3 border-indigo-600" />
            <figcaption class="flex text-sm items-center gap-4">
                <img id="logo_perusahaan" alt="Logo Perusahaan" class="w-16 h-16 rounded-full object-cover" />
                <div>
                    <span class="flex gap-2">
                        <h5 class="font-semibold text-gray-800">Nama Perusahaan Mitra:</h5>
                        <h5 id="nama" class="text-gray-600">-</h5>
                    </span>
                    <span class="flex gap-1 mt-1">
                        <h5 class="font-semibold text-gray-800">NIB:</h5>
                        <h5 id="nib" class="text-gray-600">-</h5>
                    </span>
                </div>
            </figcaption>
            <figcaption class="mt-4 grid grid-cols-2 gap-4 text-sm">
                <span>
                    <h5 class="mb-1 font-semibold text-gray-800">Email</h5>
                    <h5 id="email" class="text-gray-600">-</h5>
                </span>
                <span>
                    <h5 class="mb-1 font-semibold text-gray-800">Nomor Telepon</h5>
                    <h5 id="nomor_telepon" class="text-gray-600">-</h5>
                </span>
            </figcaption>
            <figcaption class="mt-4 grid grid-cols-2 gap-4 text-sm">
                <span>
                    <h5 class="mb-1 font-semibold text-gray-800">Website</h5>
                    <h5 id="website" class="text-gray-400">-</h5>
                </span>
                <span>
                    <h5 class="mb-1 font-semibold text-gray-800">Status</h5>
                    <h5 id="status"
                        class="w-fit rounded-full bg-green-100 px-4 py-1 text-xs font-semibold text-green-700">-</h5>
                </span>
            </figcaption>
            <figcaption class="mt-4 text-sm">
                <h5 class="mb-1 font-semibold text-gray-800">Tanggal Dibuat</h5>
                <h5 id="tanggal_dibuat" class="text-gray-600">-</h5>
            </figcaption>
        </figure>
    </div>
</section>