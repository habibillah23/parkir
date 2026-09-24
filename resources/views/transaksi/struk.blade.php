<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Parkir - {{ $transaksi->no_tiket }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-8">
    <div class="w-full max-w-xs bg-white shadow-lg rounded-md p-5 font-mono text-sm">
        <div class="text-center mb-3">
            <p class="font-bold text-base">🅿️ STRUK PARKIR</p>
            <p class="text-xs text-gray-500">Sistem Parkir</p>
        </div>
        <hr class="border-dashed my-2">
        <div class="space-y-1">
            <div class="flex justify-between"><span>No. Tiket</span><span>{{ $transaksi->no_tiket }}</span></div>
            <div class="flex justify-between"><span>Plat Nomor</span><span>{{ $transaksi->kendaraan->plat_nomor }}</span></div>
            <div class="flex justify-between"><span>Jenis</span><span class="capitalize">{{ $transaksi->kendaraan->jenis_kendaraan }}</span></div>
            <div class="flex justify-between"><span>Area</span><span>{{ $transaksi->areaParkir->nama_area }}</span></div>
            <div class="flex justify-between"><span>Masuk</span><span>{{ $transaksi->waktu_masuk->format('d/m/y H:i') }}</span></div>
            @if ($transaksi->status === 'selesai')
                <div class="flex justify-between"><span>Keluar</span><span>{{ $transaksi->waktu_keluar->format('d/m/y H:i') }}</span></div>
                <div class="flex justify-between"><span>Durasi</span><span>{{ $transaksi->waktu_masuk->diffInMinutes($transaksi->waktu_keluar) }} menit</span></div>
            @endif
            <div class="flex justify-between"><span>Petugas</span><span>{{ $transaksi->petugasMasuk->name }}</span></div>
        </div>
        <hr class="border-dashed my-2">
        @if ($transaksi->status === 'selesai')
            <div class="flex justify-between font-bold text-base">
                <span>TOTAL</span>
                <span>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
            </div>
        @else
            <p class="text-center text-xs text-gray-500">Tiket masuk — simpan untuk proses keluar.</p>
        @endif
        <hr class="border-dashed my-2">
        <p class="text-center text-xs text-gray-400">Terima kasih</p>

        <div class="no-print mt-4 flex gap-2">
            <button onclick="window.print()" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-md">🖨️ Cetak</button>
            <a href="{{ route('transaksi.index') }}" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm px-4 py-2 rounded-md">Kembali</a>
        </div>
    </div>
</body>
</html>
