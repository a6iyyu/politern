<fieldset class="w-full max-w-md mx-auto my-4">
    <div class="relative">
        <input 
            type="search" 
            id="search" 
            class="w-full py-2 pl-10 pr-4 text-sm border border-gray-300 rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
            placeholder="Cari sesuatu..." 
            wire:model.debounce.500ms="search" 
        />
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400 pointer-events-none">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </div>
</fieldset>
