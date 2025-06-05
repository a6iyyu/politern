<section class="modal modal-edit-dosen fixed inset-0 z-50 hidden items-center justify-center bg-black/20 backdrop-blur-[1px]" aria-modal="true" role="dialog">
    <div class="flex items-center justify-center min-h-screen px-4">
        <form action="#" method="POST" id="form-edit-dosen" class="max-h-[90vh] overflow-y-auto w-full max-w-xl rounded-xl bg-white py-7 px-10 shadow-lg border border-[var(--stroke)]">
            @csrf
            @method('PUT')
            <span class="mb-3 flex items-center justify-between">
                <h2 class="cursor-default text-sm font-semibold text-[var(--primary)]">
                    Edit Data Dosen
                </h2>
                <i class="close fa-solid fa-xmark cursor-pointer text-[var(--primary)]"></i>
            </span>
            <hr class="mb-6 border border-[var(--primary)]" />
            @if ($errors->any())
                <ul class="p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <h5 class="cursor-default my-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
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
                    :value="$dosen->pengguna->nama_pengguna ??''"
                />
                <x-input
                    icon="fa-solid fa-key"
                    label="Kata Sandi"
                    type="password"
                    name="kata_sandi"
                    placeholder="Masukkan Kata Sandi"
                    :required="true"
                    :value="$dosen->pengguna->kata_sandi ?? ''"
                />
            </span>
            <x-input
                icon="fa-solid fa-envelope"
                label="Email"
                type="email"
                name="email"
                placeholder="Masukkan Email"
                :required="true"
                :value="$dosen->pengguna->email ??''"
            />
            <h5 class="cursor-default my-6 px-5 py-3 rounded-md text-sm bg-[var(--secondary)] text-white">
                Data Dosen
            </h5>
            <div class="my-6 flex flex-col gap-3">
                <x-input
                    icon="fa-solid fa-envelope"
                    label="Nama Lengkap"
                    type="text"
                    name="nama"
                    placeholder="Masukkan nama lengkap"
                    :required="true"
                    :value="$dosen->nama ??''"
                />
                <x-input
                    icon="fa-solid fa-id-card"
                    label="NIP"
                    type="text"
                    name="nip"
                    placeholder="Masukkan NIP"
                    :required="true"
                    :value="$dosen->nip ??''"
                />
                <x-input
                    icon="fa-solid fa-phone"
                    label="Nomor Telepon"
                    type="number"
                    name="nomor_telepon"
                    placeholder="Masukkan Nomor Telepon"
                    :required="true"
                    :value="$dosen->nomor_telepon ??''"
                />
            </div>
            <button type="submit" class="mt-4 mb-2 w-full bg-[var(--primary)] text-white text-sm px-5 py-3 rounded-md transition-all hover:bg-[#5955b2]/90 duration-300 ">
                Simpan
            </button>
        </form>
    </div>
</section>