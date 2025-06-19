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
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-4 border border-[var(--stroke)] rounded-lg bg-gray-50">
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
                    <!-- BEBAS -->
        <label class="flex items-center space-x-2 cursor-pointer hover:bg-white p-2 rounded transition-colors">
            <input type="radio" name="gaji" value="BEBAS"
                class="w-4 h-4 text-[var(--primary)] border-gray-300 focus:ring-[var(--primary)] focus:ring-2"
                @if (isset($mahasiswa) && $mahasiswa->gaji === 'BEBAS') checked @endif>
            <span class="text-sm text-gray-700">BEBAS</span>
        </label>
                </div>
                <p class="text-xs text-gray-500 mt-1">Pilih preferensi gaji yang diinginkan</p>
            </div>

            <div class="max-w-full mt-6 mx-auto bg-white rounded-xl shadow-md border border-gray-200 p-8">
            <h2 class="text-lg font-semibold text-[var(--primary)] mb-4">Edit Bobot Kriteria</h2>
            <hr class="mb-6 border border-[var(--primary)]" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kriteria Keahlian -->
                    <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">

                        <h3 class="block mb-2 text-xl font-medium text-[var(--primary)] ">Keahlian</h3>

                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Prioritas:</label>
                            <select name="prioritas_keahlian" class="priority-select w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Prioritas</option>
                                <option value="1">1 - Sangat Tinggi</option>
                                <option value="2">2 - Tinggi</option>
                                <option value="3">3 - Sedang Tinggi</option>
                                <option value="4">4 - Sedang Rendah</option>
                                <option value="5">5 - Rendah</option>
                                <option value="6">6 - Sangat Rendah</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kriteria Lokasi -->
                    <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                        <h3 class="block mb-2 text-xl font-medium text-[var(--primary)] ">Lokasi</h3>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Prioritas:</label>
                            <select name="prioritas_lokasi" class="priority-select w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Prioritas</option>
                                <option value="1">1 - Sangat Tinggi</option>
                                <option value="2">2 - Tinggi</option>
                                <option value="3">3 - Sedang Tinggi</option>
                                <option value="4">4 - Sedang Rendah</option>
                                <option value="5">5 - Rendah</option>
                                <option value="6">6 - Sangat Rendah</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kriteria Jenis Lokasi -->
                    <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                        <h3 class="block mb-2 text-xl font-medium text-[var(--primary)] ">Jenis Lokasi</h3>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Prioritas:</label>
                            <select name="prioritas_jenis_lokasi" class="priority-select w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Prioritas</option>
                                <option value="1">1 - Sangat Tinggi</option>
                                <option value="2">2 - Tinggi</option>
                                <option value="3">3 - Sedang Tinggi</option>
                                <option value="4">4 - Sedang Rendah</option>
                                <option value="5">5 - Rendah</option>
                                <option value="6">6 - Sangat Rendah</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kriteria Bidang -->
                    <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                        <h3 class="block mb-2 text-xl font-medium text-[var(--primary)] ">Bidang</h3>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Prioritas:</label>
                            <select name="prioritas_bidang" class="priority-select w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Prioritas</option>
                                <option value="1">1 - Sangat Tinggi</option>
                                <option value="2">2 - Tinggi</option>
                                <option value="3">3 - Sedang Tinggi</option>
                                <option value="4">4 - Sedang Rendah</option>
                                <option value="5">5 - Rendah</option>
                                <option value="6">6 - Sangat Rendah</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kriteria Durasi -->
                    <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                        <h3 class="block mb-2 text-xl font-medium text-[var(--primary)] ">Durasi</h3>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Prioritas:</label>
                            <select name="prioritas_durasi" class="priority-select w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Prioritas</option>
                                <option value="1">1 - Sangat Tinggi</option>
                                <option value="2">2 - Tinggi</option>
                                <option value="3">3 - Sedang Tinggi</option>
                                <option value="4">4 - Sedang Rendah</option>
                                <option value="5">5 - Rendah</option>
                                <option value="6">6 - Sangat Rendah</option>
                            </select>
                        </div>
                    </div>

                    <!-- Kriteria Gaji -->
                    <div class="p-6 border border-gray-200 rounded-lg bg-gray-50">
                        <h3 class="block mb-2 text-xl font-medium text-[var(--primary)] ">Gaji</h3>
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">Prioritas:</label>
                            <select name="prioritas_gaji" class="priority-select w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Pilih Prioritas</option>
                                <option value="1">1 - Sangat Tinggi</option>
                                <option value="2">2 - Tinggi</option>
                                <option value="3">3 - Sedang Tinggi</option>
                                <option value="4">4 - Sedang Rendah</option>
                                <option value="5">5 - Rendah</option>
                                <option value="6">6 - Sangat Rendah</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Preview Bobot -->
                <div class="mt-8 p-6 bg-indigo-50 rounded-lg border border-indigo-200">
                    <h4 class="font-semibold text-indigo-900 mb-4">Preview Bobot Kriteria:</h4>
                    <div id="weightPreview" class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">
                        <div>Keahlian: <span id="previewKeahlian" class="font-semibold">16.67%</span></div>
                        <div>Lokasi: <span id="previewLokasi" class="font-semibold">16.67%</span></div>
                        <div>Jenis Lokasi: <span id="previewJenisLokasi" class="font-semibold">16.67%</span></div>
                        <div>Bidang: <span id="previewBidang" class="font-semibold">16.67%</span></div>
                        <div>Durasi: <span id="previewDurasi" class="font-semibold">16.67%</span></div>
                        <div>Gaji: <span id="previewGaji" class="font-semibold">16.67%</span></div>
                    </div>
                    <p class="text-xs text-indigo-700 mt-2">*Jika tidak ada prioritas yang dipilih, semua kriteria akan memiliki bobot yang sama</p>
                </div>

                <div class="flex justify-between items-center pt-6 border-t">
                    <button type="button" id="resetBtn" class="px-4 py-2 text-gray-600 bg-gray-200 rounded-md hover:bg-gray-300 transition-colors">
                        Reset Semua
                    </button>
                    {{-- <button type="button" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors">
                        Simpan Pengaturan Bobot
                    </button> --}}
                </div>
            </div>
            <span class="flex justify-end mt-8">
                <button type="submit"
                    class="cursor-pointer bg-[var(--primary)] text-white px-6 py-3 rounded-md text-sm hover:bg-[#5955b2]/90 transition-all duration-300">
                    Simpan Preferensi
                </button>
            </span>
        </form>
        
    </main>
    
    <script>
        // Mapping prioritas ke bobot (Total = 1.0000)
        const priorityWeights = {
            1: 0.2742, // Prioritas tertinggi
            2: 0.2174,
            3: 0.1736,
            4: 0.1382,
            5: 0.1103,
            6: 0.0879  // Prioritas terendah
        };

        const selects = document.querySelectorAll('.priority-select');
        const previewElements = {
            prioritas_keahlian: document.getElementById('previewKeahlian'),
            prioritas_lokasi: document.getElementById('previewLokasi'),
            prioritas_jenis_lokasi: document.getElementById('previewJenisLokasi'),
            prioritas_bidang: document.getElementById('previewBidang'),
            prioritas_durasi: document.getElementById('previewDurasi'),
            prioritas_gaji: document.getElementById('previewGaji')
        };

        function updateSelectOptions() {
            const usedValues = Array.from(selects)
                .map(select => select.value)
                .filter(value => value !== '');

            selects.forEach(select => {
                const currentValue = select.value;
                const options = select.querySelectorAll('option');
                
                options.forEach(option => {
                    if (option.value === '') return;
                    
                    if (usedValues.includes(option.value) && option.value !== currentValue) {
                        option.disabled = true;
                        option.style.color = '#ccc';
                    } else {
                        option.disabled = false;
                        option.style.color = '';
                    }
                });
            });
        }

        function updateWeightPreview() {
            const values = {};
            let hasAnyPriority = false;
            
            selects.forEach(select => {
                const name = select.name;
                const value = select.value;
                if (value) {
                    values[name] = parseInt(value);
                    hasAnyPriority = true;
                }
            });

            if (!hasAnyPriority) {
                // Jika tidak ada prioritas, semua sama (16.67%)
                Object.keys(previewElements).forEach(key => {
                    previewElements[key].textContent = '16.67%';
                });
            } else {
                // Hitung bobot berdasarkan prioritas
                Object.keys(previewElements).forEach(key => {
                    if (values[key]) {
                        const weight = priorityWeights[values[key]];
                        previewElements[key].textContent = (weight * 100).toFixed(2) + '%';
                    } else {
                        previewElements[key].textContent = '0.00%';
                    }
                });
            }
        }

        function resetForm() {
            selects.forEach(select => {
                select.value = '';
            });
            updateSelectOptions();
            updateWeightPreview();
        }

        // Event listeners
        selects.forEach(select => {
            select.addEventListener('change', () => {
                updateSelectOptions();
                updateWeightPreview();
            });
        });

        document.getElementById('resetBtn').addEventListener('click', resetForm);

        // document.getElementById('weightForm').addEventListener('submit', (e) => {
        //     e.preventDefault();
            
        //     const formData = new FormData(e.target);
        //     const weights = {};
        //     let hasAnyPriority = false;
            
        //     // Collect weights
        //     for (let [key, value] of formData.entries()) {
        //         if (value) {
        //             weights[key] = parseInt(value);
        //             hasAnyPriority = true;
        //         }
        //     }
            
        //     if (!hasAnyPriority) {
        //         // Default equal weights
        //         weights = {
        //             keahlian: 0,
        //             lokasi: 0,
        //             jenis_lokasi: 0,
        //             bidang: 0,
        //             durasi: 0,
        //             gaji: 0
        //         };
        //     }
            
        //     // Here you would normally send this data to your server
        //     console.log('Weights to save:', weights);
        //     alert('Pengaturan bobot berhasil disimpan!');
            
        //     // In real implementation, you would make an AJAX call:
        //     // fetch('/api/save-weights', {
        //     //     method: 'POST',
        //     //     headers: { 'Content-Type': 'application/json' },
        //     //     body: JSON.stringify({ weights: weights })
        //     // });
        // });

        // Initialize
        updateSelectOptions();
        updateWeightPreview();
    </script>
@endsection