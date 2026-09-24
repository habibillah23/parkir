@extends('layouts.app')

@section('title', 'Log Aktivitas')

@section('content')
    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari user / aktivitas..."
               class="bg-slate-900 border border-slate-700 text-gray-200 placeholder-gray-500 rounded-md px-3 py-2 text-sm w-full max-w-xs focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
    </form>

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_0_30px_-8px_rgba(148,163,184,0.4)] ring-1 ring-slate-700/50 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-400 border-b border-slate-700/60">
                <tr>
                    <th class="px-4 py-3 font-medium">Waktu</th>
                    <th class="px-4 py-3 font-medium">User</th>
                    <th class="px-4 py-3 font-medium">Role</th>
                    <th class="px-4 py-3 font-medium">Aktivitas</th>
                    <th class="px-4 py-3 font-medium">IP</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr class="border-t border-slate-800 hover:bg-white/5 transition-colors">
                        <td class="px-4 py-3 whitespace-nowrap text-gray-400">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3 font-medium text-gray-200">{{ $log->nama_user ?? '-' }}</td>
                        <td class="px-4 py-3 capitalize text-gray-300">{{ $log->role ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-300">{{ $log->aktivitas }}</td>
                        <td class="px-4 py-3 text-gray-400">{{ $log->ip_address ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada log aktivitas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-gray-300">{{ $logs->links() }}</div>
@endsection