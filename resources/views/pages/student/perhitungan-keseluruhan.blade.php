@extends('layouts.main')

@section('judul')
    Perhitungan TOPSIS
@endsection

@section('konten')
    <x-header title="Perhitungan Topsis" />
    <main class="flex flex-col pb-10 px-10 pl-84 transition-all duration-300">
        <section class="cursor-default container mx-auto p-6 rounded-lg bg-white border border-[var(--stroke)]">
            <h2 class="font-semibold text-center text-[var(--blue-tertiary)] mb-8 text-lg lg:text-xl">
                Matriks Perhitungan Rekomendasi Magang Menggunakan TOPSIS
            </h2>
            <div class="mb-4 text-xs text-gray-700 bg-gray-100 border border-[var(--stroke)] rounded-md p-3">
                <strong>Keterangan Kriteria:</strong><br>
                <span class="block">C1: Skill</span>
                <span class="block">C2: Lokasi</span>
                <span class="block">C3: Jenis Lokasi</span>
                <span class="block">C4: Bidang Minat Mahasiswa</span>
                <span class="block">C5: Periode / Durasi Magang</span>
                <span class="block">C6: Gaji</span>
            </div>
            <!-- Bobot Kriteria -->
            <div class="mb-8">
                <h3 class="font-semibold text-base text-[var(--blue-tertiary)] mb-2 lg:text-lg">
                    Bobot Setiap Kriteria
                </h3>
                <p class="mb-4 text-gray-600 text-xs lg:text-sm">
                    Nilai bobot di bawah menunjukkan tingkat kepentingan masing-masing kriteria dalam perhitungan TOPSIS.
                </p>
                <x-table :headers="['Kriteria', 'Bobot']" :sortable="[]" :rows="collect($debug['bobot'])
                    ->map(fn($bobot, $kriteria) => [$kriteria, number_format($bobot, 4)])
                    ->toArray()" />
            </div>
            <!-- Matriks Alternatif -->

            <div class="mb-8">
                <h3 class="font-semibold text-base text-[var(--blue-tertiary)] mb-2 lg:text-lg">
                    Langkah 1: Matriks Alternatif
                </h3>
                <p class="mb-4 text-gray-600 text-xs lg:text-sm">
                    Nilai setiap lowongan terhadap kriteria C1 - C6 sebelum normalisasi.
                </p>
                <x-table :headers="['ID Lowongan', 'C1', 'C2', 'C3', 'C4', 'C5', 'C6']" :sortable="[]" :rows="collect($debug['matriks_alternatif'])
                    ->map(
                        fn($baris, $id) => [
                            $id,
                            number_format($baris['C1'], 4),
                            number_format($baris['C2'], 4),
                            number_format($baris['C3'], 4),
                            number_format($baris['C4'], 4),
                            number_format($baris['C5'], 4),
                            number_format($baris['C6'], 4),
                        ],
                    )
                    ->toArray()" />

            </div>

            <!-- Matriks Normalisasi -->
            <div class="mb-8">
                <h3 class="font-semibold text-base text-[var(--blue-tertiary)] mb-2 lg:text-lg">
                    Langkah 2: Matriks Normalisasi
                </h3>
                <p class="mb-4 text-gray-600 text-xs lg:text-sm">
                    Nilai-nilai kriteria dinormalisasi agar berada dalam skala yang sama menggunakan akar kuadrat jumlah
                    kuadrat.
                </p>
                <x-table :headers="array_merge(['ID Lowongan'], array_keys(reset($debug['matriks_normalisasi'])))" :sortable="[]" :rows="collect($debug['matriks_normalisasi'])
                    ->map(fn($baris, $id) => array_merge([$id], array_map(fn($v) => number_format($v, 4), $baris)))
                    ->toArray()" />
            </div>

            <!-- Matriks Terbobot -->
            <div class="mb-8">
                <h3 class="font-semibold text-base text-[var(--blue-tertiary)] mb-2 lg:text-lg">
                    Langkah 3: Matriks Terbobot
                </h3>
                <p class="mb-4 text-gray-600 text-xs lg:text-sm">
                    Setiap nilai normalisasi dikalikan dengan bobot kriterianya. Bobot menunjukkan seberapa penting kriteria
                    tersebut.
                </p>
                <x-table :headers="array_merge(['ID Lowongan'], array_keys(reset($debug['matriks_terbobot'])))" :sortable="[]" :rows="collect($debug['matriks_terbobot'])
                    ->map(fn($baris, $id) => array_merge([$id], array_map(fn($v) => number_format($v, 4), $baris)))
                    ->toArray()" />
            </div>

            <!-- Solusi Ideal Positif & Negatif -->
            <div class="mb-8">
                <h3 class="font-semibold text-base text-[var(--blue-tertiary)] mb-2 lg:text-lg">
                    Langkah 4: Solusi Ideal Positif & Negatif
                </h3>
                <p class="mb-4 text-gray-600 text-xs lg:text-sm">
                    Menentukan nilai terbaik (positif) dan terburuk (negatif) untuk setiap kriteria dari seluruh alternatif.
                </p>
                <x-table :headers="['Kriteria', 'Solusi Ideal Positif', 'Solusi Ideal Negatif']" :sortable="[]" :rows="collect($debug['solusi_ideal_positif'])
                    ->map(
                        fn($nilai, $kol) => [
                            $kol,
                            number_format($nilai, 4),
                            number_format($debug['solusi_ideal_negatif'][$kol] ?? 0, 4),
                        ],
                    )
                    ->toArray()" />
            </div>

            <!-- Nilai Preferensi -->
            <div class="mb-8">
                <h3 class="font-semibold text-base text-[var(--blue-tertiary)] mb-2 lg:text-lg">
                    Langkah 5: Nilai Preferensi
                </h3>
                <p class="mb-4 text-gray-600">Menghitung skor akhir (nilai preferensi) menggunakan rumus <strong>V = D⁻ /
                        (D⁺ + D⁻)</strong>, di mana D⁺ dan D⁻ adalah jarak dari solusi ideal positif dan negatif.</p>
                <x-table :headers="['ID Lowongan', 'Perusahaan', 'Nilai Preferensi']" :sortable="[]" :rows="collect($debug['nilai_preferensi'])
                    ->map(function ($nilai, $id) use ($lowongan) {
                        $nama =
                            optional($lowongan->firstWhere('id_lowongan', $id)?->perusahaan)->nama ?? 'Tidak Diketahui';
                        return [$id, $nama, number_format($nilai, 4)];
                    })
                    ->toArray()" />
            </div>

        </section>
    </main>
@endsection

