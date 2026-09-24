@extends('layouts.app')

@section('title', 'Proses Kendaraan Keluar')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 max-w-lg">
        <dl class="space-y-2 text-sm mb-6">
            <div class="flex justify-between"><dt class="text-gray-500">No. Tiket</dt><dd class="font-medium">{{ $transaksi->no_tiket }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Plat Nomor</dt><dd class="font-medium">{{ $transaksi->kendaraan->plat_nomor }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Jenis Kendaraan</dt><dd class="capitalize">{{ $transaksi->kendaraan->jenis_kendaraan }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Area</dt><dd>{{ $transaksi->areaParkir->nama_area }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Waktu Masuk</dt><dd>{{ $transaksi->waktu_masuk->format('d/m/Y H:i') }}</dd></div>
            <div class="flex justify-between"><dt class="text-gray-500">Durasi Saat Ini</dt><dd>{{ $durasiMenit }} menit</dd></div>
            <div class="flex justify-between text-base pt-2 border-t"><dt class="font-semibold">Estimasi Biaya</dt><dd class="font-bold text-blue-600">Rp {{ number_format($estimasiBayar, 0, ',', '.') }}</dd></div>
        </dl>

        <p class="text-xs text-gray-400 mb-4">Biaya final akan dihitung ulang berdasarkan waktu saat tombol "Proses Keluar" ditekan.</p>

        <form action="{{ route('transaksi.keluar', $transaksi) }}" method="POST" class="flex gap-2">
            @csrf
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-md">Proses Keluar & Cetak Struk</button>
            <a href="{{ route('transaksi.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-4 py-2 rounded-md">Batal</a>
        </form>
    </div>
@endsection
