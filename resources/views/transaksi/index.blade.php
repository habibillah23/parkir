@extends('layouts.app')

@section('title', 'Transaksi Parkir')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-gray-100">Daftar Transaksi</h2>
        <a href="{{ route('transaksi.create') }}" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-md shadow-[0_0_15px_-3px_rgba(59,130,246,0.7)] transition-colors">
            + Catat Kendaraan Masuk
        </a>
    </div>

    <form method="GET" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari plat nomor..."
               class="bg-slate-900 border border-slate-700 text-gray-200 placeholder-gray-500 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
        <select name="status" class="bg-slate-900 border border-slate-700 text-gray-200 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            <option value="">Semua Status</option>
            <option value="masuk" {{ request('status') === 'masuk' ? 'selected' : '' }}>Masuk</option>
            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        <button class="bg-slate-800 hover:bg-slate-700 text-gray-200 text-sm px-4 py-2 rounded-md border border-slate-700 transition-colors">Filter</button>
    </form>

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_0_30px_-8px_rgba(148,163,184,0.4)] ring-1 ring-slate-700/50 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-400 border-b border-slate-700/60">
                <tr>
                    <th class="px-4 py-3 font-medium">No. Tiket</th>
                    <th class="px-4 py-3 font-medium">Plat Nomor</th>
                    <th class="px-4 py-3 font-medium">Area</th>
                    <th class="px-4 py-3 font-medium">Waktu Masuk</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $t)
                    <tr class="border-t border-slate-800 hover:bg-white/5 transition-colors">
                        <td class="px-4 py-3 text-gray-400">{{ $t->no_tiket }}</td>
                        <td class="px-4 py-3 font-medium text-gray-200">{{ $t->kendaraan->plat_nomor }}</td>
                        <td class="px-4 py-3 text-gray-300">{{ $t->areaParkir->nama_area }}</td>
                        <td class="px-4 py-3 text-gray-400">{{ $t->waktu_masuk->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded-full text-xs ring-1 {{ $t->status === 'masuk' ? 'bg-amber-500/10 text-amber-400 ring-amber-500/30' : 'bg-emerald-500/10 text-emerald-400 ring-emerald-500/30' }}">
                                {{ ucfirst($t->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 space-x-3">
                            @if ($t->status === 'masuk')
                                <a href="{{ route('transaksi.keluar-form', $t) }}" class="text-amber-400 hover:text-amber-300 hover:underline">Proses Keluar</a>
                            @endif
                            <a href="{{ route('transaksi.struk', $t) }}" class="text-blue-400 hover:text-blue-300 hover:underline">Cetak Struk</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-gray-300">{{ $transaksis->links() }}</div>
@endsection