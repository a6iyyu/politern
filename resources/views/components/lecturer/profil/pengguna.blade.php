<figure class="cursor-default flex flex-col gap-4">
    <header class="flex items-center gap-4">
        <img
            src="{{ asset('shared/profil.png') }}"
            alt="{{ $dosen->nama ?? 'Foto Profil' }}"
            class="h-12 w-12 object-cover rounded-full lg:h-16 lg:w-16"
        />
        <div class="flex flex-col gap-2 text-sm">
            <h5>
                Nama Lengkap: <strong>{{ $dosen->nama ?? 'N/A' }}</strong>
            </h5>
            <h5>
                NIP: <strong>{{ $dosen->nip ?? 'N/A' }}</strong>
            </h5>
        </div>
    </header>
    <div class="mt-4 grid grid-cols-1 gap-4 text-sm sm:grid-cols-3">
        <span class="flex flex-col gap-2">
            Nama Pengguna <strong>{{ $dosen->pengguna->nama_pengguna ?? 'N/A' }}</strong>
        </span>
        <span class="flex flex-col gap-2">
            Email <strong>{{ $dosen->pengguna->email ?? 'N/A' }}</strong>
        </span>
        <span class="flex flex-col gap-2">
            Telepon <strong>{{ $dosen->nomor_telepon ?? 'N/A' }}</strong>
        </span>
    </div>
</figure>