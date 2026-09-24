@extends('layouts.app')

@section('title', 'Rekap Transaksi')

@section('content')
    <form method="GET" class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_0_30px_-8px_rgba(148,163,184,0.4)] ring-1 ring-slate-700/50 p-4 mb-6 flex flex-wrap gap-3 items-end">
        <div>
            <label class="block text-xs font-medium text-gray-400 mb-1">Tanggal Awal</label>
            <input type="date" name="tanggal_awal" value="{{ $tanggalAwal }}"
                   class="bg-slate-800/60 border border-slate-700 text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-400 mb-1">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" value="{{ $tanggalAkhir }}"
                   class="bg-slate-800/60 border border-slate-700 text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
        </div>
        <button class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-md shadow-[0_0_15px_-3px_rgba(59,130,246,0.7)] transition-colors">
            Tampilkan
        </button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-blue-950 p-5 text-white shadow-[0_0_25px_-5px_rgba(59,130,246,0.6)] ring-1 ring-blue-500/30">
            <div class="absolute -right-6 -top-6 h-28 w-28 rounded-full bg-blue-500/20 blur-2xl"></div>
            <div class="relative">
                <p class="text-sm text-blue-300/80">Total Transaksi</p>
                <p class="text-2xl font-bold mt-1 text-blue-400 drop-shadow-[0_0_10px_rgba(96,165,250,0.8)]">{{ $totalTransaksi }}</p>
            </div>
        </div>
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-emerald-950 p-5 text-white shadow-[0_0_25px_-5px_rgba(16,185,129,0.6)] ring-1 ring-emerald-500/30">
            <div class="absolute -right-6 -top-6 h-28 w-28 rounded-full bg-emerald-500/20 blur-2xl"></div>
            <div class="relative">
                <p class="text-sm text-emerald-300/80">Total Pendapatan</p>
                <p class="text-2xl font-bold mt-1 text-emerald-400 drop-shadow-[0_0_10px_rgba(52,211,153,0.8)]">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_0_30px_-8px_rgba(148,163,184,0.4)] ring-1 ring-slate-700/50 overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="text-left text-gray-400 border-b border-slate-700/60">
                <tr>
                    <th class="px-4 py-3 font-medium">No. Tiket</th>
                    <th class="px-4 py-3 font-medium">Plat Nomor</th>
                    <th class="px-4 py-3 font-medium">Area</th>
                    <th class="px-4 py-3 font-medium">Masuk</th>
                    <th class="px-4 py-3 font-medium">Keluar</th>
                    <th class="px-4 py-3 font-medium">Petugas</th>
                    <th class="px-4 py-3 font-medium">Total Bayar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $t)
                    <tr class="border-t border-slate-800 hover:bg-white/5 transition-colors">
                        <td class="px-4 py-3 text-gray-400">{{ $t->no_tiket }}</td>
                        <td class="px-4 py-3 font-medium text-gray-200">{{ $t->kendaraan->plat_nomor }}</td>
                        <td class="px-4 py-3 text-gray-300">{{ $t->areaParkir->nama_area }}</td>
                        <td class="px-4 py-3 text-gray-400">{{ $t->waktu_masuk->format('d/m/y H:i') }}</td>
                        <td class="px-4 py-3 text-gray-400">{{ $t->waktu_keluar?->format('d/m/y H:i') }}</td>
                        <td class="px-4 py-3 text-gray-300">{{ $t->petugasKeluar->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-200">Rp {{ number_format($t->total_bayar, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-6 text-center text-gray-500">Tidak ada transaksi pada rentang tanggal ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 text-gray-300">{{ $transaksis->links() }}</div>
@endsection