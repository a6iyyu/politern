<form action="" method="GET" class="mb-7 grid grid-cols-1 lg:grid-cols-3">
    @csrf
    @method('GET')
    <div class="lg:col-span-2">
        <livewire:search
            icon="fa-solid fa-magnifying-glass"
            label="Cari nama durasi"
            name="nama"
            placeholder="Cari nama durasi"
            :model="\App\Models\DurasiMagang::class"
            :required="false"
        />
    </div>
    <div class="flex items-end justify-end">
        <button type="submit" class="cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb]">
            Cari
        </button>
    </div>
</form>