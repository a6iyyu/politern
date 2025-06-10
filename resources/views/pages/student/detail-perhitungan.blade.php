<h1 class="text-xl font-semibold mb-5">Matriks Alternatif</h1>
<table class="table-auto w-full border-collapse border border-gray-300">
    <thead>
        <tr>
            <th class="border px-4 py-2">Lowongan</th>
            <th class="border px-4 py-2">C1 (Keahlian)</th>
            <th class="border px-4 py-2">C2 (Lokasi)</th>
            <th class="border px-4 py-2">C3 (Jenis Lokasi)</th>
            <th class="border px-4 py-2">C4 (Bidang)</th>
            <th class="border px-4 py-2">C5 (Durasi)</th>
            <th class="border px-4 py-2">C6 (Gaji)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($matriks_alternatif as $id => $baris)
            <tr>
                <td class="border px-4 py-2">{{ $lowongan_magang->find($id)->judul ?? 'N/A' }}</td>
                <td class="border px-4 py-2">{{ number_format($baris['C1'], 4) }}</td>
                <td class="border px-4 py-2">{{ number_format($baris['C2'], 4) }}</td>
                <td class="border px-4 py-2">{{ number_format($baris['C3'], 4) }}</td>
                <td class="border px-4 py-2">{{ number_format($baris['C4'], 4) }}</td>
                <td class="border px-4 py-2">{{ number_format($baris['C5'], 4) }}</td>
                <td class="border px-4 py-2">{{ number_format($baris['C6'], 4) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

