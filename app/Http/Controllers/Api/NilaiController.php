<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NilaiController extends Controller
{
    // Validasi + hitung nilai akhir (dipakai store dan update)
    private function validated(Request $request, ?Nilai $nilai = null): array
    {
        $unique = Rule::unique('nilais')
            ->where(fn ($q) => $q->where('siswa_id', $request->siswa_id));

        if ($nilai) {
            $unique->ignore($nilai->id);
        }

        $data = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'mapel_id' => ['required', 'exists:mapels,id', $unique],
            'nilai_tugas' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100',
        ], [
            'mapel_id.unique' => 'Siswa ini sudah punya nilai untuk mapel tersebut.',
        ]);

        // Rumus: tugas 30%, UTS 30%, UAS 40%
        $data['nilai_akhir'] = ($data['nilai_tugas'] * 0.3)
            + ($data['nilai_uts'] * 0.3)
            + ($data['nilai_uas'] * 0.4);

        $kkm = Mapel::findOrFail($data['mapel_id'])->kkm;
        $data['keterangan'] = $data['nilai_akhir'] >= $kkm ? 'Lulus' : 'Tidak Lulus';

        return $data;
    }

    public function index()
    {
        return Nilai::with('siswa.kelas', 'mapel')->get();
    }

    public function show(Nilai $nilai)
    {
        return $nilai->load('siswa.kelas', 'mapel');
    }

    public function store(Request $request)
    {
        $nilai = Nilai::create($this->validated($request));

        return response()->json($nilai->load('siswa.kelas', 'mapel'), 201);
    }

    public function update(Request $request, Nilai $nilai)
    {
        $nilai->update($this->validated($request, $nilai));

        return $nilai->load('siswa.kelas', 'mapel');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();

        return response()->noContent();
    }
}
