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
.phone {
      width: 412px;
      background: white;
      border-radius: 0px;
      padding: 60px 40px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
      display: flex;
      flex-direction: column;
      align-items: center;
      animation: fadeIn 0.6s ease-in-out;
    }

    * { margin:0; padding:0; box-sizing:border-box; }
    body {
      background:#222;
      font-family:'Poppins', Arial, sans-serif;
      
      display:flex;
      justify-content:center;
      align-items:center;
    }

    /* Card utama */
    .box-password {
      width: 100%;
      max-width: 400px;
      background: #fff;
      border-radius: 0px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
      padding: 40px 30px;
      animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
      from {opacity:0; transform:translateY(20px);}
      to {opacity:1; transform:translateY(0);}
    }

    .logo {
      width:90px; height:90px;
      object-fit:contain;
      margin:0 auto 30px;
      display:block;
      background:#fff;
      border-radius:20%;
      padding:10px;
      box-shadow: 5px 5px 12px rgba(0,0,0,0.4);
    }

    /* Box form */
    .boxkeun {
      background:#fff;
      border-radius:12px;
      height: 470px;

     /* Bayangan container */
      box-shadow: 5px 5px 10px rgba(1, 1, 1,0.60);
      
      padding: 50px;
    }

    .password-form {
      display:flex;
      flex-direction:column;
      gap:1rem;
      width:100%;
    }

    .password-form label { font-weight:500; margin-bottom:0.3rem; }

    .input-group {
      position:relative;
      width:100%;
    }

    .password-form input {
      padding:0.6rem;
      border:none;
      border-radius:14px;
      width:100%;
      background:#d9d9d9;
      font-size:14px;
      color:#222;
      transition:background 0.2s, box-shadow 0.2s;
    }

    .password-form input:focus {
      background:#cfcfcf;
      box-shadow:0 0 0 3px rgba(59,130,246,0.2);
    }

    /* ikon mata */
    .toggle-eye {
      position:absolute;
      right:12px;
      top:50%;
      transform:translateY(-50%);
      cursor:pointer;
      color:#555;
      font-size:18px;
    }

    .btn-confirm {
      background-color:#103f90;
      color:white;
      border:none;
      padding:0.6rem 1rem;
      border-radius:13px;
      cursor:pointer;
      margin-top:1rem;
      font-weight:600;
      transition:background 0.3s;

      /* Efek shadow timbul */
  box-shadow: 0 4px 8px rgba(0,0,0,0.35);
    }
    .btn-confirm:hover { background-color:#1450b0; }

    .alert { margin-bottom:1rem; padding:0.6rem; border-radius:6px; }
    .alert-success { background:#d1fae5; color:#065f46; }
    .text-danger { color:#dc2626; font-size:0.9rem; }
  </style>
</head>
<body>
  <div class="box-password">
    <!-- LOGO -->
    <img src="{{ asset('gambar/logo mp png.png') }}" alt="Logo" class="logo">

    <!-- Pesan sukses -->
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Box form -->
    <div class="boxkeun">
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
