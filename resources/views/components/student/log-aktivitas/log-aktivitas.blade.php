<section>
    <article class="max-h-[70vh] overflow-y-auto mt-10 pr-2">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-log-activity 
                judul="Minggu ke-1 : Pengenalan Perusahaan & Orientasi"
                tanggal="4 Mar 2025 – 10 Mar 2025"
                deskripsi="Mengikuti sesi orientasi dan pengenalan struktur organisasi perusahaan. Memahami visi, misi, serta alur kerja antar divisi."
                gambar="{{ asset('shared/aktivitas.png') }}"
                status="Diterima"
                detail-url="#"
                edit-url="#"
                hapus-url="#"
            />
            <x-log-activity 
                judul="Minggu ke-2 : Observasi Infrastruktur Jaringan"
                tanggal="11 Mar 2025 – 17 Mar 2025"
                deskripsi="Melakukan observasi terhadap infrastruktur jaringan internal, termasuk monitoring traffic dan pengenalan perangkat jaringan."
                gambar="{{ asset('shared/aktivitas.png') }}"
                status="Ditolak"
                detail-url="#"
                edit-url="#"
                hapus-url="#"
            />
            <x-log-activity 
                judul="Minggu ke-3 : Praktik Manajemen Server"
                tanggal="18 Mar 2025 – 24 Mar 2025"
                deskripsi="Belajar mengelola server backend dan melakukan konfigurasi dasar pada server menggunakan Linux. Praktik SSH dan hardening server."
                gambar="{{ asset('shared/aktivitas.png') }}"
                status="Menunggu"
                detail-url="#"
                edit-url="#"
                hapus-url="#"
            />
            <x-log-activity 
                judul="Minggu ke-4 : Pelatihan Teknologi Backend"
                tanggal="25 Mar 2025 – 31 Mar 2025"
                deskripsi="Mengikuti pelatihan teknologi backend yang digunakan perusahaan. Mempelajari arsitektur microservice dan teknologi deployment yang digunakan."
                gambar="{{ asset('shared/aktivitas.png') }}"
                status="Diterima"
                detail-url="#"
                edit-url="#"
                hapus-url="#"
            />
        </div>
    </article>
</section>
