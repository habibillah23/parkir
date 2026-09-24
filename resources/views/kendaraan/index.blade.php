@extends('layouts.app')

@section('title', 'Data Kendaraan')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-gray-100">Daftar Kendaraan</h2>
        <a href="{{ route('kendaraan.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-md shadow-[0_0_15px_-3px_rgba(59,130,246,0.7)] transition-colors">
            + Tambah Kendaraan
        </a>
    </div>

    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari plat nomor / pemilik..."
               class="bg-slate-900 border border-slate-700 text-gray-200 placeholder-gray-500 rounded-md px-3 py-2 text-sm w-full max-w-xs focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
    </form>

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_0_30px_-8px_rgba(148,163,184,0.4)] ring-1 ring-slate-700/50 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-400 border-b border-slate-700/60">
                <tr>
                    <th class="px-4 py-3 font-medium">Plat Nomor</th>
                    <th class="px-4 py-3 font-medium">Jenis</th>
                    <th class="px-4 py-3 font-medium">Pemilik</th>
                    <th class="px-4 py-3 font-medium">No. Telp</th>
                    <th class="px-4 py-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kendaraans as $kendaraan)
                    <tr class="border-t border-slate-800 hover:bg-white/5 transition-colors">
                        <td class="px-4 py-3 font-medium text-gray-200">{{ $kendaraan->plat_nomor }}</td>
                        <td class="px-4 py-3 capitalize text-gray-300">{{ $kendaraan->jenis_kendaraan }}</td>
                        <td class="px-4 py-3 text-gray-300">{{ $kendaraan->nama_pemilik ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-400">{{ $kendaraan->no_telp ?? '-' }}</td>
                        <td class="px-4 py-3 space-x-3">
                            <a href="{{ route('kendaraan.edit', $kendaraan) }}" class="text-blue-400 hover:text-blue-300 hover:underline">Edit</a>
                            <form action="{{ route('kendaraan.destroy', $kendaraan) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kendaraan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada data kendaraan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-gray-300">{{ $kendaraans->links() }}</div>
@endsection