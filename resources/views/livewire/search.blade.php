<div class="flex flex-wrap gap-4 w-full mx-auto my-4">
    <div class="relative flex-1">
        <input
            type="search"
            id="search"
            class="w-full py-3 pl-14 pr-4 text-sm border border-gray-300 bg-[#f9f8fe] rounded-full shadow focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Cari Nama Pekerjaan, Skill, Perusahaan"
            wire:model.debounce.500ms="search"
        />
        <label for="search" class="sr-only">Search</label>
        <span class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none text-gray-400">
            <i class="fa-solid fa-magnifying-glass"></i>
        </span>
    </div>

    <div class="relative w-64">
        <input
            type="search" 
            id="location"
            class="w-full py-3 pl-14 pr-4 text-sm border border-gray-300 bg-[#f9f8fe] rounded-full shadow focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Lokasi"
        />
        <label for="location" class="sr-only">Location</label>
        <span class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none text-gray-400">
            <i class="fa-solid fa-location-dot"></i>
        </span>
    </div>
    <div class="relative w-auto">
        <button 
            type="submit"
            id="cari"
            class="w-full py-3 px-6 text-sm text-white bg-[#E86BB1] rounded-full shadow hover:bg-pink-500 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:border-pink-400"
        >
            Cari
        </button>
    </div>
    <div class="w-full mx-auto my-2">
    <select 
        id="jenis-pekerjaan" 
        class="w-full py-3 px-4 text-sm border border-gray-300 bg-[#f9f8fe] rounded-full shadow focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-400"
            onchange="this.classList.remove('text-gray-400')"
        >
        <option value="">Pilih Jenis Pekerjaan</option>
        <option value="fulltime">Full Time</option>
        <option value="parttime">Part Time</option>
        <option value="freelance">Freelance</option>
        <option value="magang">Magang</option>
        <option value="remote">Remote</option>
    </select>
    </div>
    <div class="relative w-auto">
        <select 
            id="jenis-gaji" 
           class="w-full py-3 px-4 text-sm border border-gray-300 bg-[#f9f8fe] rounded-full shadow focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-400"
            onchange="this.classList.remove('text-gray-400')"
        >
            <option value="">Gaji min. Rp</option>
            <option value="fulltime">Full Time</option>
            <option value="parttime">Part Time</option>
            <option value="freelance">Freelance</option>
            <option value="magang">Magang</option>
            <option value="remote">Remote</option>
        </select>
        </div>