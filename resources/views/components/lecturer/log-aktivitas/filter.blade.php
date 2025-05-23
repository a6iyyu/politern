<form action="" class="my-10 flex flex-col justify-between gap-4 lg:flex-row">
    <fieldset class="relative w-1/4">
        <label for="semester" class="sr-only">Semester</label>
        <select name="semester" id="semester" class="appearance-none w-full text-sm border border-[var(--primary)] text-[var(--primary)] rounded-md pl-5 pr-12 py-3">
            <option value="">Semua Semester</option>
            @if (!empty($semester))
                @foreach ($semester as $periode)
                    <option value="{{ $periode->id_semester }}">{{ $periode->semester }}</option>
                @endforeach
            @else
                <option value="">Tidak ada data</option>
            @endif
        </select>
        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 text-xs -translate-y-1/2 text-[var(--primary)]"></i>
    </fieldset>
    <fieldset class="relative">
        <label for="periode" class="sr-only">Periode</label>
        <select name="periode" id="periode" class="appearance-none w-full text-sm border border-[var(--primary)] text-[var(--primary)] rounded-md pl-5 pr-12 py-3">
            <option value="">Terbaru</option>
            @if (!empty($periode_magang))
                @foreach ($periode_magang as $periode)
                    <option value="{{ $periode->id_semester }}">{{ $periode->semester }}</option>
                @endforeach
            @else
                <option value="">Tidak ada data</option>
            @endif
        </select>
        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 text-xs -translate-y-1/2 text-[var(--primary)]"></i>
    </fieldset>
</form>