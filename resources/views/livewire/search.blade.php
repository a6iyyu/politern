<fieldset class="relative w-full mx-auto my-4">
    <input
        type="search"
        id="search"
        class="w-full py-3 pl-14 pr-4 text-sm border border-gray-300 bg-[#f9f8fe] rounded-full shadow focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        placeholder="Cari sesuatu..."
        wire:model.debounce.500ms="search"
    />
    <label for="search" class="sr-only">Search</label>
    <span class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none text-gray-400">
        <i class="fa-solid fa-magnifying-glass"></i>
    </span>
</fieldset>