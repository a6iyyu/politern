<form action="" method="GET" class="mb-7 grid grid-cols-1 lg:grid-cols-3 gap-4">
    @csrf
    @method('GET')
    <livewire:search
        icon="fa-solid fa-magnifying-glass"
        label="Cari nama dosen"
        name="nama"
        placeholder="Cari nama dosen"
        :model="\App\Models\Dosen::class"
        :required="false"
    />
    <div class="flex items-end">
        <button type="submit" class="w-fit cursor-pointer bg-[var(--secondary)] border border-[var(--secondary)] text-white px-12 py-2 rounded-md transition-all duration-300 ease-in-out text-sm lg:py-2.5 lg:hover:bg-[#ff86cb]">
            Cari
        </button>
    </div>
</form>