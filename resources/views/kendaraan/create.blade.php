@extends('layouts.app')

@section('title', 'Tambah Kendaraan')

@section('content')
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_0_30px_-8px_rgba(148,163,184,0.4)] ring-1 ring-slate-700/50 p-6 max-w-lg">
        <form action="{{ route('kendaraan.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Plat Nomor</label>
                <input type="text" name="plat_nomor" value="{{ old('plat_nomor') }}" required
                       class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 placeholder-gray-500 rounded-md px-3 py-2 text-sm uppercase focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" required
                        class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
                    <option value="motor" {{ old('jenis_kendaraan') === 'motor' ? 'selected' : '' }}>Motor</option>
                    <option value="mobil" {{ old('jenis_kendaraan') === 'mobil' ? 'selected' : '' }}>Mobil</option>
                    <option value="truk" {{ old('jenis_kendaraan') === 'truk' ? 'selected' : '' }}>Truk</option>
                    <option value="bus" {{ old('jenis_kendaraan') === 'bus' ? 'selected' : '' }}>Bus</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Nama Pemilik</label>
                <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik') }}"
                       class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 placeholder-gray-500 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">No. Telp</label>
                <input type="text" name="no_telp" value="{{ old('no_telp') }}"
                       class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 placeholder-gray-500 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            </div>
            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-md shadow-[0_0_15px_-3px_rgba(59,130,246,0.7)] transition-colors">
                    Simpan
                </button>
                <a href="{{ route('kendaraan.index') }}" class="bg-slate-800 hover:bg-slate-700 text-gray-200 text-sm px-4 py-2 rounded-md border border-slate-700 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection