@extends('layouts.main')

@section('title', 'Input Nilai Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-star mr-2 text-primary"></i>Input Nilai Siswa</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Input Nilai</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('nilai.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="siswa_id">Pilih Siswa</label>
                    <select name="siswa_id" id="siswa_id"
                        class="form-control @error('siswa_id') is-invalid @enderror">
                        <option value="">-- Pilih Siswa --</option>
                        @foreach ($siswas as $siswa)
                            <option value="{{ $siswa->id }}" {{ old('siswa_id') == $siswa->id ? 'selected' : '' }}>
                                {{ $siswa->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('siswa_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="mapel_id">Pilih Mata Pelajaran</label>
                    <select name="mapel_id" id="mapel_id"
                        class="form-control @error('mapel_id') is-invalid @enderror">
                        <option value="">-- Pilih Mapel --</option>
                        @foreach ($mapels as $mapel)
                            <option value="{{ $mapel->id }}" {{ old('mapel_id') == $mapel->id ? 'selected' : '' }}>
                                {{ $mapel->nama_mapel }}
                            </option>
                        @endforeach
                    </select>
                    @error('mapel_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="nilai_tugas">Nilai Tugas</label>
                    <input type="number" name="nilai_tugas" id="nilai_tugas" step="0.01" min="0" max="100"
                        value="{{ old('nilai_tugas') }}"
                        class="form-control @error('nilai_tugas') is-invalid @enderror">
                    @error('nilai_tugas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nilai_uts">Nilai Uts</label>
                    <input type="number" name="nilai_uts" id="nilai_uts" step="0.01" min="0" max="100"
                        value="{{ old('nilai_uts') }}"
                        class="form-control @error('nilai_uts') is-invalid @enderror">
                    @error('nilai_uts')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nilai_uas">Nilai Uas</label>
                    <input type="number" name="nilai_uas" id="nilai_uas" step="0.01" min="0" max="100"
                        value="{{ old('nilai_uas') }}"
                        class="form-control @error('nilai_uas') is-invalid @enderror">
                    @error('nilai_uas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('nilai.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection