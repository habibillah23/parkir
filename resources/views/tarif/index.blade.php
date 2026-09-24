@extends('layouts.app')

@section('title', 'Tarif Parkir')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-gray-100">Daftar Tarif Parkir</h2>
        <a href="{{ route('tarif.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-md shadow-[0_0_15px_-3px_rgba(59,130,246,0.7)] transition-colors">
            + Tambah Tarif
        </a>
    </div>

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_0_30px_-8px_rgba(148,163,184,0.4)] ring-1 ring-slate-700/50 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-400 border-b border-slate-700/60">
                <tr>
                    <th class="px-4 py-3 font-medium">Jenis Kendaraan</th>
                    <th class="px-4 py-3 font-medium">Jam Pertama</th>
                    <th class="px-4 py-3 font-medium">Jam Berikutnya</th>
                    <th class="px-4 py-3 font-medium">Maksimal Harian</th>
                    <th class="px-4 py-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tarifs as $tarif)
                    <tr class="border-t border-slate-800 hover:bg-white/5 transition-colors">
                        <td class="px-4 py-3 capitalize font-medium text-gray-200">{{ $tarif->jenis_kendaraan }}</td>
                        <td class="px-4 py-3 text-gray-300">Rp {{ number_format($tarif->tarif_jam_pertama, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-gray-300">Rp {{ number_format($tarif->tarif_jam_berikutnya, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-gray-400">{{ $tarif->tarif_maksimal_harian ? 'Rp ' . number_format($tarif->tarif_maksimal_harian, 0, ',', '.') : '-' }}</td>
                        <td class="px-4 py-3 space-x-3">
                            <a href="{{ route('tarif.edit', $tarif) }}" class="text-blue-400 hover:text-blue-300 hover:underline">Edit</a>
                            <form action="{{ route('tarif.destroy', $tarif) }}" method="POST" class="inline" onsubmit="return confirm('Hapus tarif ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada tarif parkir.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-gray-300">{{ $tarifs->links() }}</div>
@endsection