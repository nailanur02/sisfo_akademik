<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    private function rules(): array
    {
        return [
            'nama_kelas' => 'required|string|max:255',
            'tingkat' => 'required|string|max:10',
            'jurusan' => 'required|string|max:255',
            'tahun_ajaran' => 'required|string|max:20',
        ];
    }

    public function index()
    {
        return Kelas::withCount('siswas')->get();
    }

    // Harus $kela, bukan $kelas (nama singular route "kelas" di Laravel)
    public function show(Kelas $kela)
    {
        return $kela->load('siswas');
    }

    public function store(Request $request)
    {
        $kela = Kelas::create($request->validate($this->rules()));

        return response()->json($kela, 201);
    }

    public function update(Request $request, Kelas $kela)
    {
        $kela->update($request->validate($this->rules()));

        return $kela;
    }

    public function destroy(Kelas $kela)
    {
        if ($kela->siswas()->exists()) {
            return response()->json([
                'message' => 'Kelas tidak bisa dihapus karena masih memiliki siswa.',
            ], 409);
        }

        $kela->delete();

        return response()->noContent();
    }
}
