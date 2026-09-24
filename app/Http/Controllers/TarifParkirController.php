<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\TarifParkir;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TarifParkirController extends Controller
{
    public function index(): View
    {
        $tarifs = TarifParkir::latest()->paginate(10);

        return view('tarif.index', compact('tarifs'));
    }

    public function create(): View
    {
        return view('tarif.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'jenis_kendaraan' => ['required', 'in:motor,mobil,truk,bus'],
            'tarif_jam_pertama' => ['required', 'integer', 'min:0'],
            'tarif_jam_berikutnya' => ['required', 'integer', 'min:0'],
            'tarif_maksimal_harian' => ['nullable', 'integer', 'min:0'],
        ]);

        TarifParkir::create($data);

        ActivityLogger::log("Menambahkan tarif parkir untuk {$data['jenis_kendaraan']}");

        return redirect()->route('tarif.index')->with('success', 'Tarif parkir berhasil ditambahkan.');
    }

    public function edit(TarifParkir $tarif): View
    {
        return view('tarif.edit', compact('tarif'));
    }

    public function update(Request $request, TarifParkir $tarif): RedirectResponse
    {
        $data = $request->validate([
            'jenis_kendaraan' => ['required', 'in:motor,mobil,truk,bus'],
            'tarif_jam_pertama' => ['required', 'integer', 'min:0'],
            'tarif_jam_berikutnya' => ['required', 'integer', 'min:0'],
            'tarif_maksimal_harian' => ['nullable', 'integer', 'min:0'],
        ]);

        $tarif->update($data);

        ActivityLogger::log("Mengubah tarif parkir: {$tarif->jenis_kendaraan}");

        return redirect()->route('tarif.index')->with('success', 'Tarif parkir berhasil diperbarui.');
    }

    public function destroy(TarifParkir $tarif): RedirectResponse
    {
        $jenis = $tarif->jenis_kendaraan;
        $tarif->delete();

        ActivityLogger::log("Menghapus tarif parkir: {$jenis}");

        return redirect()->route('tarif.index')->with('success', 'Tarif parkir berhasil dihapus.');
    }
}
