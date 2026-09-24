@extends('layouts.app')

@section('title', 'Edit Area Parkir')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 max-w-lg">
        <form action="{{ route('area.update', $area) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Area</label>
                <input type="text" name="nama_area" value="{{ old('nama_area', $area->nama_area) }}" required class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $area->lokasi) }}" class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                <input type="number" name="kapasitas" value="{{ old('kapasitas', $area->kapasitas) }}" required min="1" class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" required class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm">
                    <option value="aktif" {{ $area->status === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ $area->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md">Perbarui</button>
                <a href="{{ route('area.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-4 py-2 rounded-md">Batal</a>
            </div>
        </form>
    </div>
@endsection
