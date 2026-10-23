<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    private function rules(?Mapel $mapel = null): array
    {
        return [
            'kode_mapel' => 'required|string|max:255|unique:mapels,kode_mapel' . ($mapel ? ',' . $mapel->id : ''),
            'nama_mapel' => 'required|string|max:255',
            'kkm' => 'required|integer|min:0|max:100',
        ];
    }

    public function index()
    {
        return Mapel::all();
    }

    public function show(Mapel $mapel)
    {
        return $mapel;
    }

    public function store(Request $request)
    {
        $mapel = Mapel::create($request->validate($this->rules()));

        return response()->json($mapel, 201);
    }

    public function update(Request $request, Mapel $mapel)
    {
        $mapel->update($request->validate($this->rules($mapel)));

        return $mapel;
    }

    public function destroy(Mapel $mapel)
    {
        // Mapel yang sudah punya nilai tidak boleh dihapus (ada foreign key)
        if ($mapel->nilais()->exists()) {
            return response()->json([
                'message' => 'Mata pelajaran tidak bisa dihapus karena masih memiliki nilai.',
            ], 409);
        }

        $mapel->delete();

        return response()->noContent();
    }
}