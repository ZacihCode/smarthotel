<main class="lg:ml-64 min-h-screen bg-gray-50 text-gray-800 transition-all">
    <div class="p-6">
        <!-- Breadcrumb -->
        <nav class="text-sm mb-6 text-gray-500">
            <a href="#" class="hover:text-red-600">Dashboard</a>
        </nav>

        <!-- Page Title -->
        <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $title ?? 'Dashboard' }}</h1>

        <!-- Slot dari Livewire akan masuk ke sini -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            {{ $slot }}
        </div>
    </div>
</main>