<section class="w-full lg:w-2/3 pr-8">
    <div class="mb-6">
        <h3 class="font-semibold flex items-center gap-2 text-[#2D2D2D] mb-2">
            <span class="inline-block w-1.5 h-5 bg-[#5955B2] rounded-sm"></span>
            Deskripsi
        </h3>
        <p class="text-sm text-gray-700 ">
            {{ $lowongan->deskripsi ?? '-' }}
        </p>
    </div>
    <div class="mb-6">
        <h3 class="font-semibold flex items-center gap-2 text-[#2D2D2D] mb-2">
            <span class="inline-block w-1.5 h-5 bg-[#5955B2] rounded-sm"></span>
            Keahlian
        </h3>
        <div class="flex flex-wrap gap-4">
            @foreach($lowongan->keahlian as $skill)
                <span class="bg-[#E76BA2] text-white px-4 py-2 rounded-full text-sm text-center">
                    {{ $skill->nama_keahlian }}
                </span>
            @endforeach
        </div>
    </div>
    <div class="mb-6">
        <h3 class="font-semibold flex items-center gap-2 text-[#2D2D2D] mb-2">
            <span class="inline-block w-1.5 h-5 bg-[#5955B2] rounded-sm"></span>
            Durasi Magang
            <span class="text-pink-500 font-normal ml-1">- {{ $lowongan->durasi->nama_durasi ?? '-' }}</span>
        </h3>
        <div class="text-sm text-gray-700 flex items-center gap-2">
            Tanggal mulai - selesai:
            <span class="inline-flex items-center px-3 py-1 rounded-full border border-pink-400 text-pink-500 text-sm">
                {{ \Carbon\Carbon::parse($lowongan->tanggal_mulai_pendaftaran)->translatedFormat('d M Y') ?? '-' }}
            </span>
            -
            <span class="inline-flex items-center px-3 py-1 rounded-full border border-pink-400 text-pink-500 text-sm">
                {{ \Carbon\Carbon::parse($lowongan->tanggal_selesai_pendaftaran)->translatedFormat('d M Y') ?? '-' }}
            </span>
        </div>
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
                    {{ \Carbon\Carbon::parse($lowongan->tanggal_mulai_pendaftaran)->translatedFormat('d M Y') ?? '-' }}
                </span>
            </div>
            <div>
                Tanggal terakhir pendaftaran :
                <span class="text-[#5955B2] font-semibold ml-1">
                    {{ \Carbon\Carbon::parse($lowongan->tanggal_selesai_pendaftaran)->translatedFormat('d M Y') ?? '-' }}
                </span>
            </div>
        </div>
    </div>
</section>