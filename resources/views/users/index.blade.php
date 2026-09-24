rs index dark.blade · PHP
@extends('layouts.app')
 
@section('title', 'Data User')
 
@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-gray-100">Daftar User</h2>
        <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-md shadow-[0_0_15px_-3px_rgba(59,130,246,0.7)] transition-colors">
            + Tambah User
        </a>
    </div>
 
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_0_30px_-8px_rgba(148,163,184,0.4)] ring-1 ring-slate-700/50 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-400 border-b border-slate-700/60">
                <tr>
                    <th class="px-4 py-3 font-medium">Nama</th>
                    <th class="px-4 py-3 font-medium">Email</th>
                    <th class="px-4 py-3 font-medium">Role</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-t border-slate-800 hover:bg-white/5 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-200">{{ $user->name }}</td>
                        <td class="px-4 py-3 text-gray-400">{{ $user->email }}</td>
                        <td class="px-4 py-3 capitalize text-gray-300">{{ $user->role }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs ring-1 {{ $user->is_active ? 'bg-emerald-500/10 text-emerald-400 ring-emerald-500/30' : 'bg-slate-700/30 text-gray-400 ring-slate-600/40' }}">
                                {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 space-x-3">
                            <a href="{{ route('users.edit', $user) }}" class="text-blue-400 hover:text-blue-300 hover:underline">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Hapus user ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada data user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
 
    <div class="mt-4 text-gray-300">{{ $users->links() }}</div>
@endsection
 