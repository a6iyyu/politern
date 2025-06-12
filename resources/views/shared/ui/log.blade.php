@php
@endphp

<figure class="border border-[var(--stroke)] px-6 py-4 rounded-lg mb-4">
    <section class="flex flex-col gap-4 justify-between text-xs lg:items-center lg:flex-row">
        <span class="cursor-default flex items-center gap-5 text-sm text-[var(--primary)] font-semibold">
            <h5>Minggu ke-{{ $week ?? 'N/A' }}</h5>
            <h5 class="bg-[var(--primary)] text-xs text-white font-medium px-5 py-2 rounded-full">
                {{ $title ?? 'N/A' }}
            </h5>
        </span>
        <span class="flex items-center gap-4 text-xs">
            <h5 class="cursor-pointer px-4 py-2 rounded-2xl transition-all duration-300 ease-in-out {{ $status() }}">
                {{ $format() }}
            </h5>
            <a
                href="javascript:void(0)"
                data-target="log-dosen"
                class="open border border-[var(--blue-tertiary)] text-[var(--blue-tertiary)] px-4 py-2 rounded-lg transition-all duration-300 ease-in-out lg:hover:bg-[var(--blue-tertiary)] lg:hover:text-[var(--background)]"
                data-id="{{ $id }}"
            >
                Lihat Detail Aktivitas
            </a>
        </span>
    </section>
    <section class="cursor-default mt-5">
        <div class="flex items-center gap-3 mb-5 text-sm text-[var(--primary)]">
            <img src="{{ $profile_photo }}" alt="Profil" class="w-10 h-10 rounded-full object-cover">
            <span class="flex gap-4 items-end">
                <h5 class="font-medium">{{ $name ?? 'N/A' }}</h5>
                <h6>{{ $nim ?? 'N/A' }}</h6>    
            </span>
        </div>
        <div class="flex text-sm gap-2 mt-5">
            <h5 class="text-[var(--secondary-text)]">Deskripsi:</h5>
            <h5 class="text-[var(--primary-text)] font-medium leading-relaxed max-w-3/4">
                {{ $description ?? 'N/A' }}. 
            </h5>
        </div>
        <div class="flex gap-2 mt-5">
            <h5 class="text-sm text-[var(--secondary-text)]">Bukti Foto:</h5>
            @if ($photo)
                <a href="{{ asset($photo) }}" target="_blank" class="text-sm text-[var(--secondary)] font-medium underline hover:text-[var(--primary)] transition-colors">
                    {{ basename($photo) }}
                </a>
            @else
                <h6 class="text-xs text-[var(--secondary-text)] px-4 py-1 rounded-full bg-[var(--stroke)]">
                    Tidak ada foto.
                </h6>
            @endif
        </div>
    </section>
    @if (in_array(strtoupper($statusStr ?? ''), ['DITOLAK', 'DISETUJUI']))
        <section class="cursor-default mt-5 px-6 py-4 bg-[#f3f3f3] rounded-md">
            <h5 class="text-sm text-[var(--primary-text)]">
                Komentar Dosen:
            </h5>
            <h6 class="mt-2 text-sm text-[var(--primary-text)] font-medium leading-relaxed">
                {{ $comment ?? '--Tidak ada Komentar--' }}
            </h6>
        </section>
        <div class="mt-2 text-right">
            <span class="text-xs text-[var(--secondary-text)]">
                Dikonfirmasi Pada: {{ $confirmation_date ?? 'N/A' }}
            </span>
        </div>
    @endif
</figure>