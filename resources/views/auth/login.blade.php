<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - D'Hotels</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body
    class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 via-white to-gray-100 text-gray-800 relative overflow-hidden">

    <!-- Background Accent -->
    <div
        class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(244,63,94,0.08),transparent_60%)] pointer-events-none">
    </div>

    <!-- Login Card -->
    <div
        class="relative z-10 w-full max-w-md bg-white/80 backdrop-blur-xl border border-gray-200 rounded-2xl shadow-2xl shadow-rose-500/10 p-8 sm:p-10">
        <div class="text-center mb-8">
            <img src="https://cdn.aceimg.com/88e06bfcb.png" alt="Logo D'Hotels"
                class="w-24 h-24 mx-auto mb-3 drop-shadow-md">
            <h1 class="text-2xl font-bold text-neutral-800">Masuk ke <span
                    class="text-rose-600">D'Hotels</span></h1>
            <p class="text-sm text-gray-500 mt-1">Akses akun Anda untuk mendukung tim kesayangan!</p>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('login.process') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all duration-300 outline-none placeholder-gray-400"
                    placeholder="you@example.com">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all duration-300 outline-none placeholder-gray-400"
                    placeholder="********">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="text-rose-600 focus:ring-rose-500 rounded">
                    <span>Ingat saya</span>
                </label>
                <a href="#" class="text-rose-600 hover:text-rose-700 font-semibold">
                    Lupa Password?
                </a>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full py-3 bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-700 hover:to-red-700 text-white font-semibold rounded-lg shadow-md shadow-rose-600/30 hover:shadow-rose-600/50 transition-all duration-300">
                Masuk Sekarang
            </button>
        </form>

        <!-- Divider -->
        <div class="mt-8 flex items-center justify-center text-sm text-gray-500">
            <span class="h-px bg-gray-300 w-16"></span>
            <span class="mx-3">atau</span>
            <span class="h-px bg-gray-300 w-16"></span>
        </div>

        <!-- Register -->
        <p class="text-center text-sm mt-6 text-gray-600">
            Belum punya akun?
            <a href="#"
                class="font-semibold text-rose-600 hover:text-rose-700 transition-colors">Daftar Sekarang</a>
        </p>
    </div>

</body>

</html>