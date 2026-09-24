@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- Page header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-sm text-gray-500">Ringkasan aktivitas parkir hari ini</p>
    </div>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

        {{-- Kendaraan Sedang Parkir --}}
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-blue-950 p-5 text-white shadow-[0_0_25px_-5px_rgba(59,130,246,0.6)] ring-1 ring-blue-500/30">
            <div class="absolute -right-6 -top-6 h-28 w-28 rounded-full bg-blue-500/20 blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-300/80">Kendaraan Sedang Parkir</p>
                    <p class="text-3xl font-bold mt-1 text-blue-400 drop-shadow-[0_0_10px_rgba(96,165,250,0.8)]">{{ $kendaraanMasuk }}</p>
                </div>
                <div class="bg-blue-500/10 rounded-xl p-3 ring-1 ring-blue-400/40">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 17h14M5 17a2 2 0 01-2-2v-2.5a2 2 0 01.4-1.2l1.6-2.13A2 2 0 016.6 8h10.8a2 2 0 011.6.87l1.6 2.13a2 2 0 01.4 1.2V15a2 2 0 01-2 2M5 17a2 2 0 002 2h1a2 2 0 002-2m6 0a2 2 0 002 2h1a2 2 0 002-2M6 12h12"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Transaksi Hari Ini --}}
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-emerald-950 p-5 text-white shadow-[0_0_25px_-5px_rgba(16,185,129,0.6)] ring-1 ring-emerald-500/30">
            <div class="absolute -right-6 -top-6 h-28 w-28 rounded-full bg-emerald-500/20 blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-sm text-emerald-300/80">Transaksi Hari Ini</p>
                    <p class="text-3xl font-bold mt-1 text-emerald-400 drop-shadow-[0_0_10px_rgba(52,211,153,0.8)]">{{ $transaksiHariIni }}</p>
                </div>
                <div class="bg-emerald-500/10 rounded-xl p-3 ring-1 ring-emerald-400/40">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 17V7m0 10a2 2 0 11-4 0 2 2 0 014 0zm10 0a2 2 0 11-4 0 2 2 0 014 0zM5 7h13l1 5H4l1-5z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Pendapatan Hari Ini --}}
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-amber-950 p-5 text-white shadow-[0_0_25px_-5px_rgba(245,158,11,0.6)] ring-1 ring-amber-500/30">
            <div class="absolute -right-6 -top-6 h-28 w-28 rounded-full bg-amber-500/20 blur-2xl"></div>
            <div class="relative flex items-center justify-between">
                <div>
                    <p class="text-sm text-amber-300/80">Pendapatan Hari Ini</p>
                    <p class="text-2xl font-bold mt-1 text-amber-400 drop-shadow-[0_0_10px_rgba(251,191,36,0.8)]">Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="bg-amber-500/10 rounded-xl p-3 ring-1 ring-amber-400/40">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 10v2m0-12a9 9 0 100 18 9 9 0 000-18z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Status Area Parkir --}}
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 p-6 text-white shadow-[0_0_30px_-8px_rgba(148,163,184,0.4)] ring-1 ring-slate-700/50">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-semibold text-gray-100 text-lg">Status Area Parkir</h2>
            <span class="text-xs font-medium text-gray-500">{{ count($areaParkirs) }} area</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-400 border-b border-slate-700/60">
                        <th class="py-3 font-medium">Area</th>
                        <th class="py-3 font-medium">Kapasitas</th>
                        <th class="py-3 font-medium">Terpakai</th>
                        <th class="py-3 font-medium">Sisa</th>
                        <th class="py-3 font-medium w-48">Okupansi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($areaParkirs as $area)
                        @php
                            $terpakai = $area->kapasitasTerpakai();
                            $sisa = $area->kapasitas - $terpakai;
                            $persen = $area->kapasitas > 0 ? round(($terpakai / $area->kapasitas) * 100) : 0;

                            $dotColor = 'bg-emerald-400 shadow-[0_0_6px_2px_rgba(52,211,153,0.8)]';
                            $barColor = 'bg-emerald-400 shadow-[0_0_6px_rgba(52,211,153,0.8)]';
                            if ($persen >= 90) {
                                $dotColor = 'bg-red-400 shadow-[0_0_6px_2px_rgba(248,113,113,0.8)]';
                                $barColor = 'bg-red-400 shadow-[0_0_6px_rgba(248,113,113,0.8)]';
                            } elseif ($persen >= 60) {
                                $dotColor = 'bg-amber-400 shadow-[0_0_6px_2px_rgba(251,191,36,0.8)]';
                                $barColor = 'bg-amber-400 shadow-[0_0_6px_rgba(251,191,36,0.8)]';
                            }
                        @endphp
                        <tr class="border-b border-slate-800 last:border-0 hover:bg-white/5 transition-colors">
                            <td class="py-3">
                                <div class="flex items-center gap-2">
                                    <span class="h-2 w-2 rounded-full {{ $dotColor }}"></span>
                                    <span class="font-medium text-gray-200">{{ $area->nama_area }}</span>
                                </div>
                            </td>
                            <td class="py-3 text-gray-400">{{ $area->kapasitas }}</td>
                            <td class="py-3 text-gray-400">{{ $terpakai }}</td>
                            <td class="py-3 text-gray-400">{{ $sisa }}</td>
                            <td class="py-3">
                                <div class="flex items-center gap-2">
                                    <div class="flex-1 h-2 rounded-full bg-slate-800 overflow-hidden">
                                        <div class="h-full {{ $barColor }} rounded-full transition-all" style="width: {{ $persen }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-400 w-10 text-right">{{ $persen }}%</span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500">
                                Belum ada area parkir.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection