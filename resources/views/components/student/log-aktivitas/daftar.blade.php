@php
    use Carbon\Carbon;
@endphp

<section class="flex flex-col justify-between mb-5 gap-4 lg:flex-row lg:items-center">
    <h2 class="cursor-default text-base font-semibold text-[var(--primary-text)]">
        Daftar Aktivitas Magang
    </h2>
    <button type="button" data-target="log-mahasiswa" class="open cursor-pointer w-fit text-sm bg-[var(--green-tertiary)] text-[var(--background)] font-medium px-5 py-2.5 rounded transition-all duration-300 ease-in-out lg:hover:bg-[#66c2a3]">
        Tambah Aktivitas
    </button>
</section>
@if (session('success'))
    <h5 class="mb-4 p-4 cursor-default rounded-lg bg-emerald-50 border border-emerald-500 list-disc list-inside text-sm text-emerald-500">
        {{ session('success') }}
    </h5>
@elseif ($errors->any())
    <ul class="mb-7 p-4 cursor-default rounded-lg bg-red-50 border border-red-500 list-disc list-inside text-sm text-red-500">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
@include('components.student.log-aktivitas.filter')
@if (!collect($log_aktivitas)->isEmpty())
    @foreach ($log_aktivitas as $aktivitas)
        <figure class="mb-6 rounded-lg border border-[var(--stroke)] bg-white overflow-hidden">
            <h3 class="text-sm py-4 px-6 rounded-t-lg bg-[var(--primary)] text-white">
                Minggu Ke-{{ $aktivitas->minggu }} : {{ $aktivitas->judul }}
            </h3>
            <section class="py-6 px-6">
                <div class="flex flex-col gap-5 justify-between mb-6 lg:items-start lg:flex-row">
                    <figcaption class="flex-1 lg:pr-6">
                        <h5 class="cursor-default text-sm text-[var(--secondary-text)] mb-5">
                            Tanggal :
                            <span class="font-medium text-[var(--primary-text)]">
                                {{ Carbon::parse($aktivitas->created_at)->format('d M Y') }}
                            </span>
                        </h5>
                        <h5 class="cursor-default text-justify text-sm text-[var(--secondary-text)]">
                            Deskripsi :
                            <span class="line-height-8 font-medium text-[var(--primary-text)] text-wrap">
                                {{ $aktivitas->deskripsi ?? 'Tidak ada deskripsi' }}
                            </span>
                        </h5>
                    </figcaption>
                    <figcaption class="flex-shrink-0 lg:ml-4">
                        <h5 class="cursor-default text-sm text-[var(--secondary-text)] mb-2">Bukti Foto :</h5>
                        <img
                            src="{{ file_exists(public_path(ltrim($aktivitas->foto, '/'))) ? asset($aktivitas->foto) : asset('shared/aktivitas.png') }}"
                            alt="Foto Aktivitas"
                            class="w-full max-h-32 object-cover rounded-lg"
                        />
                    </figcaption>
                </div>
                <div class="flex flex-col justify-between gap-3 items-start mt-4 text-xs lg:flex-row lg:items-center">
                    @if ($aktivitas->status === 'DISETUJUI')
                        <h6 class="cursor-pointer px-5 py-2 font-medium rounded-lg transition-all duration-300 ease-in-out border border-green-500 text-green-500 lg:hover:text-white lg:hover:bg-green-500">
                            Diterima
                        </h6>
                    @elseif ($aktivitas->status === 'DITOLAK')
                        <h6 class="cursor-pointer px-5 py-2 font-medium rounded-lg transition-all duration-300 ease-in-out border border-red-500 text-red-500 lg:hover:text-white lg:hover:bg-red-500">
                            Ditolak
                        </h6>
                    @elseif ($aktivitas->status === 'MENUNGGU')
                        <h6 class="cursor-pointer px-5 py-2 font-medium rounded-lg transition-all duration-300 ease-in-out border border-yellow-500 text-yellow-500 lg:hover:text-white lg:hover:bg-yellow-500">
                            Menunggu
                        </h6>
                    @else
                        <h6 class="cursor-pointer px-3 py-1 font-medium rounded-full transition-all duration-300 ease-in-out border border-gray-400 text-gray-400 lg:hover:text-white lg:hover:bg-gray-400">
                            {{ $aktivitas->status ?? 'Tidak Diketahui' }}
                        </h6>
                    @endif
                    <span class="flex justify-end gap-2">
                        <button type="button" class="log-detail cursor-pointer px-3 py.5-2 font-medium rounded-md transition-all duration-300 ease-in-out bg-blue-600 text-white lg:px-4 lg:hover:bg-blue-700" data-id="{{ $aktivitas->id_log }}">
                            <i class="fa-solid fa-circle-info lg:mr-2"></i>
                            <h5 class="hidden lg:inline">Detail</h5>
                        </button>
                        <button type="button" class="log-edit cursor-pointer px-3 py-2.5 font-medium rounded-md transition-all duration-300 ease-in-out bg-yellow-400 text-white lg:px-4 lg:hover:bg-yellow-500" data-id="{{ $aktivitas->id_log }}">
                            <i class="fa-solid fa-pencil lg:mr-2"></i>
                            <h5 class="hidden lg:inline">Edit</h5>
                        </button>
                        <form method="POST" action="{{ route('mahasiswa.log-aktivitas.hapus', $aktivitas->id_log) }}" onsubmit="return confirm('Yakin ingin menghapus log ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer px-3 py-2.5 font-medium rounded-md bg-red-500 text-white transition-all duration-300 ease-in-out lg:px-4 lg:hover:bg-red-600">
                                <i class="fa-solid fa-trash lg:mr-2"></i>
                                <h5 class="hidden lg:inline">Hapus</h5>
                            </button>
                        </form>
                    </span>
                </div>
                @if ($aktivitas->komentar && ($aktivitas->status === 'DITOLAK' || $aktivitas->status === 'DISETUJUI'))
                    <p class="mt-4 p-3 bg-gray-100 rounded-md text-sm text-gray-700">
                        <strong>Komentar:</strong> {{ $aktivitas->komentar }}
                    </p>
                @endif
                @if ($aktivitas->tanggal_evaluasi && $aktivitas->status === 'DISETUJUI')
                    <h5 class="mt-2 text-sm text-gray-600">
                        Tanggal Konfirmasi:
                        {{ Carbon::parse($aktivitas->tanggal_evaluasi)->format('d M Y H:i') }}
                    </h5>
                @endif
            </section>
        </figure>
    @endforeach
@else
    <section class="flex flex-col items-center justify-center my-20 cursor-default text-gray-400 gap-4">
        <i class="fa-solid fa-exclamation-triangle text-5xl"></i>
        <h5 class="text-sm">Maaf, Anda tidak memiliki data log aktivitas atau belum memiliki dosen pembimbing.</h5>
    </section>
@endif