<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\AreaParkir;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AreaParkirController extends Controller
{
    public function index(): View
    {
        $areas = AreaParkir::latest()->paginate(10);

        return view('area.index', compact('areas'));
    }

    public function create(): View
    {
        return view('area.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama_area' => ['required', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'kapasitas' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        AreaParkir::create($data);

        ActivityLogger::log("Menambahkan area parkir: {$data['nama_area']}");

        return redirect()->route('area.index')->with('success', 'Area parkir berhasil ditambahkan.');
    }

    public function edit(AreaParkir $area): View
    {
        return view('area.edit', compact('area'));
    }

    public function update(Request $request, AreaParkir $area): RedirectResponse
    {
        $data = $request->validate([
            'nama_area' => ['required', 'string', 'max:255'],
            'lokasi' => ['nullable', 'string', 'max:255'],
            'kapasitas' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        $area->update($data);

        ActivityLogger::log("Mengubah area parkir: {$area->nama_area}");

        return redirect()->route('area.index')->with('success', 'Area parkir berhasil diperbarui.');
    }

    public function destroy(AreaParkir $area): RedirectResponse
    {
        $nama = $area->nama_area;
        $area->delete();

        ActivityLogger::log("Menghapus area parkir: {$nama}");

        return redirect()->route('area.index')->with('success', 'Area parkir berhasil dihapus.');
    }
}
