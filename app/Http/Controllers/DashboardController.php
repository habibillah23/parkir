<?php

namespace App\Http\Controllers;

use App\Models\AreaParkir;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $data = [
            'user' => $user,
            'kendaraanMasuk' => Transaksi::where('status', 'masuk')->count(),
            'transaksiHariIni' => Transaksi::whereDate('created_at', today())->count(),
            'pendapatanHariIni' => Transaksi::where('status', 'selesai')
                ->whereDate('waktu_keluar', today())
                ->sum('total_bayar'),
            'areaParkirs' => AreaParkir::where('status', 'aktif')->get(),
        ];

        return view('dashboard', $data);
    }
}
