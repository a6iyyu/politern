<section class="mt-4 w-full overflow-x-auto">
    <div class="flex gap-4 min-w-max">
        <x-info
            background="#ebf2fe"
            color="#2c6cd3"
            icon="fa-solid fa-user-group"
            info="{{ $totalMahasiswa ? round(($totalBimbingan / $totalMahasiswa) * 100) : 0 }}% dari total seluruh mahasiswa"
            title="Total Mahasiswa Bimbingan"
            total="{{ $totalBimbingan }}"
        />
        <x-info
            background="#e7f8f2"
            color="#10b981"
            icon="fa-solid fa-user-check"
            info="{{ $totalBimbingan ? round(($mahasiswaAktif / $totalBimbingan) * 100) : 0 }}% dari total mahasiswa bimbingan"
            title="Mahasiswa Aktif Magang"
            total="{{ $mahasiswaAktif }}"
        />
        <x-info
            background="#fef5e6"
            color="#f59e0b"
            icon="fa-solid fa-user-xmark"
            info="{{ $mahasiswaUnikEvaluasi }} mahasiswa menunggu evaluasi"
            title="Menunggu Evaluasi"
            total="{{ $menungguEvaluasi }}"
        />
        <x-info
            background="#fdecec"
            color="#ef4545"
            icon="fa-solid fa-bars-progress"
            info="{{ $totalBimbingan ? round(($mahasiswaSelesai / $totalBimbingan) * 100) : 0 }}% dari total mahasiswa bimbingan"
            title="Mahasiswa Selesai Magang"
            total="{{ $mahasiswaSelesai }}"
        />
    </div>
</section>