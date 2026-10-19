<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapels = Mapel::all();
        return view('mapel.index', compact('mapels'));
    }

    public function create()
    {
        return view('mapel.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_mapel' => 'required|string|max:255|unique:mapels,kode_mapel',
            'nama_mapel' => 'required|string|max:255',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        Mapel::create($validated);
        return redirect()->route('mapel.index')->with('success', 'Data Mata pelajaran berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel)
    {
        return view('mapel.edit', compact('mapel'));
    }

    public function update(Request $request, Mapel $mapel)
    {
         $validated = $request->validate([
            'kode_mapel' => 'required|string|max:255|unique:mapels,kode_mapel,' . $mapel->id,
            'nama_mapel' => 'required|string|max:255',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        $mapel->update($validated);
        return redirect()->route('mapel.index')->with('success', 'Data Mata pelajaran berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel)
    {
        if ($mapel->nilai()->exists()) {
            return redirect()->route('mapel.index')->with('error', 'mata pelajaran tidak bisa dihapus karena masih memiliki nilai.');
        }
       $mapel->delete();
       return redirect()->route('mapel.index')->with('success', 'mata pelajaran berhasil dihapus');
    }
}
