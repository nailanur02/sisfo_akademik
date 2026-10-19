<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $gurus= Guru::all();
        return view ('guru.index', compact('gurus'));
    }

    public function create()
    {
       return view('guru.create');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nip' => 'required|string|max:255|unique:gurus,nip',
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        Guru::create($validate);
        return redirect()->route('guru.index')->with ('success', 'Data Guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
       return view('guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
         $validated = $request->validate([
            'nip' => 'required|string|max:255|unique:gurus,nip,' . $guru->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => 'nullable|email|max:255|unique:gurus,email,' . $guru->id,
            'no_hp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $guru->update($validated);
        return redirect()->route('guru.index')->with('success', 'Data Guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
         $guru->delete();
       return redirect()->route('guru.index')->with('success', 'Data Guru berhasil dihapus');
    }
}

