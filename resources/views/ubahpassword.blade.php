<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Password</title>

  <!-- Bootstrap Icons -->
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

    /* ikon mata */
    .toggle-eye {
      position:absolute;
      right:10px;
      top:50%;
      transform:translateY(-50%);
      cursor:pointer;
      color:#555;
      font-size:18px;
    }
    .input-group {
      position:relative;
    }
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
      <div class="input-group">
        <input type="password" name="password_lama" id="password_lama" placeholder="Password lama" required>
        <i class="bi bi-eye toggle-eye" onclick="togglePassword('password_lama', this)"></i>
      </div>
      @error('password_lama') <small class="text-danger">{{ $message }}</small> @enderror

      <label>Masukkan Password Baru</label>
      <div class="input-group">
        <input type="password" name="password_baru" id="password_baru" placeholder="Password baru" required>
        <i class="bi bi-eye toggle-eye" onclick="togglePassword('password_baru', this)"></i>
      </div>
      @error('password_baru') <small class="text-danger">{{ $message }}</small> @enderror

      <label>Ulangi Password Baru</label>
      <div class="input-group">
        <input type="password" name="password_baru_confirmation" id="password_baru_confirmation" placeholder="Ulangi password baru" required>
        <i class="bi bi-eye toggle-eye" onclick="togglePassword('password_baru_confirmation', this)"></i>
      </div>

      <button type="submit" class="btn-confirm">Konfirmasi</button>
    </form>
  </div>

  <!-- Script toggle password -->
  <script>
    function togglePassword(id, icon) {
      const input = document.getElementById(id);
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
      }
    }
  </script>
</body>
</html>
