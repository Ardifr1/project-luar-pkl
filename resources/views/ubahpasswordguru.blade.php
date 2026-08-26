<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ubah password</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #222;
            font-family: Arial, sans-serif;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .phone {
            width: 412px;
            min-height: 120vh;
            background: white;

            padding: 70px 45px 40px;

            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo {
            width: 80px;
            height: 80px;
            
            object-fit: contain;

            margin-bottom: 100px;
        }

    .password-form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  width: 80%;
  margin: 2rem auto;
}

.password-form label {
  font-weight: 500;
  margin-bottom: 0.3rem;
}

.password-form input {
  padding: 0.6rem;
  border: 1px solid #cbd5e1;
  border-radius: 10px;
  width: 100%;
}

.btn-confirm {
  background-color: #b4b6bb;
  color: white;
  border: none;
  padding: 0.6rem 1rem;
  border-radius: 10px;
  cursor: pointer;
  margin-top: 1rem;
}

.btn-confirm:hover {
  background-color: #6a86b3;
}


    </style>
</head>

<body>

    <div class="phone">

        <!-- LOGO -->
        <img
            src="{{ asset('gambar/logo mp png.png') }}"
            alt="Logo"
            class="logo"
        >


  <form class="password-form">
  <label>Masukkan Password Lama</label>
  <input type="password" placeholder="Password lama">

  <label>Masukkan Password Baru</label>
  <input type="password" placeholder="Password baru">

  <label>Ulangi Password Baru</label>
  <input type="password" placeholder="Ulangi password baru">

  <button type="submit" class="btn-confirm">Konfirmasi</button>
</form>



</body>
</html>