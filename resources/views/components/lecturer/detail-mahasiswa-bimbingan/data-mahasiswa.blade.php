@php
    $info = [
        'BELUM MAGANG'  => '',
        'DALAM PROSES'  => '',
        'SEDANG MAGANG' => '',
        'SELESAI'       => '',
    ];
@endphp

<h5 class="mb-3.5 mt-10 px-8 py-4 font-semibold rounded-lg bg-[var(--secondary)] text-[var(--background)]">
    Data Mahasiswa
</h5>
<section class="grid grid-cols-1 gap-4 px-8 md:grid-cols-2">
    <span class="mt-1 text-sm">
        <strong>NIM:</strong> {{ $mahasiswa->pengguna->mahasiswa->nim ?? 'N/A' }}
    </span>
    <span class="mt-1 text-sm">
        <strong>Program Studi:</strong> {{ $mahasiswa->pengguna->mahasiswa->program_studi->nama ?? 'N/A' }}
    </span>
    <span class="mt-1 text-sm">
        <strong>Nama Lengkap:</strong> {{ $mahasiswa->pengguna->mahasiswa->nama_lengkap ?? 'N/A' }}
    </span>
    <span class="mt-1 text-sm">
        <strong>IPK:</strong> {{ $mahasiswa->pengguna->mahasiswa->ipk ?? 'N/A' }}
    </span>
    <span class="mt-1 text-sm">
        <strong>Angkatan:</strong> {{ $mahasiswa->pengguna->mahasiswa->angkatan ?? 'N/A' }}
    </span>
    <span class="mt-1 text-sm">
        <strong>Nomor Telepon:</strong> {{ $mahasiswa->pengguna->mahasiswa->nomor_telepon ?? 'N/A' }}
    </span>
    <span class="mt-1 text-sm">
        <strong>Semester:</strong> {{ $mahasiswa->pengguna->mahasiswa->semester ?? 'N/A' }}
    </span>
    <span class="mt-1 text-sm">
        <strong>Status:</strong> {{ $mahasiswa->pengguna->mahasiswa->status ?? 'N/A' }}
    </span>
    <span class="mt-1 gap-1 flex text-sm">
        <strong>Alamat:</strong>
        <h5>{{ $mahasiswa->pengguna->mahasiswa->alamat ?? 'N/A' }}</h5>
    </span>
</section>