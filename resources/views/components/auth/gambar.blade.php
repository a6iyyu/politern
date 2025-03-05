<section class="w-1/2 relative hidden lg:inline">
    <span class="absolute inset-0 z-10 bg-gradient-to-b from-[#1a4167]/20 to-[#1a4167]/30 transition-opacity duration-300"></span>
    <div class="carousel-container h-full">
        <img
            src="{{ asset('img/shared/login-1.webp') }}"
            alt="Selamat Datang"
            class="carousel-image absolute w-full h-full object-cover bg-white opacity-0"
            loading="lazy"
            data-index="0"
        />
        <img
            src="{{ asset('img/shared/login-2.jpg') }}"
            alt="Selamat Datang"
            class="carousel-image absolute w-full h-full object-cover bg-white opacity-0"
            loading="lazy"
            data-index="1"
        />
        <img
            src="{{ asset('img/shared/login-3.jpeg') }}"
            alt="Selamat Datang"
            class="carousel-image absolute w-full h-full object-cover bg-white opacity-0"
            loading="lazy"
            data-index="2"
        />
    </div>
    <figure class="absolute z-20 bottom-8 left-8 text-white space-y-2">
        <img
            id="carousel-img"
            src="{{ asset('img/shared/polinema.png') }}" alt="Logo Polinema"
            class="w-16 mb-4 transform hover:scale-105 transition-transform duration-300"
            loading="lazy"
        />
        <h4 class="cursor-default text-2xl font-bold tracking-tight">Jurusan Teknologi Informasi</h4>
        <h6 class="cursor-default text-sm text-gray-200">Politeknik Negeri Malang</h6>
        <div class="carousel-pointer mt-4 flex h-fit space-x-4">
            <span data-index="0" class="carousel-indicator cursor-pointer h-3 w-3 rounded-full border-2 bg-white border-white"></span>
            <span data-index="1" class="carousel-indicator cursor-pointer h-3 w-3 rounded-full border-2 border-white"></span>
            <span data-index="2" class="carousel-indicator cursor-pointer h-3 w-3 rounded-full border-2 border-white"></span>
        </div>
    </figure>
</section>