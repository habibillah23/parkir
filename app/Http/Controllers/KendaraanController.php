<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\Kendaraan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KendaraanController extends Controller
{
    public function index(Request $request): View
    {
        $kendaraans = Kendaraan::when($request->search, function ($query, $search) {
            $query->where('plat_nomor', 'like', "%{$search}%")
                ->orWhere('nama_pemilik', 'like', "%{$search}%");
        })->latest()->paginate(10)->withQueryString();

        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create(): View
    {
        return view('kendaraan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'plat_nomor' => ['required', 'string', 'max:20', 'unique:kendaraans,plat_nomor'],
            'jenis_kendaraan' => ['required', 'in:motor,mobil,truk,bus'],
            'nama_pemilik' => ['nullable', 'string', 'max:255'],
            'no_telp' => ['nullable', 'string', 'max:20'],
        ]);

        Kendaraan::create($data);

        ActivityLogger::log("Menambahkan kendaraan: {$data['plat_nomor']}");

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil ditambahkan.');
    }

    public function edit(Kendaraan $kendaraan): View
    {
        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, Kendaraan $kendaraan): RedirectResponse
    {
        $data = $request->validate([
            'plat_nomor' => ['required', 'string', 'max:20', 'unique:kendaraans,plat_nomor,' . $kendaraan->id],
            'jenis_kendaraan' => ['required', 'in:motor,mobil,truk,bus'],
            'nama_pemilik' => ['nullable', 'string', 'max:255'],
            'no_telp' => ['nullable', 'string', 'max:20'],
        ]);

        $kendaraan->update($data);

        ActivityLogger::log("Mengubah data kendaraan: {$kendaraan->plat_nomor}");

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil diperbarui.');
    }

    public function destroy(Kendaraan $kendaraan): RedirectResponse
    {
        $plat = $kendaraan->plat_nomor;
        $kendaraan->delete();

        ActivityLogger::log("Menghapus kendaraan: {$plat}");

        return redirect()->route('kendaraan.index')->with('success', 'Kendaraan berhasil dihapus.');
    }
}
