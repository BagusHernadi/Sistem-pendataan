@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Detail Anggota</h1>
    <a href="{{ route('resident.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
</div>

<div class="card shadow col-lg-10 mx-auto mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Informasi Lengkap Anggota</h6>
    </div>

    <div class="card-body">

        <table class="table table-bordered">
            <tr><th width="250">NIK</th><td>{{ $resident->nik }}</td></tr>
            <tr><th>Nama Lengkap</th><td>{{ $resident->name }}</td></tr>
            <tr><th>Jenis Kelamin</th><td>{{ $resident->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
            <tr><th>Tempat / Tanggal Lahir</th><td>{{ $resident->birth_place }}, {{ $resident->birth_date }}</td></tr>
            <tr><th>Alamat</th><td>{{ $resident->address }}</td></tr>
        </table>

        <h5 class="mt-4 font-weight-bold text-primary">Data Tambahan</h5>
        <table class="table table-striped">
            <tr><th>Agama</th><td>{{ $resident->religion ?? '-' }}</td></tr>
            <tr><th>Status Nikah</th><td>{{ ucfirst($resident->marital_status) }}</td></tr>
            <tr><th>Pekerjaan</th><td>{{ $resident->occupation ?? '-' }}</td></tr>
            <tr><th>No Telepon</th><td>{{ $resident->phone ?? '-' }}</td></tr>
            <tr>
                <th>Status Keanggotaan</th>
                <td>
                    @if($resident->status == 'active')
                        <span class="badge badge-success">Aktif</span>
                    @elseif($resident->status == 'moved')
                        <span class="badge badge-warning">Pindah</span>
                    @else
                        <span class="badge badge-danger">Meninggal</span>
                    @endif
                </td>
            </tr>
        </table>

        <h5 class="mt-4 font-weight-bold text-primary">Foto Anggota</h5>
        <div class="text-center">
        @if($resident->photo)
            <img src="{{ asset('storage/photos/' . $resident->photo) }}" alt="Foto {{ $resident->name }}" class="img-fluid" style="max-height: 300px;">
        @else   
            <p>Tidak ada foto</p>
        @endif


        </div>


        <div class="mt-4 text-center">
            <a href="{{ route('resident.edit', $resident->id) }}" class="btn btn-warning">✏ Edit</a>
            <form action="{{ route('resident.destroy', $resident->id) }}" method="POST" class="d-inline"
                  onsubmit="return confirm('Hapus data ini?')">
                @csrf @method('DELETE')
                <button class="btn btn-danger">🗑 Hapus</button>
            </form>
        </div>

    </div>
</div>

@endsection
