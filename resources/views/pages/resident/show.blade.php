@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0">Detail Anggota</h5>
            <a href="{{ route('resident.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr><th>NIK</th><td>{{ $resident->nik }}</td></tr>
                <tr><th>Nama</th><td>{{ $resident->name }}</td></tr>
                <tr><th>Jenis Kelamin</th><td>{{ $resident->gender }}</td></tr>
                <tr><th>TTL</th><td>{{ $resident->birth_place }} / {{ $resident->birtch_date }}</td></tr>
                <tr><th>Alamat</th><td>{{ $resident->address }}</td></tr>
                <tr><th>Agama</th><td>{{ $resident->religion }}</td></tr>
                <tr><th>Status Perkawinan</th><td>{{ $resident->marital_status }}</td></tr>
                <tr><th>Pekerjaan</th><td>{{ $resident->occupation }}</td></tr>
                <tr><th>Telepon</th><td>{{ $resident->phone }}</td></tr>
                <tr><th>Status</th><td>{{ $resident->status }}</td></tr>
            </table>
        </div>
    </div>
</div>
@endsection
