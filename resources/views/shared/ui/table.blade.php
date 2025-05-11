<div class="w-full mt-6">
    <div class="overflow-x-auto rounded-md border border-gray-200">
        <table class="min-w-full text-xs text-left text-gray-700">
            <thead class="bg-[var(--primary)] text-white">
                <tr>
                    @foreach ($headers as $header)
                        <th scope="col" class="px-6 py-4 font-normal">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($rows as $row)
                    <tr class="border-b border-[var(--stroke)]">
                        @foreach ($row as $key => $value)
                            <td class="px-6 py-3">
                                @if ($key === 'status')
                                    @php
                                        $colorMap = [
                                            'Diterima' => 'bg-[var(--tersier-hijau)] text-white border-[var(--tersier-hijau)]',
                                            'Menunggu' => 'bg-white text-[var(--tersier-kuning)] border-[var(--tersier-kuning)]',
                                            'Ditolak' => 'bg-white text-[var(--tersier-merah)] border-[var(--tersier-merah)]',
                                        ];
                                    @endphp
                                    <span class="inline-block w-[100px] text-center px-3 py-2 text-xs font-medium rounded border {{ $colorMap[$value] ?? '' }}">
                                        {{ $value }}
                                    </span>
                                @elseif ($key === 'aksi')
                                    <a href="{{ $value }}" class="inline-block w-[100px] text-center px-3 py-2 cursor-pointer bg-[var(--tersier-biru)] text-white text-xs font-medium rounded hover:bg-blue-700 transition">
                                        Detail
                                    </a>
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
