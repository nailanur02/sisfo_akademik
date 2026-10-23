<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    // Saat update, ",id" membuat Laravel mengabaikan data guru itu sendiri pada cek unique
    private function rules(?Guru $guru = null): array
    {
        $ignore = $guru ? ',' . $guru->id : '';

        return [
            'nip' => 'required|string|max:255|unique:gurus,nip' . $ignore,
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'email' => 'nullable|email|max:255|unique:gurus,email' . $ignore,
            'no_hp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ];
    }

    public function index()
    {
        return Guru::all();
    }

    public function show(Guru $guru)
    {
        return $guru;
    }

    public function store(Request $request)
    {
        $guru = Guru::create($request->validate($this->rules()));

        return response()->json($guru, 201);
    }

    public function update(Request $request, Guru $guru)
    {
        $guru->update($request->validate($this->rules($guru)));

        return $guru;
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return response()->noContent();
    }
}
