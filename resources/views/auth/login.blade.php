<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pendataan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4e73df;
            --secondary: #f8f9fc;
            --accent: #2e59d9;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .auth-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 1000px;
            display: flex;
        }
        
        .auth-illustration {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--accent) 100%);
            color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        
        .auth-illustration h2 {
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .auth-illustration p {
            opacity: 0.9;
            margin-bottom: 30px;
        }
        
        .auth-illustration img {
            max-width: 100%;
            height: auto;
            margin-top: 30px;
        }
        
        .auth-form {
            flex: 1;
            padding: 50px;
            background: white;
        }
        
        .auth-form h2 {
            color: #2d3748;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.2);
        }
        
        .form-label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 8px;
        }
        
        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 12px 20px;
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: var(--accent);
            transform: translateY(-2px);
        }
        
        .auth-footer {
            text-align: center;
            margin-top: 20px;
            color: #718096;
        }
        
        .auth-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .input-group-text {
            background: #f8f9fc;
            border: 1px solid #e2e8f0;
            border-right: none;
        }
        
        .input-group .form-control {
            border-left: none;
        }
        
        .auth-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .auth-logo img {
            height: 50px;
        }
        
        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
            }
            
            .auth-illustration {
                padding: 30px 20px;
            }
            
            .auth-form {
                padding: 30px 20px;
            }
        }
            border-radius:10px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <!-- Left Side - Illustration -->
        <div class="auth-illustration d-none d-md-flex">
            <div>
                <h2>Selamat Datang Kembali!</h2>
                <p>Masuk untuk mengakses Sistem Pendataan</p>
                <img src="https://img.freepik.com/free-vector/secure-login-concept-illustration_114360-4582.jpg" alt="Login Illustration">
            </div>
        </div>

        <!-- Right Side - Login Form -->
        <div class="auth-form">
            <div class="auth-logo">
                <h2 class="text-primary">Sistem Pendataan</h2>
                <p class="text-muted">Silakan masuk ke akun Anda</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between">
                        <label for="password" class="form-label">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-primary text-decoration-none">Lupa password?</a>
                        @endif
                    </div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password Anda">
                        <button class="btn btn-outline-secondary toggle-password" type="button">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i> Masuk
                </button>

                <div class="auth-footer mt-4">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar disini</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function(button) {
            button.addEventListener('click', function() {
                const passwordInput = this.previousElementSibling;
                const icon = this.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>
