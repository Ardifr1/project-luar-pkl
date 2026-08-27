<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Password</title>

    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            background:#222;
            font-family: Arial, sans-serif;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .phone {
            width:412px;
            min-height:120vh;
            background:white;
            padding:70px 45px 40px;
            display:flex;
            flex-direction:column;
            align-items:center;
        }
        .logo {
            width:80px; height:80px;
            object-fit:contain;
            margin-bottom:50px;
        }
        .password-form {
            display:flex;
            flex-direction:column;
            gap:1rem;
            width:100%;
        }
        .password-form label { font-weight:500; margin-bottom:0.3rem; }
        .password-form input {
            padding:0.6rem;
            border:1px solid #cbd5e1;
            border-radius:10px;
            width:100%;
        }
        .btn-confirm {
            background-color:#102C6B;
            color:white;
            border:none;
            padding:0.6rem 1rem;
            border-radius:10px;
            cursor:pointer;
            margin-top:1rem;
        }
        .btn-confirm:hover { background-color:#1e3a8a; }
        .alert { margin-bottom:1rem; padding:0.6rem; border-radius:6px; }
        .alert-success { background:#d1fae5; color:#065f46; }
        .text-danger { color:#dc2626; font-size:0.9rem; }
    </style>
</head>
<body>
    <div class="phone">
        <!-- LOGO -->
        <img src="{{ asset('gambar/logo mp png.png') }}" alt="Logo" class="logo">

        <!-- Pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Form ubah password -->
        <form class="password-form" method="POST" action="{{ route('ubah.password.update') }}">
            @csrf

            <label>Masukkan Password Lama</label>
            <input type="password" name="password_lama" placeholder="Password lama" required>
            @error('password_lama') <small class="text-danger">{{ $message }}</small> @enderror

            <label>Masukkan Password Baru</label>
            <input type="password" name="password_baru" placeholder="Password baru" required>
            @error('password_baru') <small class="text-danger">{{ $message }}</small> @enderror

            <label>Ulangi Password Baru</label>
            <input type="password" name="password_baru_confirmation" placeholder="Ulangi password baru" required>

            <button type="submit" class="btn-confirm">Konfirmasi</button>
        </form>
    </div>
</body>
</html>
