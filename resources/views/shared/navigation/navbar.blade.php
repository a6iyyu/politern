<header class="fixed top-0 w-full p-4 bg-purple bg-opacity-10 backdrop-blur-xl border-b border-white border-opacity-20 z-50 transition-all duration-300" id="header">
    <nav class="flex justify-between items-center max-w-screen-xl mx-auto">
        <div class="flex items-center gap-3 text-white font-bold text-2xl">
            <div class="logo-icon w-10 h-10 bg-gradient-to-br from-[#667eea] to-[#764ba2] rounded-full flex items-center justify-center">🎓</div>
            <span>Polinema</span>
        </div>
        <ul class="nav-links hidden md:flex gap-8 list-none">
            <li><a href="{{ route('beranda') }}" class="text-white text-lg font-medium hover:-translate-y-0.5 relative">Beranda</a></li>
            <li><a href="{{ route('beranda') }}#fitur" class="text-white text-lg font-medium hover:-translate-y-0.5 relative">Fitur</a></li>
            <li><a href="{{ route('beranda') }}#tentang" class="text-white text-lg font-medium hover:-translate-y-0.5 relative">Tentang</a></li>
            <li><a href="{{ route('beranda') }}#kontak" class="text-white text-lg font-medium hover:-translate-y-0.5 relative">Kontak</a></li>
        </ul>
    </nav>
</header>

<script>
    // Add scroll event listener to update header background
    window.addEventListener('scroll', () => {
        const header = document.getElementById('header');
        if (window.scrollY > 100) {
            header.classList.remove('bg-opacity-10', 'border-opacity-20');
            header.classList.add('bg-opacity-20', 'border-opacity-30');
        } else {
            header.classList.remove('bg-opacity-20', 'border-opacity-30');
            header.classList.add('bg-opacity-10', 'border-opacity-20');
        }
    });
</script>
