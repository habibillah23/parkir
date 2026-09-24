<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Parkir</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 min-h-screen flex items-center justify-center relative overflow-hidden">

    <!-- Ambient glow blobs -->
    <div class="absolute -top-24 -left-24 h-72 w-72 rounded-full bg-blue-600/20 blur-3xl"></div>
    <div class="absolute -bottom-24 -right-24 h-72 w-72 rounded-full bg-emerald-600/10 blur-3xl"></div>

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_0_40px_-8px_rgba(59,130,246,0.35)] ring-1 ring-slate-700/50 w-full max-w-sm p-8">
        <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-blue-500/10 blur-2xl"></div>

        <div class="relative text-center mb-8">
            <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-500/10 ring-1 ring-blue-400/40 shadow-[0_0_20px_-4px_rgba(59,130,246,0.7)]">
                <span class="text-2xl font-bold text-blue-400 drop-shadow-[0_0_8px_rgba(96,165,250,0.8)]">P</span>
            </div>
            <h1 class="text-xl font-bold text-gray-100">Sistem Parkir</h1>
            <p class="text-sm text-gray-400 mt-1">Silakan login untuk melanjutkan</p>
        </div>

        @if ($errors->any())
            <div class="relative mb-4 rounded-md bg-red-500/10 text-red-400 ring-1 ring-red-500/30 px-4 py-3 text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="relative space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 placeholder-gray-500 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 placeholder-gray-500 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            </div>
            <label class="flex items-center gap-2 text-sm text-gray-400">
                <input type="checkbox" name="remember" class="rounded border-slate-600 bg-slate-800 text-blue-500 focus:ring-blue-500/50">
                Ingat saya
            </label>
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-medium py-2 rounded-md text-sm shadow-[0_0_20px_-4px_rgba(59,130,246,0.8)] transition-colors">
                Login
            </button>
        </form>

        <p class="relative text-center text-sm text-gray-400 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 hover:underline font-medium">Daftar</a>
        </p>
    </div>
</body>
</html>