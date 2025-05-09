<header class="mb-6 flex items-center justify-between py-4 border-b px-10 transition-all duration-300 ease-in-out pl-84 border-[#d3d3d3]">
    <section class="flex items-center gap-6">
        <i id="hamburger-menu" class="fa-solid fa-bars cursor-pointer text-[#2d2d2d] text-lg"></i>
        <h4 class="text-lg font-semibold text-[#2d2d2d] cursor-default">
            {{ $title }}
        </h4>
    </section>
    @include('shared.ui.profile-photo')
</header>