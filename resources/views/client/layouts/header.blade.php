<style>
    header {
        transform: translateY(-80px);
        opacity: 0;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1),
            opacity 0.6s ease,
            background-color 0.4s ease;
    }

    header.visible {
        transform: translateY(0);
        opacity: 1;
    }

    header.hide {
        transform: translateY(-80px);
        opacity: 0;
    }

    header.scrolled {
        backdrop-filter: blur(8px);
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slideDown {
        animation: slideDown 0.25s ease forwards;
    }
</style>
<header
    class="fixed top-0 left-0 w-full z-50 backdrop-blur-md bg-white/80 border-b border-gray-200/60 shadow-sm transition-all duration-300">
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center group">
                <img src="https://cdn.aceimg.com/88e06bfcb.png" alt="Logo"
                    class="h-24 w-24 object-contain transition-transform duration-300 group-hover:rotate-6 group-hover:scale-110">
                <h1
                    class="ml-3 text-xl font-extrabold text-neutral-800 group-hover:text-rose-600 transition-colors duration-300">
                    D'Hotels
                </h1>
            </div>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="relative inline-flex items-center justify-center px-6 py-2 rounded-lg text-white font-semibold
                    bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700
                    shadow-md shadow-rose-500/30 hover:shadow-rose-600/50 transition-all duration-300 group">
                    Logout
                </button>
            </form>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button"
                    class="text-gray-700 hover:text-rose-600 focus:outline-none focus:text-rose-600 transition-colors"
                    onclick="toggleMobileMenu()">
                    <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="md:hidden hidden">
            <div class="px-4 pt-4 pb-6 space-y-2 bg-white/95 backdrop-blur-md border-t border-gray-200/60 rounded-b-2xl shadow-lg">
                <a href="#"
                    class="block text-rose-600 font-semibold px-3 py-2 rounded-md text-base bg-rose-50 hover:bg-rose-100 transition-all duration-300">Beranda</a>
                <a href="#"
                    class="block text-gray-700 hover:text-rose-600 px-3 py-2 rounded-md text-base transition-all duration-300">Coming Soon</a>
                <a href="#"
                    class="block text-gray-700 hover:text-rose-600 px-3 py-2 rounded-md text-base transition-all duration-300">Coming Soon</a>
                <a href="#"
                    class="block text-gray-700 hover:text-rose-600 px-3 py-2 rounded-md text-base transition-all duration-300">Coming Soon</a>
                <a href="#"
                    class="block text-gray-700 hover:text-rose-600 px-3 py-2 rounded-md text-base transition-all duration-300">Coming Soon</a>
                <a href="#"
                    class="block text-gray-700 hover:text-rose-600 px-3 py-2 rounded-md text-base transition-all duration-300">Coming Soon</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full bg-gradient-to-r from-rose-600 to-red-600 text-white px-4 py-2 rounded-md text-base font-semibold text-center hover:scale-[1.02] transition-transform duration-300 shadow-md shadow-rose-600/30 mt-3">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }

    const header = document.querySelector("header");
    let lastScrollY = 0;

    // Efek muncul & sembunyi saat scroll
    function handleScroll() {
        const currentScrollY = window.scrollY;

        // Kalau scroll lebih dari 100px → tampilkan header
        if (currentScrollY > 100) {
            header.classList.add("visible");
            header.classList.add("scrolled");
        } else {
            // Kembali ke posisi awal (hilang)
            header.classList.remove("visible");
            header.classList.remove("scrolled");
        }

        lastScrollY = currentScrollY;
    }

    window.addEventListener("scroll", handleScroll);
</script>