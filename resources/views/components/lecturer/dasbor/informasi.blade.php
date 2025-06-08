<section class="mt-4 w-full overflow-x-auto">
    <div class="flex gap-4 min-w-max">
        <x-info
            background="#ebf2fe"
            color="#2c6cd3"
            icon="fa-solid fa-user-group"
            info="{{ $total_mahasiswa ? round(($total_bimbingan / $total_mahasiswa) * 100) : 0 }}% dari total seluruh mahasiswa"
            title="Total Mahasiswa Bimbingan"
            total="{{ $total_bimbingan }}"
        />
        <x-info
            background="#e7f8f2"
            color="#10b981"
            icon="fa-solid fa-user-check"
            info="{{ $total_bimbingan ? round(($mahasiswa_aktif / $total_bimbingan) * 100) : 0 }}% dari total mahasiswa bimbingan"
            title="Mahasiswa Aktif Magang"
            total="{{ $mahasiswa_aktif }}"
        />
        <x-info
            background="#fef5e6"
            color="#f59e0b"
            icon="fa-solid fa-user-xmark"
            info="{{ $evaluasi_magang ?? 'N/A' }} mahasiswa menunggu evaluasi"
            title="Menunggu Evaluasi"
            total="{{ $menunggu_evaluasi }}"
        />
        <x-info
            background="#fdecec"
            color="#ef4545"
            icon="fa-solid fa-bars-progress"
            info="{{ $total_bimbingan ? round(($mahasiswa_selesai / $total_bimbingan) * 100) : 0 }}% dari total mahasiswa bimbingan"
            title="Mahasiswa Selesai Magang"
            total="{{ $mahasiswa_selesai }}"
        />
    </div>
</section>