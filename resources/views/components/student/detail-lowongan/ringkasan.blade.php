<section class="w-full lg:w-[500px]">
    <div class="border rounded-xl p-6 bg-white shadow-sm" style="border-color: #5955B2;">
        <div class="flex items-center gap-3 mb-4">
            <img src="{{ asset($lowongan->perusahaan->logo ?? 'img/default-logo.png') }}" alt="Logo" class="w-12 h-12 rounded-md object-cover">
            <div>
                <h4 class="font-semibold text-primary text-[#5955B2] leading-tight mb-1">
                    {{ $lowongan->bidang->nama_bidang ?? '-' }}
                </h4>
                <div class="text-sm text-[#2D2D2D]">{{ $lowongan->perusahaan->nama ?? '-' }}</div>
            </div>
        </div>
        <span class="inline-block px-3 py-2 mb-4 rounded-lg  text-white text-sm" style="background:#10B981;">
            {{ $lowongan->status == 'DIBUKA' ? 'Dibuka' : 'Ditutup' }}
        </span>
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
        <span class="inline-block px-4 py-2 bg-[#FBECF1] text-[#2D2D2D] rounded-full text-xs font-semibold mb-3">
            {{ $lowongan->jenis_lokasi->nama_jenis_lokasi ?? '-' }}
        </span>
        <div class="text-xs text-[#2D2D2D] mb-5">
            Diposting {{ \Carbon\Carbon::parse($lowongan->created_at)->translatedFormat('d F Y') ?? '-' }}
        </div>
        <div class="flex gap-2">
            <button class="flex-1 bg-pink-400 text-white py-2 rounded-lg font-semibold hover:bg-pink-500 transition">Ajukan</button>
            <a href="{{ route('mahasiswa.lowongan') }}"
               class="flex-1 border-1 rounded-lg font-semibold py-2 text-center transition
                      border-[#5955B2] text-[#5955B2] bg-white
                      hover:bg-[#5955B2] hover:text-white">
                Keluar
            </a>
        </div>
    </div>
</section>