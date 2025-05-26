<section class="mt-4 w-full overflow-x-auto">
    <div class="flex gap-4 min-w-max">
        <x-info
            background="#ebf2fe"
            color="#2c6cd3"
            icon="fa-solid fa-user-group"
            info="total semua dosen"
            title="Total Dosen"
            total="{{ $total_dosen }}"
        />
        <x-info
            background="#e7f8f2"
            color="#10b981"
            icon="fa-solid fa-user-check"
            info="total semua dosen pembimbing"
            title="Total Dosen Pembimbing"
            total="{{ $total_dosen_pembimbing }}"
        />
    </div>
</section>