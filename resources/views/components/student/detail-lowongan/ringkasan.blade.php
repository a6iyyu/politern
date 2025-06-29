<figure class="cursor-default border rounded-xl p-6 border-[var(--primary)] bg-white shadow-sm">
    <div class="flex items-center gap-3 mb-4">
        <img src="{{ asset($lowongan->perusahaan->logo ?? 'img/default-logo.png') }}" alt="Logo" class="hidden h-12 w-12 rounded-md object-cover lg:inline">
        <span>
            <h4 class="font-semibold text-primary text-[var(--primary)] leading-tight mb-1">
                {{ $lowongan->bidang->nama_bidang ?? '-' }}
            </h4>
            <h5 class="text-sm text-[#2D2D2D]">{{ $lowongan->perusahaan->nama ?? '-' }}</h5>
        </span>
    </div>
    <h5 class="inline-block px-5 py-2 mb-4 rounded-lg  text-white text-xs" style="background:#10B981;">
        {{ $lowongan->status == 'DIBUKA' ? 'Dibuka' : 'Ditutup' }}
    </h5>
    <ul class="mb-4 text-sm text-gray-700 space-y-2">
        <li class="flex items-center gap-2">
            <i class="fa fa-map-marker-alt text-[#2D2D2D] w-5"></i>
            <span class="ml-1">{{ $lowongan->perusahaan->lokasi->nama_lokasi ?? '-' }}</span>
        </li>
        <li class="flex items-center gap-2">
            <i class="fa fa-users text-[#2D2D2D] w-5"></i>
            <span class="ml-1">Kuota: {{ $lowongan->kuota ?? '-' }} orang</span>
        </li>
        <li class="flex items-center gap-2">
            <i class="fa fa-money-bill text-[#2D2D2D] w-5"></i>
            <span class="ml-1">Gaji: {{ $lowongan->gaji ?? '-' }}</span>
        </li>
    </ul>
    <h5 class="inline-block px-4 py-2 bg-[#FBECF1] text-[#2D2D2D] rounded-full text-xs font-semibold mb-3">
        {{ $lowongan->jenis_lokasi->nama_jenis_lokasi ?? '-' }}
    </h5>
    <h5 class="text-xs text-[#2D2D2D] mb-5">
        Diposting {{ \Carbon\Carbon::parse($lowongan->created_at)->translatedFormat('d F Y') ?? '-' }}
    </h5>
    <span class="grid grid-cols-1 gap-2 text-sm sm:grid-cols-2">
        @if ($lowongan->status == 'DIBUKA' && $lowongan->kuota > 0)
            <a href="javascript:void(0)" data-id="{{ $lowongan->id_lowongan }}" class="apply text-center bg-pink-400 text-white py-2 rounded-lg font-semibold transition-all duration-300 ease-in-out lg:hover:bg-pink-500">
                Ajukan
            </a>
        @else
            <button class="border-1 rounded-lg font-semibold py-2 text-center transition border-gray-300 text-gray-500 bg-white cursor-not-allowed">
                Kuota Penuh
            </button>
        @endif
        <a href="{{ route('mahasiswa.lowongan') }}" class="border-1 rounded-lg font-semibold py-2 text-center transition border-[var(--primary)] text-[var(--primary)] bg-white lg:hover:bg-[var(--primary)] lg:hover:text-white">
            Kembali 
        </a>
    </span>
</figure>