<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::withCount('siswas')->get();
        return view('kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        Kelas::create($validated);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kela)
    {
        return view('kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        $kela->update($validated);
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kela)
    {
        if ($kela->siswas()->exists()) {
            return redirect()->route('kelas.index')->with('error', 'kelas tidak bisa dihapus karena masihmemiliki siswa.');
        }
       $kela->delete();
       return redirect()->route('kelas.index')->with('success', 'kelas berhasil dihapus');
    }
}

