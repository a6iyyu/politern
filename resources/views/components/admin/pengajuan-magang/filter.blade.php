<div class="flex items-center gap-4 mb-8">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <i class="fas fa-search text-[var(--primary)] text-sm"></i>
        </div>
        <input type="text" 
               id="search" 
               name="search" 
               value="{{ request('search') }}" 
               placeholder="Cari Mahasiswa"
               class="w-80 text-sm text-[var(--primary)] border border-[var(--primary)] rounded px-4 py-2 pl-10 bg-white min-w-[250px] focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:border-transparent">
        </div>

        <div class="relative">
            <select id="program_studi" 
                name="program_studi"
                class="text-sm text-[var(--secondary-text)] border border-[var(--primary)] rounded px-4 py-2 pr-10 bg-white appearance-none min-w-[200px] focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:border-transparent">
                <option value="" >--Semua Program Studi--</option>
                @foreach($program_studi as $ps)
                    <option class="text-[var(--primary-text)]" value="{{ $ps->id_prodi }}" {{ request('program_studi') == $ps->id_prodi ? 'selected' : '' }}>
                        {{ $ps->nama }}
                    </option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <i class="fas fa-chevron-down text-[var(--primary)] text-sm"></i>
            </div>
        </div>

        <div class="relative">
            <select id="perusahaan" 
                name="perusahaan"
                class="w-80 text-sm text-[var(--secondary-text)] border border-[var(--primary)] rounded px-4 py-2 pr-10 bg-white appearance-none min-w-[200px] focus:outline-none focus:ring-2 focus:ring-[var(--primary)] focus:border-transparent">
                <option value="">--Semua Perusahaan--</option>
                @foreach($perusahaan as $p)
                    <option value="{{ $p->id_perusahaan }}" {{ request('perusahaan') == $p->id_perusahaan ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <i class="fas fa-chevron-down text-[var(--primary)] text-sm"></i>
            </div>
        </div>
    </div>

    @if($periode_magang)
        <div class="mb-6">
            <span class="text-sm text-[var(--secondary-text)]">Periode Aktif:</span>
            <span class="ml-2 inline-flex items-center px-4 py-2 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                {{ $periode_magang->nama_periode }}
            </span>
        </div>
    @endif