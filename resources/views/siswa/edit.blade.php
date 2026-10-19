@extends('layouts.main')

@section('title', 'Edit Data Siswa')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-door-open mr-2 text-primary"></i>Edit Siswa</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form edit Siswa</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nis">Nis</label>
                    <input type="text" name="nis" id="nis" value="{{ old('nis', $siswa->nis) }}"
                        class="form-control @error('nis') is-invalid @enderror">
                    @error('nis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="nama">Nama Siswa</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $siswa->nama) }}"
                        class="form-control @error('nama') is-invalid @enderror">
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" 
                    class="form-control @error('jenis_kelamin') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki Laki</option>
                    <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->id }}" {{ old('kelas_id', $siswa->kelas_id) == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('kelas_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="no_hp">No Hp</label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $siswa->no_hp) }}"
                        class="form-control @error('no_hp') is-invalid @enderror">
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $siswa->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

