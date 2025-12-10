@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Data</h2>

    <form action="{{ route('resident.update', $resident->id) }}" 
          method="POST" 
          enctype="multipart/form-data"> {{-- WAJIB --}}
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ $resident->nik }}">
        </div>

        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $resident->name }}">
        </div>

        <div class="mb-2">
            <label>Jenis Kelamin</label>
            <select name="gender" class="form-control">
                <option value="male" {{ $resident->gender=='male'?'selected':'' }}>Laki-laki</option>
                <option value="female" {{ $resident->gender=='female'?'selected':'' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-2">
            <label>Tanggal Lahir</label>
            <input type="date" name="birtch_date" class="form-control" value="{{ $resident->birtch_date }}">
        </div>

        <div class="mb-2">
            <label>Tempat Lahir</label>
            <input type="text" name="birth_place" class="form-control" value="{{ $resident->birth_place }}">
        </div>

        <div class="mb-2">
            <label>Alamat</label>
            <textarea name="address" class="form-control">{{ $resident->address }}</textarea>
        </div>

        <div class="mb-2">
            <label>Agama</label>
            <input type="text" name="religion" class="form-control" value="{{ $resident->religion }}">
        </div>

        <div class="mb-2">
            <label>Status Perkawinan</label>
            <select name="marital_status" class="form-control">
                <option value="single" {{ $resident->marital_status=='single'?'selected':'' }}>single</option>
                <option value="married" {{ $resident->marital_status=='married'?'selected':'' }}>married</option>
                <option value="divorced" {{ $resident->marital_status=='divorced'?'selected':'' }}>divorced</option>
                <option value="widowed" {{ $resident->marital_status=='widowed'?'selected':'' }}>widowed</option>
            </select>
        </div>

        <div class="mb-2">
            <label>Pekerjaan</label>
            <input type="text" name="occupation" class="form-control" value="{{ $resident->occupation }}">
        </div>

        <div class="mb-2">
            <label>No. HP</label>
            <input type="text" name="phone" class="form-control" value="{{ $resident->phone }}">
        </div>

        <div class="mb-2">
            <label>Status Anggota</label>
            <select name="status" class="form-control">
                <option value="active" {{ $resident->status=='active'?'selected':'' }}>active</option>
                <option value="moved" {{ $resident->status=='moved'?'selected':'' }}>moved</option>
                <option value="deceased" {{ $resident->status=='deceased'?'selected':'' }}>deceased</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Anggota</label>
            <div class="text-center mb-2">
                @if($resident->photo && Storage::disk('public')->exists($resident->photo))
                    <img id="currentPhoto" 
                         src="{{ Storage::url($resident->photo) }}" 
                         alt="Current Photo" 
                         class="img-thumbnail" 
                         style="max-height: 200px;">
                @endif
                <img id="photoPreview" 
                     src="#" 
                     alt="New Photo Preview" 
                     class="img-thumbnail" 
                     style="max-height: 200px; display: none;">
            </div>
            <input type="file" 
                   name="photo" 
                   id="photo" 
                   class="form-control" 
                   accept="image/*" 
                   onchange="previewImage(this)">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, Max 2MB</small>
            @error('photo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        @push('scripts')
        <script>
        function previewImage(input) {
            const currentPhoto = document.getElementById('currentPhoto');
            const preview = document.getElementById('photoPreview');
            const file = input.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (currentPhoto) currentPhoto.style.display = 'none';
            }
            
            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                if (currentPhoto) currentPhoto.style.display = 'block';
            }
        }
        </script>
        @endpush

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('resident.index') }}" class="btn btn-secondary mt-3">Kembali</a>

    </form>
</div>
@endsection
