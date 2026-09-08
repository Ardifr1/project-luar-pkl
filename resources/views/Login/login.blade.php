<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: #222; /* kembali ke background polos */
      font-family: 'Poppins', Arial, sans-serif;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .phone {
      width: 412px;
      min-height: 100vh;
      background: white;
      border-radius: 0px;
      padding: 60px 40px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.3);
      display: flex;
      flex-direction: column;
      align-items: center;
      animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(20px);}
      to {opacity: 1; transform: translateY(0);}
    }

    .logo {
      width: 90px;
      height: 90px;
      object-fit: contain;
      margin-bottom: 60px;
      filter: drop-shadow(0 3px 6px rgba(0,0,0,0.3));
    }
    .box-login{
        border-radius: 20px;
        border-color: black;
    }

    .form-login {
      width: 100%;
    }

    .form-group {
      position: relative;
      width: 100%;
      margin-bottom: 18px;
    }

    .form-group input {
      width: 100%;
      height: 45px;
      border: none;
      outline: none;
      background: #d9d9d9; /* kembali ke abu-abu */
      border-radius: 14px;
      padding: 0 40px;
      font-size: 14px;
      color: #222;
      transition: background 0.2s, box-shadow 0.2s;
    }

    .form-group input:focus {
      background: #cfcfcf;
      box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
    }

    .form-group i {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #555;
      opacity: 0.8;
    }

    .btn-login {
      display: block;
      width: 160px;
      height: 45px;
      margin: 30px auto 0;
      border: none;
      border-radius: 13px;
      background: #d9d9d9; /* tombol abu-abu sederhana */
      color: #222;
      font-size: 14px;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-login:hover {
      background: #cfcfcf;
    }

    .forgot {
      margin-top: 30px;
      text-align: center;
      font-size: 12px;
      color: #222;
      text-decoration: none;
      transition: color 0.3s;
    }

    .forgot:hover {
      color: #555;
      text-decoration: underline;
    }
  </style>
  <!-- Font Awesome untuk ikon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <div class="phone">
    <img src="{{ asset('gambar/logo mp png.png') }}" alt="Logo" class="logo">
<div class="box-login">
    @if ($errors->any())
    <div style="
      width: 100%;
      margin-bottom: 15px;
      padding: 10px;
      background: #f8d7da;
      color: #842029;
      border-radius: 10px;
      font-size: 12px;
      text-align: center;
    ">
      {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST" class="form-login">
      @csrf
      <div class="form-group">
        <i class="fa fa-user"></i>
        <input type="text" id="login" name="login" autocomplete="username" required placeholder="NIP / Username">
      </div>

      <div class="form-group">
        <i class="fa fa-lock"></i>
        <input type="password" id="password" name="password" autocomplete="current-password" required placeholder="Password">
      </div>

      <input type="submit" value="Login" class="btn-login">
    </form>

</div>
    
    <a href="#" class="forgot">Lupa password? hubungi admin</a>
  </div>
</body>
</html>
