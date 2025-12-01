<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width:450px">
    <div class="card p-4 shadow">
        <h3 class="text-center mb-3">Register</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-2">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Daftar</button>
        </form>

        <div class="text-center mt-2">
            <a href="{{ route('login.page') }}">Sudah punya akun? Login</a>
        </div>

    </div>
</div>
</body>
</html>
