<aside id="sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-full bg-gradient-to-b from-rose-800 via-red-700 to-rose-900 text-white transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="flex items-center justify-center h-16 border-b border-white/10">
        <h2 class="text-xl font-bold tracking-wide">⚽ Admin Panel</h2>
    </div>

    <nav class="mt-4 px-3 space-y-1">
        <!-- Dashboard -->
        <a href="#"
            class="flex items-center px-4 py-2 rounded-lg hover:bg-white/10 transition-all {{ request()->is('admin/dashboard') ? 'bg-white/20' : '' }}">
            <i class="fas fa-home w-5"></i>
            <span class="ml-3">Dashboard</span>
        </a>

        <!-- Manajemen User -->
        <a href="{{ route('user') }}"
            class="flex items-center px-4 py-2 rounded-lg hover:bg-white/10 transition-all {{ request()->is('admin/news*') ? 'bg-white/20' : '' }}">
            <i class="fas fa-users w-5"></i>
            <span class="ml-3">Manajemen User</span>
        </a>

        <!-- Manajemen Kamar -->
        <a href="{{ route('kamar') }}"
            class="flex items-center px-4 py-2 rounded-lg hover:bg-white/10 transition-all {{ request()->is('admin/kamar*') ? 'bg-white/20' : '' }}">
            <i class="fa-solid fa-door-open w-5"></i>
            <span class="ml-3">Manajemen Kamar</span>
        </a>

        <!-- Manajemen Reservasi -->
        <a href="{{ route('reservasis') }}"
            class="flex items-center px-4 py-2 rounded-lg hover:bg-white/10 transition-all {{ request()->is('admin/matches*') ? 'bg-white/20' : '' }}">
            <i class="fa-solid fa-ticket w-5"></i>
            <span class="ml-3">Manajemen Reservasi</span>
        </a>

    </nav>

    <div class="absolute bottom-0 w-full border-t border-white/10 p-4">
        <p class="text-xs text-white/70 text-center">
            © {{ date('Y') }} D'Hotel
        </p>
    </div>
</aside>

<!-- Overlay for mobile -->
<div id="sidebarOverlay"
    class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden"
    onclick="document.getElementById('sidebar').classList.add('-translate-x-full'); this.classList.add('hidden');">
</div>