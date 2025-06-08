@php
    $status = [
        'BELUM MAGANG'      => 'bg-[var(--red-tertiary)]',
        'DALAM PROSES'      => 'bg-[var(--yellow-tertiary)]',
        'SEDANG MAGANG'     => 'bg-[var(--blue-tertiary)]',
        'SELESAI'           => 'bg-[var(--green-tertiary)]',
    ]
@endphp

<figure class="cursor-default flex flex-col gap-4">
    <header class="flex items-center gap-4">
        <img
            src="{{ asset($mahasiswa->foto_profil) ?? asset('shared/profil.png') }}"
            alt="{{ $mahasiswa->nama_lengkap ?? 'Foto Profil' }}"
            class="h-12 w-12 object-cover rounded-full lg:h-16 lg:w-16"
        />
        <div class="flex flex-col gap-2 text-sm">
            <h5>
                Nama Lengkap: <strong>{{ $mahasiswa->nama_lengkap ?? 'N/A' }}</strong>
            </h5>
            <h5>
                NIM: <strong>{{ $mahasiswa->nim ?? 'N/A' }}</strong>
            </h5>
        </div>
    </header>
    <div class="mt-4 grid grid-cols-1 gap-4 text-sm sm:grid-cols-2">
        <span class="flex flex-col gap-2">
            Program Studi <strong>{{ $mahasiswa->program_studi->kode }}</strong>
        </span>
        <span class="flex flex-col gap-2">
            Angkatan <strong>{{ $mahasiswa->angkatan }}</strong>
        </span>
        <span class="flex flex-col gap-2">
            Semester
            <strong>
                Semester {{ $mahasiswa->semester }} / @if ($mahasiswa->semester % 2 == 1) Ganjil @else Genap @endif
            </strong>
        </span>
        <span class="flex flex-col gap-2">
            IPK <strong>{{ $mahasiswa->ipk }}</strong>
        </span>
        <span class="flex flex-col gap-2">
            Status
            <strong class="w-fit px-4 py-1 rounded-full text-white {{ $status[$mahasiswa->status] ?? 'bg-[#f3f3f3] text-[#2d2d2d]' }}">
                {{ $mahasiswa->status }}
            </strong>
        </span>
    </div>
    <h5 class="mt-4 font-semibold text-[var(--primary)]">
        Informasi Detail Mahasiswa
    </h5>
    <div class="mt-2 grid grid-cols-1 gap-4 text-sm sm:grid-cols-2">
        <span class="flex flex-col gap-2">
            Email <strong>{{ $mahasiswa->pengguna->email ?? 'N/A' }}</strong>
        </span>
        <span class="flex flex-col gap-2">
            Nomor Telepon <strong>{{ $mahasiswa->nomor_telepon ?? 'N/A' }}</strong>
        </span>
    </div>
    <span class="flex flex-col gap-2 text-sm">
        Alamat <strong>{{ $mahasiswa->alamat ?? 'N/A' }}</strong>
    </span>
</figure>