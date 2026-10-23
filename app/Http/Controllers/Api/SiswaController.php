<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return Siswa::with('kelas')->get();
    }

    public function show(Siswa $siswa)
    {
        return $siswa->load('kelas');
    }
    public function store(Request $request)
    {
       $data = $request->validate([
        'nis'=> 'required|string|max:255|unique:siswas,nis',
        'nama'=> 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'alamat'=> 'nullable|string',
        'no_hp'=> 'nullable|string|max:255',
        'kelas_id'=> 'required|exists:kelas,id',
       ]);

       return response()->json(Siswa::create($data), 201);
    }

   public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'nis' => 'required|string|max:255|unique:siswas,nis,' . $siswa->id,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa->update($data);

        return $siswa;
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return response()->noContent();
    }
}
