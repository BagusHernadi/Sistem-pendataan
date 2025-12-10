@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-primary">Profil Saya</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <!-- Profile Photo Section -->
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            <img id="profilePhoto" 
                                 src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('tampilan/img/undraw_profile.svg') }}" 
                                 class="rounded-circle img-thumbnail" 
                                 alt="Profile" 
                                 style="width: 150px; height: 150px; object-fit: cover;">
                            <button type="button" 
                                    class="btn btn-primary btn-sm rounded-circle position-absolute change-photo-btn" 
                                    style="bottom: 10px; right: 10px; width: 36px; height: 36px; padding: 0;"
                                    data-toggle="tooltip" 
                                    title="Ubah Foto">
                                <i class="fas fa-camera"></i>
                            </button>
                            <input type="file" id="profilePhotoInput" name="photo" accept="image/*" style="display: none;">
                        </div>
                        <h4 class="mt-3 mb-0">{{ Auth::user()->name }}</h4>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                    </div>

                    <!-- Profile Information Form -->
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                    <!-- Change Password Form -->
                    <hr class="my-4">
                    <h5 class="mb-3">Ubah Kata Sandi</h5>
                    
                    <form method="POST" action="{{ route('profile.password.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="current_password">Kata Sandi Saat Ini</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                       id="current_password" name="current_password" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#current_password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Kata Sandi Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <small class="form-text text-muted">Minimal 8 karakter, mengandung huruf dan angka</small>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                            <div class="input-group">
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" required>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password_confirmation">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                Ubah Kata Sandi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .img-thumbnail {
        border: 3px solid #e3e6f0;
        transition: all 0.3s ease;
    }
    .change-photo-btn {
        transition: all 0.3s ease;
    }
    .change-photo-btn:hover {
        transform: scale(1.1);
    }
    .toggle-password {
        cursor: pointer;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // Toggle password visibility
        $('.toggle-password').click(function() {
            const target = $($(this).data('target'));
            const icon = $(this).find('i');
            
            if (target.attr('type') === 'password') {
                target.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                target.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });

        // Handle profile photo upload
        $('#profilePhotoInput').on('change', function() {
            const file = this.files[0];
            if (file) {
                const formData = new FormData();
                formData.append('photo', file);
                formData.append('_token', '{{ csrf_token() }}');
                
                // Show loading state
                const uploadBtn = $('.change-photo-btn');
                uploadBtn.html('<i class="fas fa-spinner fa-spin"></i>').prop('disabled', true);
                
                // Make AJAX request to upload the photo
                $.ajax({
                    url: '{{ route("profile.photo.update") }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Update the profile photo in both places
                            $('.img-profile').attr('src', response.photo_url);
                            $('#profilePhoto').attr('src', response.photo_url);
                            
                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Gagal mengunggah foto profil.'
                            });
                        }
                    },
                    error: function(xhr) {
                        const error = xhr.responseJSON?.message || 'Terjadi kesalahan saat mengunggah foto.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: error
                        });
                    },
                    complete: function() {
                        // Reset the file input
                        $('#profilePhotoInput').val('');
                        uploadBtn.html('<i class="fas fa-camera"></i>').prop('disabled', false);
                    }
                });
            }
        });

        // Trigger file input when the camera button is clicked
        $('.change-photo-btn').on('click', function(e) {
            e.preventDefault();
            $('#profilePhotoInput').click();
        });

        // Show success message if exists
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
        
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush
