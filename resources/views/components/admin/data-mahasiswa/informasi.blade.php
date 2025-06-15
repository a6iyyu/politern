<section class="mt-4 w-full overflow-x-auto">
    <div class="flex gap-4 min-w-max">
        <x-info
            background="#ebf2fe"
            color="#2c6cd3"
            icon="fa-solid fa-user-group"
            info="{{ $total_mahasiswa ? round(($total_mahasiswa_magang / $total_mahasiswa) * 100) : 0 }}% dari total semua mahasiswa"
            title="Total Mahasiswa Magang"
            total="{{ $total_mahasiswa_magang }}"
        />
        <x-info
            background="#fdecec"
            color="#ef4545"
            icon="fa-solid fa-user-xmark"
            info="{{ $total_mahasiswa ? round(($mahasiswa_belum_magang / $total_mahasiswa) * 100) : 0 }}% dari total semua mahasiswa"
            title="Mahasiswa Belum Magang"
            total="{{ $mahasiswa_belum_magang }}"
        />
        <x-info
            background="#e7f8f2"
            color="#10b981"
            icon="fa-solid fa-bars-progress"
            info="{{ $total_mahasiswa ? round(($mahasiswa_sedang_magang / $total_mahasiswa) * 100) : 0 }}% dari total semua mahasiswa"
            title="Mahasiswa Sedang Magang"
            total="{{ $mahasiswa_sedang_magang }}"
        />
        <x-info
            background="#fef5e6"
            color="#f59e0b"
            icon="fa-solid fa-user-check"
            info="{{ $total_mahasiswa ? round(($mahasiswa_selesai_magang / $total_mahasiswa) * 100) : 0 }}% dari total semua mahasiswa"
            title="Mahasiswa Sudah Magang"
            total="{{ $mahasiswa_selesai_magang }}"
        />
    </div>
</section>