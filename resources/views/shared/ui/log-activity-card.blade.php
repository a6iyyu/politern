<figure class="bg-white border border-[var(--stroke)] rounded-xl">
    <section class="cursor-default text-white text-xs font-semibold px-5 py-3 rounded-t-xl bg-[var(--primary)] lg:text-sm">
        {{ $judul }}
    </section>
    <section class="cursor-default p-5 text-xs lg:text-sm">
        <h5>
            Tanggal: <span class="font-semibold">{{ $tanggal }}</span>
        </h5>
        <h5 class="mt-3">Bukti Foto:</h5>
        <img src="{{ asset($gambar) ?? asset('shared/aktivitas.png') }}" alt="Bukti Foto" class="mt-3 w-full rounded" />
        <h5 class="mt-5">Deskripsi:</h5>
        <figcaption class="mt-2 font-semibold">
            {{ $deskripsi }}
        </figcaption>
        <h5 class="mt-3">
            Status:
            <span class="ml-2 font-semibold @if ($status === "DITERIMA") bg-emerald-500 text-white px-2 py-1 rounded @elseif ($status === "DITOLAK") bg-rose-500 text-white px-2 py-1 rounded @else bg-amber-500 text-white px-2 py-1 rounded @endif">
                {{ $status }}
            </span>
        </h5>
        <div class="flex justify-end">
            {{ $attributes }}
        </div>
    </section>
</figure>