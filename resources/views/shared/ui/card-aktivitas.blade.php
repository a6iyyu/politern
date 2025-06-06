<figure class="border border-[var(--stroke)] px-6 py-4 rounded-lg mb-4">
    <section class="flex items-center justify-between text-xs">
        <span class="cursor-default flex items-center gap-5 text-sm text-[var(--primary)] font-semibold">
            <h5>Minggu ke-{{ $minggu ?? "N/A" }}</h5>
            <h5 class="bg-[var(--primary)] text-xs text-white font-medium px-5 py-2 rounded-full">
                {{ $judul ?? "N/A" }}
            </h5>
        </span>
        <span class="flex items-center gap-4 text-xs">
            <h5 class="cursor-pointer px-4 py-2 rounded-2xl transition-all duration-300 ease-in-out {{ $info[$status] ?? 'border text-[var(--secondary-text)]' }}">
                {{ $status === 'DIKONFIRMASI' ? 'Dikonfirmasi' : ucfirst(strtolower($status)) }}
            </h5>
            <a
                href="javascript:void(0)" 
                data-target="log-dosen"
                class="open border border-[var(--blue-tertiary)] text-[var(--blue-tertiary)] px-4 py-2 rounded-lg transition-all duration-300 ease-in-out lg:hover:bg-[var(--blue-tertiary)] lg:hover:text-[var(--background)]"
                data-id="{{ $id_log }}"
            >
                Lihat Detail Aktivitas
            </a>
        </span>
    </section>
    
    <section class="cursor-default mt-5">
        <div class="flex items-center gap-3 mb-5 text-sm text-[var(--primary)]">
            <img src="{{ asset($foto_profil) }}" alt="Profile" class="w-10 h-10 rounded-full object-cover">
            <div class="flex gap-4 items-end">
                <h5 class="font-medium">{{ $nama ?? "N/A" }}</h5>
                <h6>{{ $nim ?? "N/A" }}</h6>
            </div>
        </div>
        
        <div class="flex gap-2 mt-5">
            <h5 class="text-sm text-[var(--secondary-text)]">Deskripsi:</h5>
            <h5 class="text-sm text-[var(--primary-text)] font-medium leading-relaxed max-w-[60%]">
                {{ $deskripsi ?? "N/A" }}
            </h5>
        </div>
        
        <div class="flex gap-2 mt-5">
            <h5 class="text-sm text-[var(--secondary-text)]">Bukti Foto:</h5>
            @if($foto)
                <a href="{{ asset($foto) }}" target="_blank" class="text-sm text-[var(--secondary)] font-medium underline hover:text-[var(--primary)] transition-colors">
                    {{ basename($foto) }}
                </a>
            @else
                <h6 class="text-xs text-[var(--secondary-text)] px-4 py-1 rounded-full bg-[var(--stroke)]">Tidak ada foto.</h6>
            @endif
        </div>
    </section>
    
    @if ($status === "DITOLAK" || $status === "DISETUJUI")
        <section class="cursor-default mt-5 px-6 py-4 bg-[#f3f3f3] rounded-md">
            <h5 class="text-sm text-[var(--primary-text)]">
                Komentar Dosen:
            </h5>
            <h6 class="mt-2 text-sm text-[var(--primary-text)] font-medium leading-relaxed">
                {{ $komentar ?? "N/A" }}
            </h6>
        </section>
    @endif
    
    @php 
    use Carbon\Carbon;
    
    $tanggal_evaluasi = $tanggal_evaluasi ?? Carbon::now()->format('d/m/Y');
    @endphp
    <div class="mt-2 text-right">
        <span class="text-xs text-[var(--secondary-text)]">        
            Dikonfirmasi Pada: {{ $tanggal_evaluasi }}
        </span>
    </div>
</figure>