<div class="mb-8 grid grid-cols-1 gap-3 lg:grid-cols-3">
    <fieldset class="relative">
        <label for="periode" class="sr-only">Cari periode</label>
        <i class="fa-solid fa-magnifying-glass absolute text-sm left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <input
            type="search"
            name="periode"
            id="periode"
            class="appearance-none w-full text-sm border border-[var(--primary)] text-[var(--secondary-text)] rounded-md pl-10 pr-3 py-2.5"
            placeholder="Cari periode"
        />
    </fieldset>
    <fieldset class="relative">
        <label for="semester" class="sr-only">Semester</label>
        <i class="fa-solid fa-user-graduate absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <select
            name="semester"
            id="semester"
            class="appearance-none w-full text-sm border border-[var(--primary)] text-[var(--secondary-text)] rounded-md px-12 py-2.5"
        >
            <option value="">Semester</option>
            @if (!empty($semester))
                @foreach ($semester as $periode)
                    <option value="{{ $periode->id_semester }}">{{ $periode->semester }}</option>
                @endforeach
            @else
                <option value="">Tidak ada data</option>
            @endif
        </select>
        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 text-xs -translate-y-1/2 text-slate-400"></i>
    </fieldset>
    <fieldset class="relative">
        <label for="tahun" class="sr-only">Tahun</label>
        <i class="fa-solid fa-calendar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
        <select
            name="tahun"
            id="tahun"
            class="appearance-none w-full text-sm border border-[var(--primary)] text-[var(--secondary-text)] rounded-md px-12 py-2.5"
        >
            <option value="">Tahun</option>
            @if (!empty($tahun))
                @foreach ($tahun as $periode)
                    <option value="{{ $periode->id_tahun }}">{{ $periode->tahun }}</option>
                @endforeach
            @else
                <option value="">Tidak ada data</option>
            @endif
        </select>
        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 text-xs -translate-y-1/2 text-slate-400"></i>
    </fieldset>
</div>