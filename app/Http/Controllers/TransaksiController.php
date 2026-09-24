<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\AreaParkir;
use App\Models\Kendaraan;
use App\Models\TarifParkir;
use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    public function index(Request $request): View
    {
        $transaksis = Transaksi::with(['kendaraan', 'areaParkir'])
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->when($request->search, function ($q, $search) {
                $q->whereHas('kendaraan', fn ($qq) => $qq->where('plat_nomor', 'like', "%{$search}%"));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('transaksi.index', compact('transaksis'));
    }

    public function create(): View
    {
        $areas = AreaParkir::where('status', 'aktif')->get();

        return view('transaksi.create', compact('areas'));
    }

    /**
     * Catat kendaraan masuk.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'plat_nomor' => ['required', 'string', 'max:20'],
            'jenis_kendaraan' => ['required', 'in:motor,mobil,truk,bus'],
            'nama_pemilik' => ['nullable', 'string', 'max:255'],
            'area_parkir_id' => ['required', 'exists:area_parkirs,id'],
        ]);

        $tarif = TarifParkir::where('jenis_kendaraan', $data['jenis_kendaraan'])->first();

        if (! $tarif) {
            return back()->withErrors(['jenis_kendaraan' => 'Tarif untuk jenis kendaraan ini belum diatur. Hubungi admin.']);
        }

        $transaksi = DB::transaction(function () use ($data, $tarif) {
            $kendaraan = Kendaraan::firstOrCreate(
                ['plat_nomor' => strtoupper($data['plat_nomor'])],
                [
                    'jenis_kendaraan' => $data['jenis_kendaraan'],
                    'nama_pemilik' => $data['nama_pemilik'] ?? null,
                ]
            );

            return Transaksi::create([
                'no_tiket' => 'PK-' . now()->format('ymd') . '-' . Str::upper(Str::random(5)),
                'kendaraan_id' => $kendaraan->id,
                'area_parkir_id' => $data['area_parkir_id'],
                'tarif_parkir_id' => $tarif->id,
                'petugas_masuk_id' => Auth::id(),
                'waktu_masuk' => now(),
                'status' => 'masuk',
            ]);
        });

        ActivityLogger::log("Kendaraan masuk: {$transaksi->kendaraan->plat_nomor} (tiket {$transaksi->no_tiket})");

        return redirect()->route('transaksi.struk', $transaksi)->with('success', 'Kendaraan berhasil dicatat masuk.');
    }

    /**
     * Form proses kendaraan keluar.
     */
    public function keluarForm(Transaksi $transaksi): View
    {
        abort_if($transaksi->status !== 'masuk', 400, 'Transaksi ini sudah selesai.');

        $durasiMenit = now()->diffInMinutes($transaksi->waktu_masuk);
        $estimasiBayar = $transaksi->tarifParkir->hitungBiaya($durasiMenit);

        return view('transaksi.keluar', compact('transaksi', 'durasiMenit', 'estimasiBayar'));
    }

    /**
     * Proses kendaraan keluar & hitung biaya.
     */
    public function keluar(Transaksi $transaksi): RedirectResponse
    {
        abort_if($transaksi->status !== 'masuk', 400, 'Transaksi ini sudah selesai.');

        $waktuKeluar = now();
        $durasiMenit = $waktuKeluar->diffInMinutes($transaksi->waktu_masuk);
        $totalBayar = $transaksi->tarifParkir->hitungBiaya($durasiMenit);

        $transaksi->update([
            'waktu_keluar' => $waktuKeluar,
            'total_bayar' => $totalBayar,
            'status' => 'selesai',
            'petugas_keluar_id' => Auth::id(),
        ]);

        ActivityLogger::log("Kendaraan keluar: {$transaksi->kendaraan->plat_nomor} - Rp" . number_format($totalBayar, 0, ',', '.'));

        return redirect()->route('transaksi.struk', $transaksi)->with('success', 'Transaksi selesai. Silakan cetak struk.');
    }

    /**
     * Tampilkan struk (masuk atau keluar) untuk dicetak.
     */
    public function struk(Transaksi $transaksi): View
    {
        $transaksi->load(['kendaraan', 'areaParkir', 'tarifParkir', 'petugasMasuk', 'petugasKeluar']);

        return view('transaksi.struk', compact('transaksi'));
    }
}
