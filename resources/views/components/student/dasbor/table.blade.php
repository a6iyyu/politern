<div class="container mx-auto p-6">
    <h2 class="text-3xl font-semibold text-center text-blue-600 mb-8">Matriks Perhitungan</h2>

    <div class="mb-8">
        <h3 class="font-semibold text-2xl text-blue-500 mb-4">Matriks Alternatif</h3>
        <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="border px-6 py-4 text-left">Lowongan ID</th>
                    <th class="border px-6 py-4 text-left">C1</th>
                    <th class="border px-6 py-4 text-left">C2</th>
                    <th class="border px-6 py-4 text-left">C3</th>
                    <th class="border px-6 py-4 text-left">C4</th>
                    <th class="border px-6 py-4 text-left">C5</th>
                    <th class="border px-6 py-4 text-left">C6</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($matriks_alternatif as $id => $baris)
                    <tr class="hover:bg-blue-50">
                        <td class="border px-6 py-4">{{ $id }}</td>
                        <td class="border px-6 py-4">{{ $baris['C1'] }}</td>
                        <td class="border px-6 py-4">{{ $baris['C2'] }}</td>
                        <td class="border px-6 py-4">{{ $baris['C3'] }}</td>
                        <td class="border px-6 py-4">{{ $baris['C4'] }}</td>
                        <td class="border px-6 py-4">{{ $baris['C5'] }}</td>
                        <td class="border px-6 py-4">{{ $baris['C6'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-8">
        <h3 class="font-semibold text-2xl text-blue-500 mb-4">Matriks Normalisasi</h3>
        <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="border px-6 py-4 text-left">Lowongan ID</th>
                    @foreach (array_keys($matriks_normalisasi[array_key_first($matriks_normalisasi)]) as $kol)
                        <th class="border px-6 py-4 text-left">{{ $kol }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($matriks_normalisasi as $id => $baris)
                    <tr class="hover:bg-blue-50">
                        <td class="border px-6 py-4">{{ $id }}</td>
                        @foreach ($baris as $kol => $nilai)
                            <td class="border px-6 py-4">{{ number_format($nilai, 4) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-8">
        <h3 class="font-semibold text-2xl text-blue-500 mb-4">Matriks Terbobot</h3>
        <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="border px-6 py-4 text-left">Lowongan ID</th>
                    @foreach (array_keys($matriks_terbobot[array_key_first($matriks_terbobot)]) as $kol)
                        <th class="border px-6 py-4 text-left">{{ $kol }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($matriks_terbobot as $id => $baris)
                    <tr class="hover:bg-blue-50">
                        <td class="border px-6 py-4">{{ $id }}</td>
                        @foreach ($baris as $kol => $nilai)
                            <td class="border px-6 py-4">{{ number_format($nilai, 4) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-8">
        <h3 class="font-semibold text-2xl text-blue-500 mb-4">Solusi Ideal Positif & Negatif</h3>
        <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="border px-6 py-4 text-left">Kriteria</th>
                    <th class="border px-6 py-4 text-left">Solusi Ideal Positif</th>
                    <th class="border px-6 py-4 text-left">Solusi Ideal Negatif</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($solusi_ideal_positif as $kol => $nilai)
                    <tr class="hover:bg-blue-50">
                        <td class="border px-6 py-4">{{ $kol }}</td>
                        <td class="border px-6 py-4">{{ $nilai }}</td>
                        <td class="border px-6 py-4">{{ $solusi_ideal_negatif[$kol] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mb-8">
        <h3 class="font-semibold text-2xl text-blue-500 mb-4">Nilai Preferensi</h3>
        <table class="min-w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="border px-6 py-4 text-left">Lowongan ID</th>
                    <th class="border px-6 py-4 text-left">Nilai Preferensi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($nilai_preferensi as $id => $nilai)
                    <tr class="hover:bg-blue-50">
                        <td class="border px-6 py-4">{{ $id }}</td>
                        <td class="border px-6 py-4">{{ number_format($nilai, 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
