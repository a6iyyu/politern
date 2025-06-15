@extends('layouts.main')

@section('judul')
@endsection

@section('deskripsi')
@endsection

@section('konten')
    <x-header title="Edit Preferensi Magang" />

    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="max-w-4xl mx-auto w-full">
            <form action="{{ route('mahasiswa.preferensi.update') }}" method="POST"
                class="mt-6 bg-white p-8 shadow-md rounded-xl border border-[var(--stroke)]">
                @csrf

                <h2 class="text-lg font-semibold text-[var(--primary)] mb-4">Edit Preferensi Magang</h2>
                <hr class="mb-6 border border-[var(--primary)]" />

                <div class="flex flex-col gap-6">

                    <!-- Bidang -->
                    <div>
                        <label class="block text-sm font-medium text-[var(--primary)] mb-2">
                            Bidang yang diminati
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 p-4 border border-[var(--stroke)] rounded-lg bg-gray-50 max-h-48 overflow-y-auto">
                            @foreach ($data['bidang_all'] as $item)
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-white p-2 rounded transition-colors">
                                    <input type="checkbox" 
                                           name="bidang[]" 
                                           value="{{ $item->id_bidang }}" 
                                           class="w-4 h-4 text-[var(--primary)] border-gray-300 rounded focus:ring-[var(--primary)] focus:ring-2"
                                           @if(in_array($item->id_bidang, $preferensi['bidang'])) checked @endif>
                                    <span class="text-sm text-gray-700">{{ $item->nama_bidang }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Pilih satu atau lebih bidang yang diminati</p>
                    </div>

                    <!-- Keahlian -->
                    <div>
                        <label class="block text-sm font-medium text-[var(--primary)] mb-2">
                            Keahlian
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 p-4 border border-[var(--stroke)] rounded-lg bg-gray-50 max-h-48 overflow-y-auto">
                            @foreach ($data['keahlian_all'] as $item)
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-white p-2 rounded transition-colors">
                                    <input type="checkbox" 
                                           name="keahlian[]" 
                                           value="{{ $item->id_keahlian }}" 
                                           class="w-4 h-4 text-[var(--primary)] border-gray-300 rounded focus:ring-[var(--primary)] focus:ring-2"
                                           @if(in_array($item->id_keahlian, $preferensi['keahlian'])) checked @endif>
                                    <span class="text-sm text-gray-700">{{ $item->nama_keahlian }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Pilih satu atau lebih keahlian yang dikuasai</p>
                    </div>

                    <!-- Lokasi -->
                    <div>
                        <label class="block text-sm font-medium text-[var(--primary)] mb-2">
                            Lokasi yang diinginkan
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 p-4 border border-[var(--stroke)] rounded-lg bg-gray-50 max-h-48 overflow-y-auto">
                            @foreach ($data['lokasi_all'] as $item)
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-white p-2 rounded transition-colors">
                                    <input type="checkbox" 
                                           name="lokasi[]" 
                                           value="{{ $item->id_lokasi }}" 
                                           class="w-4 h-4 text-[var(--primary)] border-gray-300 rounded focus:ring-[var(--primary)] focus:ring-2"
                                           @if(in_array($item->id_lokasi, $preferensi['lokasi'])) checked @endif>
                                    <span class="text-sm text-gray-700">{{ $item->nama_lokasi }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Pilih satu atau lebih lokasi yang diinginkan</p>
                    </div>

                    <!-- Jenis Lokasi -->
                    <div>
                        <label class="block text-sm font-medium text-[var(--primary)] mb-2">
                            Jenis Lokasi
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 p-4 border border-[var(--stroke)] rounded-lg bg-gray-50">
                            @foreach ($data['jenis_lokasi_all'] as $item)
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-white p-2 rounded transition-colors">
                                    <input type="checkbox" 
                                           name="jenis_lokasi[]" 
                                           value="{{ $item->id_jenis_lokasi }}" 
                                           class="w-4 h-4 text-[var(--primary)] border-gray-300 rounded focus:ring-[var(--primary)] focus:ring-2"
                                           @if(in_array($item->id_jenis_lokasi, $preferensi['jenis_lokasi'])) checked @endif>
                                    <span class="text-sm text-gray-700">{{ $item->nama_jenis_lokasi }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Pilih jenis lokasi yang diinginkan</p>
                    </div>

                    <!-- Durasi -->
                    <div>
                        <label class="block text-sm font-medium text-[var(--primary)] mb-2">
                            Durasi Magang
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 p-4 border border-[var(--stroke)] rounded-lg bg-gray-50">
                            @foreach ($data['durasi_all'] as $item)
                                <label class="flex items-center space-x-2 cursor-pointer hover:bg-white p-2 rounded transition-colors">
                                    <input type="checkbox" 
                                           name="durasi[]" 
                                           value="{{ $item->id_durasi_magang }}" 
                                           class="w-4 h-4 text-[var(--primary)] border-gray-300 rounded focus:ring-[var(--primary)] focus:ring-2"
                                           @if(in_array($item->id_durasi_magang, $preferensi['durasi'])) checked @endif>
                                    <span class="text-sm text-gray-700">{{ $item->nama_durasi }}</span>
                                </label>
                            @endforeach
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Pilih durasi magang yang diinginkan</p>
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button type="submit"
                        class="bg-[var(--primary)] text-white px-6 py-3 rounded-md text-sm hover:bg-[#5955b2]/90 transition-all duration-300">
                        Simpan Preferensi
                    </button>
                </div>
            </form>
        </section>
    </main>
@endsection