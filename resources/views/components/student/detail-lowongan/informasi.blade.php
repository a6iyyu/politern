@php
    use Carbon\Carbon;
@endphp

<section class="cursor-default text-sm w-full">
    <h3 class="font-semibold flex items-center gap-2 text-[#2D2D2D] mb-2">
        <span class="inline-block w-1.5 h-5 bg-[#5955B2] rounded-sm"></span>
        Deskripsi
    </h3>
    <h5 class="mb-6 text-sm text-gray-700 ">
        {!! $lowongan->deskripsi ?? '-' !!}
    </h5>
    <h3 class="font-semibold flex items-center gap-2 text-[#2D2D2D] mb-2">
        <span class="inline-block w-1.5 h-5 bg-[#5955B2] rounded-sm"></span>
        Keahlian
    </h3>
    <ul class="mb-6 flex flex-wrap gap-4">
        @foreach ($lowongan->keahlian as $skill)
            <li class="cursor-pointer bg-[var(--primary)] text-white px-4.5 py-1.5 rounded-full transition-all duration-300 ease-in-out text-sm text-center lg:hover:bg-[var(--primary)]/80">
                {{ $skill->nama_keahlian }}
            </li>
        @endforeach
    </ul>
    <h3 class="font-semibold flex items-center gap-2 text-[#2D2D2D] mb-2">
        <span class="inline-block w-1.5 h-5 bg-[#5955B2] rounded-sm"></span>
        Durasi Magang
        <span class="text-pink-500 font-normal ml-1">{{ $lowongan->durasi->nama_durasi ?? '-' }}</span>
    </h3>
    <div class="mb-6 text-sm text-gray-700 flex flex-col gap-2">
        Tanggal mulai - selesai:
        <span class="flex items-center gap-3">
            <h5 class="cursor-pointer w-fit px-4 py-1 rounded-full border border-pink-400 text-pink-500 transition-all duration-300 ease-in-out text-sm lg:hover:bg-pink-400 lg:hover:text-white">
                {{ Carbon::parse($lowongan->tanggal_mulai_pendaftaran)->translatedFormat('d M Y') ?? '-' }}
            </h5>
            -
            <h5 class="cursor-pointer w-fit px-3 py-1 rounded-full border border-pink-400 text-pink-500 transition-all duration-300 ease-in-out text-sm lg:hover:bg-pink-400 lg:hover:text-white">
                {{ Carbon::parse($lowongan->tanggal_selesai_pendaftaran)->translatedFormat('d M Y') ?? '-' }}
            </h5>
        </span>
    </div>
    <div>
        <h3 class="font-semibold flex items-center gap-2 text-[#2D2D2D] mb-2">
            <span class="inline-block w-1.5 h-5 bg-[#5955B2] rounded-sm"></span>
            Waktu Pendaftaran
        </h3>
        <div class="text-sm text-gray-700 space-y-1">
            <div>
                Tanggal mulai pendaftaran :
                <span class="text-[#5955B2] font-semibold ml-1">
                    {{ Carbon::parse($lowongan->tanggal_mulai_pendaftaran)->translatedFormat('d M Y') ?? '-' }}
                </span>
            </div>
            <div>
                Tanggal terakhir pendaftaran :
                <span class="text-[#5955B2] font-semibold ml-1">
                    {{ Carbon::parse($lowongan->tanggal_selesai_pendaftaran)->translatedFormat('d M Y') ?? '-' }}
                </span>
            </div>
        </div>
    </div>
</section>