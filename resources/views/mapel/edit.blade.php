@extends('layouts.main')

@section('title', 'Edit Data Mata Pelajaran')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-door-open mr-2 text-primary"></i>Edit Mata Pelajaran</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form edit Mata Pelajaran</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kode_mapel">Kode Mata Pelajaran</label>
                    <input type="text" name="kode_mapel" id="kode_mapel" value="{{ old('kode_mapel', $mapel->kode_mapel) }}"
                        class="form-control @error('kode_mapel') is-invalid @enderror">
                    @error('kode_mapel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama_mapel">Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mapel" id="nama_mapel" value="{{ old('nama_mapel', $mapel->nama_mapel) }}"
                        class="form-control @error('nama_mapel') is-invalid @enderror">
                    @error('nama_mapel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kkm">KKM</label>
                    <input type="number" name="kkm" id="kkm" value="{{ old('kkm', $mapel->kkm) }}"
                        class="form-control @error('kkm') is-invalid @enderror">
                    @error('kkm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('mapel.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
