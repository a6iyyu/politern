<section class="mt-4 px-8 py-6 rounded-lg bg-[#eeeeee]">
    <span class="flex items-center gap-4">
        <i class="fa-solid fa-user"></i>
        <h5 class="font-semibold">Informasi Pengguna</h5>
    </span>
    <h5 class="mt-3.5 text-sm">
        <strong>Nama Pengguna:</strong> {{ $mahasiswa->pengguna->nama_pengguna ?? 'N/A' }}
    </h5>
    <h5 class="mt-1 text-sm">
        <strong>Email:</strong> {{ $mahasiswa->pengguna->email ?? 'N/A' }}
    </h5>
</section>