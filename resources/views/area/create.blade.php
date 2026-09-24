@extends('layouts.app')

@section('title', 'Tambah Area Parkir')

@section('content')
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 to-slate-950 shadow-[0_0_30px_-8px_rgba(148,163,184,0.4)] ring-1 ring-slate-700/50 p-6 max-w-lg">
        <form action="{{ route('area.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Nama Area</label>
                <input type="text" name="nama_area" value="{{ old('nama_area') }}" required
                       class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 placeholder-gray-500 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                       class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 placeholder-gray-500 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Kapasitas</label>
                <input type="number" name="kapasitas" value="{{ old('kapasitas') }}" required min="1"
                       class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 placeholder-gray-500 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                <select name="status" required
                        class="w-full bg-slate-800/60 border border-slate-700 text-gray-100 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white text-sm px-4 py-2 rounded-md shadow-[0_0_15px_-3px_rgba(59,130,246,0.7)] transition-colors">
                    Simpan
                </button>
                <a href="{{ route('area.index') }}" class="bg-slate-800 hover:bg-slate-700 text-gray-200 text-sm px-4 py-2 rounded-md border border-slate-700 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection