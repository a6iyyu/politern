{{-- TODO: Memperbaiki relasi komentar di database dan menambahkannya pada komentar di tampilan. --}}

@php
    $info = [
        'DISETUJUI' => 'border border-green-500 text-green-500 hover:bg-green-500 hover:text-white',
        'DITOLAK'   => 'border border-red-500 text-red-500 hover:bg-red-500 hover:text-white',
        'MENUNGGU'  => 'border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-white',
    ];
@endphp

@if (isset($log_aktivitas) || !empty($log_aktivitas))
    @foreach ($log_aktivitas as $log)
        <figure class="border border-[var(--stroke)] p-6 rounded-lg mb-4">
            <section class="flex items-center justify-between text-xs">
                <span class="cursor-default flex items-center gap-4">
                    <h5>Minggu ke-{{ $log->minggu ?? "N/A" }}</h5>
                    <h5 class="bg-[var(--primary)] text-white px-4 py-2 rounded-full">
                        {{ $log->judul ?? "N/A" }}
                    </h5>
                </span>
                <span class="flex items-center gap-4 text-xs">
                    <h5 class="cursor-pointer px-4 py-2 rounded-2xl transition-all duration-300 ease-in-out {{ $info[$log->status] ?? 'border text-[var(--secondary-text)]' }}">
                        {{ ucfirst(strtolower($log->status)) }}
                    </h5>
                    <a
                        href="javascript:void(0)" 
                        data-target="log-dosen"
                        class="open border border-[var(--blue-tertiary)] text-[var(--blue-tertiary)] px-4 py-2 rounded-lg transition-all duration-300 ease-in-out lg:hover:bg-[var(--blue-tertiary)] lg:hover:text-[var(--background)]"
                        data-id="{{ $log->id_log }}"
                    >
                        Lihat Detail Aktivitas
                    </a>
                </span>
            </section>
            <section class="cursor-default mt-5">
                <h5 class="font-semibold text-sm text-[var(--secondary-text)]">Deskripsi:</h5>
                <h5 class="mt-1 text-xs text-[var(--primary-text)]">
                    {{ $log->deskripsi ?? "N/A" }}
                </h5>
                <h5 class="mt-4 font-semibold text-sm text-[var(--secondary-text)]">Bukti:</h5>
                @if($log->foto)
                    <a href="{{ asset($log->foto) }}" target="_blank" class="text-sm italic text-[var(--blue-tertiary)] underline">
                        Lihat Foto
                    </a>
                @else
                    <h6 class="mt-1 text-xs italic">Tidak ada foto.</h6>
                @endif
            </section>
            @if ($log->status === "DITOLAK")
                <section class="cursor-default mt-5 p-5 bg-[var(--stroke)] rounded-md">
                    <h5 class="font-semibold text-sm text-[var(--primary-text)]">
                        Komentar Dosen:
                    </h5>
                    <h6 class="mt-1.5 text-xs text-[var(--secondary-text)]">
                        {{ $log->magang->komentar ?? "N/A" }}
                    </h6>
                </section>
            @endif
        </figure>
    @endforeach
@else
    <section class="my-10 cursor-default flex flex-col items-center justify-center text-[var(--secondary-text)]">
        <i class="fa-solid fa-triangle-exclamation text-5xl"></i>
        <h5 class="mt-4">Tidak ada log aktivitas yang tercatat.</h5>
    </section>
@endif