@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Anggota</h1>
    <a href="{{ route('resident.create') }}" class="btn btn-primary btn-sm">
        + Tambah Anggota
    </a>
</div>

<!-- Pencarian -->
<div class="row mb-3">
    <div class="col-md-4">
        <form action="{{ route('resident.index') }}" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan NIK atau Nama" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>

<!-- Data Table -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">

            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Agama</th>
                        <th>Status Pernikahan</th>
                        <th>Pekerjaan</th>
                        <th>Telepon</th>
                        <th>Status Anggota</th>
                        <th width="120px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($residents as $resident)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $resident->nik }}</td>
                        <td>{{ $resident->name }}</td>
                        <td>{{ $resident->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $resident->birth_place }}</td>
                        <td>{{ $resident->birth_date }}</td>
                        <td>{{ $resident->address }}</td>
                        <td>{{ $resident->religion ?? '-' }}</td>
                        <td>{{ ucfirst($resident->marital_status) }}</td>
                        <td>{{ $resident->occupation ?? '-' }}</td>
                        <td>{{ $resident->phone ?? '-' }}</td>
                        <td>{{ $resident->status == 'active' ? 'Aktif' : ($resident->status == 'moved' ? 'Pindah' : 'Meninggal') }}</td>

        

                        <!-- ACTION BUTTONS -->
                        <td class="text-center">
                        <a href="{{ route('resident.show', $resident->id) }}" class="btn btn-info btn-sm">
                            👁 Detail
                        </a>

                    </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="14" class="text-center text-muted">Belum ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection
