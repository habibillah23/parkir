@extends('layouts.app')

@section('title', 'Edit Kendaraan')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 max-w-lg">
        <form action="{{ route('kendaraan.update', $kendaraan) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Plat Nomor</label>
                <input type="text" name="plat_nomor" value="{{ old('plat_nomor', $kendaraan->plat_nomor) }}" required class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm uppercase">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kendaraan</label>
                <select name="jenis_kendaraan" required class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm">
                    @foreach (['motor', 'mobil', 'truk', 'bus'] as $jenis)
                        <option value="{{ $jenis }}" {{ $kendaraan->jenis_kendaraan === $jenis ? 'selected' : '' }}>{{ ucfirst($jenis) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik</label>
                <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik', $kendaraan->nama_pemilik) }}" class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">No. Telp</label>
                <input type="text" name="no_telp" value="{{ old('no_telp', $kendaraan->no_telp) }}" class="w-full border-gray-300 rounded-md border px-3 py-2 text-sm">
            </div>
            <div class="flex gap-2 pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md">Perbarui</button>
                <a href="{{ route('kendaraan.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-4 py-2 rounded-md">Batal</a>
            </div>
        </form>
    </div>
@endsection
