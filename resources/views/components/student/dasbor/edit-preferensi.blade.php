@extends('layouts.main')

@section('judul')
    Edit Preferensi Magang
@endsection

@section('deskripsi')
@endsection

@php
    $fields = [
        'bidang' => [
            'label' => 'Bidang yang diminati',
            'items' => $data['bidang_all'],
            'key' => 'id_bidang',
            'name' => 'nama_bidang',
        ],
        'keahlian' => [
            'label' => 'Keahlian',
            'items' => $data['keahlian_all'],
            'key' => 'id_keahlian',
            'name' => 'nama_keahlian',
        ],
        'lokasi' => [
            'label' => 'Lokasi yang diinginkan',
            'items' => $data['lokasi_all'],
            'key' => 'id_lokasi',
            'name' => 'nama_lokasi',
        ],
        'jenis_lokasi' => [
            'label' => 'Jenis Lokasi',
            'items' => $data['jenis_lokasi_all'],
            'key' => 'id_jenis_lokasi',
            'name' => 'nama_jenis_lokasi',
        ],
        'durasi' => [
            'label' => 'Durasi Magang',
            'items' => $data['durasi_all'],
            'key' => 'id_durasi_magang',
            'name' => 'nama_durasi',
        ],
    ];
@endphp

@section('konten')
    <x-header title="Edit Preferensi Magang" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <form action="{{ route('mahasiswa.preferensi.perbarui') }}" method="POST"
            class="mt-6 bg-white p-8 shadow-md rounded-xl border border-[var(--stroke)]">
            @csrf
            @method('POST')
            <h2 class="text-lg font-semibold text-[var(--primary)] mb-4">Edit Preferensi Magang</h2>
            <hr class="mb-6 border border-[var(--primary)]" />
            <div class="flex flex-col gap-6">
                @foreach ($fields as $field => $meta)
                    <section>
                        <label class="block text-sm font-medium text-[var(--primary)] mb-2">
                            {{ $meta['label'] }}
                        </label>
                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 p-4 border border-[var(--stroke)] rounded-lg bg-gray-50 {{ in_array($field, ['bidang', 'keahlian', 'lokasi']) ? 'max-h-48 overflow-y-auto' : '' }}">
                            @foreach ($meta['items'] as $item)
                                <label
                                    class="flex items-center space-x-2 cursor-pointer hover:bg-white p-2 rounded transition-colors">
                                    <input type="checkbox" name="{{ $field }}[]" value="{{ $item[$meta['key']] }}"
                                        class="w-4 h-4 text-[var(--primary)] border-gray-300 rounded focus:ring-[var(--primary)] focus:ring-2"
                                        @if (in_array($item[$meta['key']], $preferensi[$field])) checked @endif>
                                    <span class="text-sm text-gray-700">{{ $item[$meta['name']] }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-500 mt-1">
                            Pilih {{ str_replace('_', ' ', $field) }} yang
                            {{ $field === 'keahlian' ? 'dikuasai' : 'diinginkan' }}
                        </p>
                    </section>
                @endforeach
            </div>
            <!-- Preferensi Gaji -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-[var(--primary)] mb-2">
                    Preferensi Gaji
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 p-4 border border-[var(--stroke)] rounded-lg bg-gray-50">
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-white p-2 rounded transition-colors">
                        <input type="radio" name="gaji" value="PAID"
                            class="w-4 h-4 text-[var(--primary)] border-gray-300 focus:ring-[var(--primary)] focus:ring-2"
                            @if (isset($mahasiswa) && $mahasiswa->gaji === 'PAID') checked @endif>
                        <span class="text-sm text-gray-700">PAID</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer hover:bg-white p-2 rounded transition-colors">
                        <input type="radio" name="gaji" value="UNPAID"
                            class="w-4 h-4 text-[var(--primary)] border-gray-300 focus:ring-[var(--primary)] focus:ring-2"
                            @if (isset($mahasiswa) && $mahasiswa->gaji === 'UNPAID') checked @endif>
                        <span class="text-sm text-gray-700">UNPAID</span>
                    </label>
                </div>
                <p class="text-xs text-gray-500 mt-1">Pilih preferensi gaji yang diinginkan</p>
            </div>
            <span class="flex justify-end mt-8">
                <button type="submit"
                    class="cursor-pointer bg-[var(--primary)] text-white px-6 py-3 rounded-md text-sm hover:bg-[#5955b2]/90 transition-all duration-300">
                    Simpan Preferensi
                </button>
            </span>
        </form>
    </main>
@endsection