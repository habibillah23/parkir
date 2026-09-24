<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Parkir')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
     
</head>
<body class="bg-slate-950 min-h-screen">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-slate-900 text-slate-100 flex flex-col border-r border-slate-800">
            <div class="px-6 py-5 text-xl font-bold border-b border-slate-800">
                🅿️ Parkir App
            </div>
            <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
                <a href="{{ route('dashboard') }}"
                   class="block px-3 py-2 rounded-md hover:bg-slate-800 {{ request()->routeIs('dashboard') ? 'bg-slate-800' : '' }}">
                    Dashboard
                </a>

                @auth
                    @if (auth()->user()->role === 'admin')
                        <p class="pt-4 pb-1 px-3 text-xs uppercase tracking-wide text-slate-500">Manajemen</p>
                        <a href="{{ route('users.index') }}" class="block px-3 py-2 rounded-md hover:bg-slate-800 {{ request()->routeIs('users.*') ? 'bg-slate-800' : '' }}">Data User</a>
                        <a href="{{ route('tarif.index') }}" class="block px-3 py-2 rounded-md hover:bg-slate-800 {{ request()->routeIs('tarif.*') ? 'bg-slate-800' : '' }}">Tarif Parkir</a>
                        <a href="{{ route('area.index') }}" class="block px-3 py-2 rounded-md hover:bg-slate-800 {{ request()->routeIs('area.*') ? 'bg-slate-800' : '' }}">Area Parkir</a>
                        <a href="{{ route('kendaraan.index') }}" class="block px-3 py-2 rounded-md hover:bg-slate-800 {{ request()->routeIs('kendaraan.*') ? 'bg-slate-800' : '' }}">Data Kendaraan</a>
                        <a href="{{ route('logs.index') }}" class="block px-3 py-2 rounded-md hover:bg-slate-800 {{ request()->routeIs('logs.*') ? 'bg-slate-800' : '' }}">Log Aktivitas</a>
                    @endif

                    @if (auth()->user()->role === 'petugas')
                        <p class="pt-4 pb-1 px-3 text-xs uppercase tracking-wide text-slate-500">Operasional</p>
                        <a href="{{ route('transaksi.index') }}" class="block px-3 py-2 rounded-md hover:bg-slate-800 {{ request()->routeIs('transaksi.*') ? 'bg-slate-800' : '' }}">Transaksi Parkir</a>
                        <a href="{{ route('transaksi.create') }}" class="block px-3 py-2 rounded-md hover:bg-slate-800 {{ request()->routeIs('transaksi.create') ? 'bg-slate-800' : '' }}">Catat Kendaraan Masuk</a>
                    @endif

                    @if (auth()->user()->role === 'owner')
                        <p class="pt-4 pb-1 px-3 text-xs uppercase tracking-wide text-slate-500">Laporan</p>
                        <a href="{{ route('rekap.index') }}" class="block px-3 py-2 rounded-md hover:bg-slate-800 {{ request()->routeIs('rekap.*') ? 'bg-slate-800' : '' }}">Rekap Transaksi</a>
                    @endif
                @endauth
            </nav>
            @auth
            <div class="p-3 border-t border-slate-800">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-md hover:bg-red-600 text-sm">
                        🚪 Logout
                    </button>
                </form>
            </div>
            @endauth
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <header class="bg-slate-900 border-b border-slate-800 shadow px-6 py-4 flex justify-between items-center">
                <h1 class="text-lg font-semibold text-gray-100">@yield('title', 'Dashboard')</h1>
                @auth
                <div class="text-sm text-gray-400">
                    {{ auth()->user()->name }}
                    <span class="ml-2 inline-block px-2 py-0.5 rounded-full bg-blue-500/10 text-blue-400 ring-1 ring-blue-500/30 text-xs uppercase">{{ auth()->user()->role }}</span>
                </div>
                @endauth
            </header>

            <main class="flex-1 p-6">
                @if (session('success'))
                    <div class="mb-4 rounded-md bg-emerald-500/10 text-emerald-400 ring-1 ring-emerald-500/30 px-4 py-3 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 rounded-md bg-red-500/10 text-red-400 ring-1 ring-red-500/30 px-4 py-3 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>