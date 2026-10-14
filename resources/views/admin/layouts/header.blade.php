<header class="bg-gradient-to-r from-rose-800 via-red-700 to-rose-900 shadow-lg sticky top-0 z-50">
    <div class="flex items-center justify-between px-4 py-4 lg:px-6">
        <!-- Logo & Menu Toggle -->
        <div class="flex items-center gap-4">
            <button id="sidebarToggle" class="text-white hover:bg-white/10 p-2 rounded-lg transition-all lg:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                    <span class="text-red-700 font-bold text-xl">SU</span>
                </div>
                <div class="hidden sm:block">
                    <h1 class="text-white font-bold text-lg">D'Hotels</h1>
                    <p class="text-red-100 text-xs">Admin Dashboard</p>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="flex items-center gap-2 sm:gap-4">
            <!-- Notifications -->
            <button class="relative text-white hover:bg-white/10 p-2 rounded-lg transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <span class="absolute top-1 right-1 w-2 h-2 bg-yellow-400 rounded-full"></span>
            </button>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-2 hover:bg-white/10 p-2 rounded-lg transition-all">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=fff&color=dc2626"
                        alt="Admin" class="w-8 h-8 rounded-full">
                    <span class="hidden sm:block text-white font-medium">Admin</span>
                    <svg class="w-4 h-4 text-white hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 z-50">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-red-50 transition-colors">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-red-50 transition-colors">
                        <i class="fas fa-cog mr-2"></i> Pengaturan
                    </a>
                    <hr class="my-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition-colors">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Toggle sidebar on mobile
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('-translate-x-full');
        document.getElementById('sidebarOverlay').classList.toggle('hidden');
    });
</script>