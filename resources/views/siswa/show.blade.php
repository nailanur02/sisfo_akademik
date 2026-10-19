@extends('layouts.main')

@section('title', 'Detail Data Siswa')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-user-graduate mr-2 text-primary"></i>Detail Siswa
            </h1>
            <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm mr-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profil Siswa</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr>
                        <th width="20%">NIS</th>
                        <td>{{ $siswa->nis }}</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td>{{ $siswa->nama }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>
                            <span class="badge badge-{{ $siswa->jenis_kelamin == 'L' ? 'primary' : 'danger' }}">
                                {{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td><span class="badge badge-info">{{ $siswa->kelas->nama_kelas }}</span></td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td>{{ $siswa->no_hp ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $siswa->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Riwayat Nilai</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th width="5%">No</th>
                                <th>Mata Pelajaran</th>
                                <th>Tugas</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>Nilai Akhir</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswa->nilais as $index => $nilai)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $nilai->mapel->nama_mapel }}</td>
                                    <td class="text-center">{{ $nilai->nilai_tugas }}</td>
                                    <td class="text-center">{{ $nilai->nilai_uts }}</td>
                                    <td class="text-center">{{ $nilai->nilai_uas }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-info p-2">{{ $nilai->nilai_akhir }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-{{ $nilai->keterangan == 'Lulus' ? 'success' : 'danger' }} p-2">
                                            {{ $nilai->keterangan }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">Belum ada nilai untuk siswa ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection