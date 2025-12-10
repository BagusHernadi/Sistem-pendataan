@extends('layouts.app')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Data</h6>
        <a href="{{ route('resident.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>

    <div class="card-body">

        <form action="{{ route('resident.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" required maxlength="16">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="gender" class="form-control" required>
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tempat Lahir</label>
                    <input type="text" name="birth_place" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="birtch_date" class="form-control" required>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Alamat</label>
                    <textarea name="address" class="form-control" rows="3" required></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Agama</label>
                    <input type="text" name="religion" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status Pernikahan</label>
                    <select name="marital_status" class="form-control" required>
                        <option value="single">Single</option>
                        <option value="married">Menikah</option>
                        <option value="divorced">Cerai</option>
                        <option value="widowed">Duda/Janda</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Pekerjaan</label>
                    <input type="text" name="occupation" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>No. Telepon</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status Penduduk</label>
                    <select name="status" class="form-control" required>
                        <option value="active">Aktif</option>
                        <option value="moved">Pindah</option>
                        <option value="deceased">Meninggal</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="photo">Foto Anggota</label>
                    <div class="text-center mb-2">
                        <img id="photoPreview" src="#" alt="Preview" class="img-thumbnail" style="max-height: 200px; display: none;">
                    </div>
                    <input type="file" name="photo" id="photo" class="form-control" accept="image/*" onchange="previewImage(this)" required>
                    <small class="text-muted">Format: JPG, PNG, Max 2MB</small>
                    @error('photo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                @push('scripts')
                <script>
                function previewImage(input) {
                    const preview = document.getElementById('photoPreview');
                    const file = input.files[0];
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    }
                    
                    if (file) {
                        reader.readAsDataURL(file);
                    } else {
                        preview.src = '#';
                        preview.style.display = 'none';
                    }
                }
                </script>
                @endpush

            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

@endsection
