<aside class="fixed pb-12 z-50 translate-x-0 left-0 top-0 h-full w-76 flex-col space-y-4 border-r-2 border-[#6d6adc] p-5 shadow-2xl bg-[var(--primary)] transition-all duration-300 ease-in-out">
    <section class="mb-5 flex items-center">
        <img src="{{ asset('shared/logo.png') }}" alt="Logo" class="w-14" />
        <div class="cursor-default flex flex-col justify-between text-[var(--stroke)]">
            <h4 class="font-bold text-sm lg:text-base">POLITERN</h4>
            <h6 class="font-medium italic text-xs">Polinema Intern</h6>
        </div>
    </section>
    <nav class="flex overflow-y-scroll h-full pb-20 flex-1 flex-col gap-1">
        @if (Auth::check() && Auth::user()->tipe === 'ADMIN')
            <a href="{{ route('admin.dasbor') }}" class="mb-4 flex items-center pl-5 pr-7 py-3 {{ Request::is('admin') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('admin') ? asset('icons/dasbor-biru.svg') : asset('icons/dasbor-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Dasbor</h4>
            </a>
            <h4 class="cursor-default mb-1 mt-2 pl-5 text-sm tracking-wider text-white/80 font-light">Akademik</h4>
            <a href="{{ route('admin.data-mahasiswa') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('admin/data-mahasiswa*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('admin/data-mahasiswa*') ? asset('icons/data-mahasiswa-biru.svg') : asset('icons/data-mahasiswa-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Data Mahasiswa</h4>
            </a>
            <a href="{{ route('admin.data-dosen') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('admin/data-dosen*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('admin/data-dosen*') ? asset('icons/data-dosen-biru.svg') : asset('icons/data-dosen-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-8 text-sm tracking-wider">Data Dosen</h4>
            </a>
            <a href="{{ route('admin.data-prodi') }}" class="mb-4 flex items-center pl-5 pr-7 py-3 {{ Request::is('admin/data-prodi*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('admin/data-prodi*') ? asset('icons/data-prodi-biru.svg') : asset('icons/data-prodi-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-8 text-sm tracking-wider">Data Program Studi</h4>
            </a>
            <h4 class="cursor-default mb-1 mt-2 pl-5 text-sm tracking-wider text-white/80 font-light">Data Perusahaan</h4>
            <a href="{{ route('admin.data-perusahaan') }}" class="mb-4 flex items-center pl-5 pr-7 py-3 {{ Request::is('admin/data-perusahaan*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('admin/data-perusahaan*') ? asset('icons/data-perusahaan-biru.svg') : asset('icons/data-perusahaan-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Data Perusahaan</h4>
            </a>
            <h4 class="cursor-default mb-1 mt-2 pl-5 text-sm tracking-wider text-white/80 font-light">Data Magang</h4>
            <a href="{{ route('admin.periode-magang') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('admin/periode-magang*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('admin/periode-magang*') ? asset('icons/periode-magang-biru.svg') : asset('icons/periode-magang-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Periode Magang</h4>
            </a>
            <a href="{{ route('admin.lowongan-magang') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('admin/lowongan-magang*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('admin/lowongan-magang*') ? asset('icons/lowongan-magang-biru.svg') : asset('icons/lowongan-magang-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Lowongan Magang</h4>
            </a>
            <a href="{{ route('admin.pengajuan-magang') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('admin/pengajuan-magang*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('admin/pengajuan-magang*') ? asset('icons/pengajuan-magang-biru.svg') : asset('icons/pengajuan-magang-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Pengajuan Magang</h4>
            </a>
            <a href="{{ route('admin.aktivitas-magang') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('admin/aktivitas-magang*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('admin/aktivitas-magang*') ? asset('icons/aktivitas-magang-biru.svg') : asset('icons/aktivitas-magang-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Aktivitas Magang</h4>
            </a>
        @endif
        @if (Auth::check() && Auth::user()->tipe === 'MAHASISWA')
            <a href="{{ route('mahasiswa.dasbor') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('mahasiswa') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('mahasiswa') ? asset('icons/dasbor-biru.svg') : asset('icons/dasbor-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Dasbor</h4>
            </a>
            <a href="{{ route('mahasiswa.lowongan') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('mahasiswa/lowongan*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('mahasiswa/lowongan*') ? asset('icons/lowongan-biru.svg') : asset('icons/lowongan-putih.svg') }}" alt="Lowongan" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Lowongan</h4>
            </a>
            <a href="{{ route('mahasiswa.kelola-lamaran') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('mahasiswa/kelola-lamaran*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('mahasiswa/kelola-lamaran*') ? asset('icons/kelola-lamaran-biru.svg') : asset('icons/kelola-lamaran-putih.svg') }}" alt="Kelola Lamaran" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Kelola Lamaran</h4>
            </a>
            <a href="{{ route('mahasiswa.log-aktivitas') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('mahasiswa/log-aktivitas*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('mahasiswa/log-aktivitas*') ? asset('icons/log-aktivitas-biru.svg') : asset('icons/log-aktivitas-putih.svg') }}" alt="Log Aktivitas" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Log Aktivitas</h4>
            </a>
        @endif
        @if (Auth::check() && Auth::user()->tipe === 'DOSEN')
            <a href="{{ route('dosen.dasbor') }}" class="mb-4 flex items-center pl-5 pr-7 py-3 {{ Request::is('dosen') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('dosen') ? asset('icons/dasbor-biru.svg') : asset('icons/dasbor-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Dasbor</h4>
            </a>
            <h4 class="cursor-default mb-1 mt-2 pl-5 text-sm tracking-wider text-white/80 font-light">Manajemen Magang</h4>
            <a href="{{ route('dosen.data-mahasiswa') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('dosen/data-mahasiswa*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('dosen/data-mahasiswa*') ? asset('icons/data-mahasiswa-biru.svg') : asset('icons/data-mahasiswa-putih.svg') }}" alt="Data Mahasiswa" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Mahasiswa Bimbingan</h4>
            </a>
            <a href="{{ route('dosen.log-aktivitas') }}" class="flex items-center pl-5 pr-7 py-3 {{ Request::is('dosen/log-aktivitas*') ? 'bg-white rounded-lg text-[var(--primary)] font-medium' : 'text-white' }}">
                <img src="{{ Request::is('dosen/log-aktivitas*') ? asset('icons/log-aktivitas-biru.svg') : asset('icons/log-aktivitas-putih.svg') }}" alt="Log Aktivitas" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Log Aktivitas</h4>
            </a>
        @endif
    </nav>
</aside>