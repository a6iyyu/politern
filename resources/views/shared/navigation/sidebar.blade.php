<aside class="fixed z-30 hidden h-full flex-col space-y-4 rounded-r-2xl p-6 shadow-2xl bg-[#5955b2] transition-all duration-300 ease-in-out lg:flex">
    <section></section>
    <nav class="mt-2 flex h-full flex-1 flex-col gap-4">
        @if (Auth::check() && Auth::user()->tipe === 'ADMIN')
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
            <a href="{{ route('mahasiswa.akademik') }}" class="flex items-center font-semibold pl-5 pr-7 py-3 {{ Request::is('mahasiswa/akademik*') ? 'bg-white rounded-lg text-[#5955b2]' : 'text-white/50' }}">
                <img src="{{ Request::is('mahasiswa/akademik*') ? asset('icons/akademik-biru.svg') : asset('icons/akademik-putih.svg') }}" alt="Akademik" class="h-5 w-5" />
                <h4 class="ml-7 text-sm tracking-wider">Akademik</h4>
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