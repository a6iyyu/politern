<div class="bg-white rounded-2xl shadow py-5 px-7 mb-5 flex flex-col gap-2 border border-gray-100 hover:bg-[#F4F4FE]">
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-[#5955B2] text-base mb-1 font-semibold cursor-default">
                {{ $title }}
            </h3>
            <h3 class="text-[#585858] text-sm mb-1 font-regular cursor-default">
                {{ $company }}
            </h3>
            <p class="text-[#585858] text-sm mt-3 cursor-default">
                {{ $location }}
            </p>

            <div class="flex flex-wrap gap-2 mt-3">
                <span class="bg-[#FBECF1] text-xs text-[#585858] px-3 py-1 rounded-xl cursor-default">
                    {{ $kategori }}
                </span>
                <span class="bg-[#FBECF1] text-xs text-[#585858] px-3 py-1 rounded-xl cursor-default">
                    {{ $bidang }}
                </span>
            </div>
        </div>

        <span class="bg-[#70E459] text-white text-[14px] px-3 py-1 rounded-[10px] self-start cursor-default">
            {{ $status }}
        </span>
    </div>

    <div class="flex items-center justify-between mt-3">
        <img src="{{ asset('icons/save.svg') }}" alt="Save Icon" class="w-5 h-5 cursor-pointer">
        <button class="bg-[#FF77C3] text-white text-sm px-4 py-2 rounded-[12px] font-medium cursor-pointer">
            Lamar Sekarang
        </button>
    </div>
</div>
