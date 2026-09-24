@extends('layouts.app')

@section('title', 'Edit Tarif Parkir')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 max-w-lg">
        <form action="{{ route('tarif.update', $tarif) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" required class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm">
                    @foreach (['motor', 'mobil', 'truk', 'bus'] as $jenis)
                        <option value="{{ $jenis }}" {{ $tarif->jenis_kendaraan === $jenis ? 'selected' : '' }}>{{ ucfirst($jenis) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tarif Jam Pertama (Rp)</label>
                <input type="number" name="tarif_jam_pertama" value="{{ old('tarif_jam_pertama', $tarif->tarif_jam_pertama) }}" required min="0" class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tarif Jam Berikutnya (Rp)</label>
                <input type="number" name="tarif_jam_berikutnya" value="{{ old('tarif_jam_berikutnya', $tarif->tarif_jam_berikutnya) }}" required min="0" class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tarif Maksimal Harian (Rp)</label>
                <input type="number" name="tarif_maksimal_harian" value="{{ old('tarif_maksimal_harian', $tarif->tarif_maksimal_harian) }}" min="0" class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm">
            </div>
            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md">Perbarui</button>
                <a href="{{ route('tarif.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-4 py-2 rounded-md">Batal</a>
            </div>
        </form>
    </div>
@endsection
