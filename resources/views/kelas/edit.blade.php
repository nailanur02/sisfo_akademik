@extends('layouts.main')

@section('title', 'Edit Data Kelas')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-door-open mr-2 text-primary"></i>Edit Kelas</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form edit Kelas</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('kelas.update', $kela->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" name="nama_kelas" id="nama_kelas" value="{{ old('nama_kelas', $kela->nama_kelas) }}"
                        class="form-control @error('nama_kelas') is-invalid @enderror">
                    @error('nama_kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tingkat">Tingkat</label>
                    <input type="text" name="tingkat" id="tingkat" value="{{ old('tingkat', $kela->tingkat) }}"
                        class="form-control @error('tingkat') is-invalid @enderror">
                    @error('tingkat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" name="jurusan" id="jurusan" value="{{ old('jurusan', $kela->jurusan) }}"
                        class="form-control @error('jurusan') is-invalid @enderror">
                    @error('jurusan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tahun_ajaran">Tahun Ajaran</label>
                    <input type="text" name="tahun_ajaran" id="tahun_ajaran" value="{{ old('tahun_ajaran', $kela->tahun_ajaran) }}"
                        class="form-control @error('tahun_ajaran') is-invalid @enderror">
                    @error('tahun_ajaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection
