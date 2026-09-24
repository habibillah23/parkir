<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RekapTransaksiController extends Controller
{
    public function index(Request $request): View
    {
        $tanggalAwal = $request->tanggal_awal ?? now()->startOfMonth()->format('Y-m-d');
        $tanggalAkhir = $request->tanggal_akhir ?? now()->format('Y-m-d');

        $query = Transaksi::with(['kendaraan', 'areaParkir', 'petugasMasuk', 'petugasKeluar'])
            ->where('status', 'selesai')
            ->whereDate('waktu_keluar', '>=', $tanggalAwal)
            ->whereDate('waktu_keluar', '<=', $tanggalAkhir);

        $totalPendapatan = (clone $query)->sum('total_bayar');
        $totalTransaksi = (clone $query)->count();

        $transaksis = $query->latest('waktu_keluar')->paginate(15)->withQueryString();

        return view('rekap.index', compact(
            'transaksis',
            'tanggalAwal',
            'tanggalAkhir',
            'totalPendapatan',
            'totalTransaksi'
        ));
    }
}
