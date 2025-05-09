<aside class="fixed pb-12 z-50 translate-x-0 left-0 top-0 h-full w-76 flex-col space-y-4 border-r-2 rounded-r-2xl border-[#6d6adc] p-6 shadow-2xl bg-[#5955b2] transition-all duration-300 ease-in-out">
    <section class="grid place-items-center"></section>
    <nav class="mb-4 mt-2 flex overflow-y-scroll h-full flex-1 flex-col gap-4">
        @if (Auth::check() && Auth::user()->tipe === 'ADMIN')
            <a href="{{ route('admin.dasbor') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('admin') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/75' }}">
                <img src="{{ Request::is('admin') ? asset('icons/dasbor-biru.svg') : asset('icons/dasbor-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Dasbor</h4>
            </a>
            <h4 class="cursor-default mb-1 mt-2 pl-5 text-sm tracking-wider text-[#f2f2f2]">Data Pengguna</h4>
            <a href="{{ route('admin.data-mahasiswa') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('admin/data-mahasiswa*') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/75' }}">
                <img src="{{ Request::is('admin/data-mahasiswa*') ? asset('icons/data-mahasiswa-biru.svg') : asset('icons/data-mahasiswa-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Data Mahasiswa</h4>
            </a>
            <a href="{{ route('admin.data-dosen') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('admin/data-dosen*') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/75' }}">
                <img src="{{ Request::is('admin/data-dosen*') ? asset('icons/data-dosen-biru.svg') : asset('icons/data-dosen-putih.svg') }}" alt="Dasbor" class="h-4 w-4" />
                <h4 class="ml-8 text-sm tracking-wider">Data Dosen</h4>
            </a>
            <h4 class="cursor-default mb-1 mt-2 pl-5 text-sm tracking-wider text-[#f2f2f2]">Data Perusahaan</h4>
            <a href="{{ route('admin.data-perusahaan') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('admin/data-perusahaan*') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/75' }}">
                <img src="{{ Request::is('admin/data-perusahaan*') ? asset('icons/data-perusahaan-biru.svg') : asset('icons/data-perusahaan-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Data Perusahaan</h4>
            </a>
            <h4 class="cursor-default mb-1 mt-2 pl-5 text-sm tracking-wider text-[#f2f2f2]">Data Magang</h4>
            <a href="{{ route('admin.periode-magang') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('admin/periode-magang*') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/75' }}">
                <img src="{{ Request::is('admin/periode-magang*') ? asset('icons/periode-magang-biru.svg') : asset('icons/periode-magang-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Periode Magang</h4>
            </a>
            <a href="{{ route('admin.lowongan-magang') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('admin/lowongan-magang*') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/75' }}">
                <img src="{{ Request::is('admin/lowongan-magang*') ? asset('icons/lowongan-magang-biru.svg') : asset('icons/lowongan-magang-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Lowongan Magang</h4>
            </a>
            <a href="{{ route('admin.pengajuan-magang') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('admin/pengajuan-magang*') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/75' }}">
                <img src="{{ Request::is('admin/pengajuan-magang*') ? asset('icons/pengajuan-magang-biru.svg') : asset('icons/pengajuan-magang-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Pengajuan Magang</h4>
            </a>
        @endif
        @if (Auth::check() && Auth::user()->tipe === 'MAHASISWA')
            <a href="{{ route('mahasiswa.dasbor') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('mahasiswa') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/50' }}">
                <img src="{{ Request::is('mahasiswa') ? asset('icons/dasbor-biru.svg') : asset('icons/dasbor-putih.svg') }}" alt="Dasbor" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Dasbor</h4>
            </a>
            <a href="{{ route('mahasiswa.lowongan') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('mahasiswa/lowongan*') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/50' }}">
                <img src="{{ Request::is('mahasiswa/lowongan*') ? asset('icons/lowongan-biru.svg') : asset('icons/lowongan-putih.svg') }}" alt="Lowongan" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Lowongan</h4>
            </a>
            <a href="{{ route('mahasiswa.kelola-lamaran') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('mahasiswa/kelola-lamaran*') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/50' }}">
                <img src="{{ Request::is('mahasiswa/kelola-lamaran*') ? asset('icons/kelola-lamaran-biru.svg') : asset('icons/kelola-lamaran-putih.svg') }}" alt="Kelola Lamaran" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Kelola Lamaran</h4>
            </a>
            <a href="{{ route('mahasiswa.log-aktivitas') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('mahasiswa/log-aktivitas*') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/50' }}">
                <img src="{{ Request::is('mahasiswa/log-aktivitas*') ? asset('icons/log-aktivitas-biru.svg') : asset('icons/log-aktivitas-putih.svg') }}" alt="Log Aktivitas" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Log Aktivitas</h4>
            </a>
        @endif
    </nav>
</aside>