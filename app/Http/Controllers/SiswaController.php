<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with('kelas')->get();
        return view ('siswa.index', compact('siswas'));
    }

    public function create()
    {
        return view('siswa.create', [
            'kelas' => Kelas::all()
        ]);
    }

    public function store(Request $request)
    {
         $validate = $request->validate([
            'nis' => 'required|string|max:255|unique:siswas,nis',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            
        ]);

        Siswa::create($validate);
        return redirect()->route('siswa.index')->with ('success', 'Data Siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa)
    {
        $siswa->load('kelas', 'nilais.mapel');
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa)
    {
       return view ('siswa.edit', [
            'siswa' => $siswa,
            'kelas' => Kelas::all()
        ]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nis' => 'required|string|max:255|unique:siswas,nis,' . $siswa->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa->update($validated);
        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return redirect()->route('siswa.index')->with('success', 'Data Siswa berhasil dihapus');
    }
}

