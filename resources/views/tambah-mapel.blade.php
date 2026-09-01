<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah Mata pelajaran</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#222;
        }

        .phone{
            max-width:412px;
            min-height:917px;
            margin:20px auto;
            background:#fff;
        }

        .header{
            background:#102C6B;
            height:100px;
            justify-content:space-between;
            display:flex;
        }


        .menu-card{
            background:#1F4E9D;
            width:320px;
            margin:50px auto;
            padding:20px;
            border-radius:4px;
            box-shadow:0 3px 8px rgba(0,0,0,.2);
            border-radius:15px;
        }

        .menu-text{
            color:white;
            text-align:center;
            margin-top:10px;
            font-size:18px;
        }

               /* =========================
   BREADCRUMB INTERAKTIF
========================= */
.menu-card1 {
  width: auto;      
  margin: 10px auto;
  background-color: #f1f5f9;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  transition: box-shadow 0.3s ease;
}

.breadcrumb a {
  color: #1F4E9D;
  text-decoration: none;
  margin-right: 5px;
  font-weight: 500;
  transition: color 0.3s ease, transform 0.2s ease;
}


        /* =========================
           DROPDOWN HAMBURGER
           ========================= */

        .hamburger-container{
            position:relative;
        }

        .hamburger-dropdown{
            display:none;

            position:absolute;

            top:70px;
            right:10px;

            width:180px;

            background:#D9D9D9;

            border-radius:10px;

            overflow:hidden;

            z-index:1000;
        }

        .hamburger-dropdown.show{
            display:block;
        }

        .hamburger-dropdown a{
            display:block;

            padding:15px;

            color:#222;

            text-decoration:none;

            text-align:center;

            font-size:14px;
        }

        .hamburger-dropdown a:hover{
            background:#c5c5c5;
        }

        .hamburger-dropdown form{
            margin:0;
        }

        .hamburger-dropdown button{
            width:100%;

            padding:15px;

            border:none;

            background:#D9D9D9;

            color:#222;

            font-size:14px;

            cursor:pointer;
        }

        .hamburger-dropdown button:hover{
            background:#c5c5c5;
        }

        .form-container {
            background-color: #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            width: 85%;
            margin: 1rem auto;
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f1f5f9;
            padding: 0.5rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }

        .form-actions {
            text-align:right;
            margin-right:40px;
        }

        .form-actions button {
            margin-left: 0.5rem;
            padding: 0.4rem 0.8rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-cancel {
            background-color: #94a3b8;
            color: white;
        }

        .btn-add {
            background-color: #1e3a8a;
            color: white;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        form label {
            font-weight: 500;
        }

        form input {
            padding: 0.5rem;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
        }

    </style>
</head>

<body>

<div class="phone">

    <div class="header">

        <img
            src="{{ asset('gambar/download.png') }}"
            alt="logo"
            class="logo"
            style="width:100px; height:100px; margin-right:10px; border-radius:20%"
        >

        <!-- HAMBURGER -->

        <div class="hamburger-container">

            <button
                class="btn text-white"
                id="hamburgerBtn"
                type="button"
            >
                <i class="bi bi-list fs-1"></i>
            </button>

            <!-- DROPDOWN -->

            <div
                class="hamburger-dropdown"
                id="hamburgerDropdown"
            >

                <!-- PROFIL -->

                <a href="{{ route('profil.admin') }}">
                    Profil
                </a>

                <!-- UBAH PASSWORD -->

                <a href="{{ route('ubah.password') }}">
                    Ubah Password
                </a>

                <!-- LOG OUT -->

                <form
                    action="{{ route('logout') }}"
                    method="POST"
                >

                    @csrf

                    <button type="submit">
                        Log out
                    </button>

                </form>

            </div>

        </div>

    </div>


    <div class="menu-card1">

        <nav class="breadcrumb">

            <a href="{{ route('dashboardadmin') }}">
                Home
            </a>

            >

            <a href="{{ route('data.mapel') }}">
                Data Mapel
            </a>

            >

            <a href="{{ route('tambah.mapel') }}">
                Tambah data mapel
            </a>

        </nav>

    </div>


    <div class="form-container">

        <div class="form-header">

            <h3>
                Tambah Data mata pelajaran
            </h3>

        </div>


        <form
            action="{{ route('simpan.mapel') }}"
            method="POST"
        >

            @csrf

            <label>
                Nama Mata Pelajaran
            </label>

            <input
                type="text"
                name="nama_pelajaran"
                placeholder="Masukkan Mata pelajaran"
                value="{{ old('nama_pelajaran') }}"
                required
            >

            @error('nama_pelajaran')

                <small class="text-danger">
                    {{ $message }}
                </small>

            @enderror


            <div class="form-actions">

                <button
                    type="button"
                    class="btn-cancel"
                    onclick="window.location.href='{{ route('data.mapel') }}'"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="btn-add"
                >
                    Tambah
                </button>

            </div>

        </form>

    </div>


</div>


<!-- =========================
     JAVASCRIPT HAMBURGER
     ========================= -->

<script>

    const hamburgerBtn =
        document.getElementById('hamburgerBtn');

    const hamburgerDropdown =
        document.getElementById('hamburgerDropdown');


    hamburgerBtn.addEventListener('click', function () {

        hamburgerDropdown.classList.toggle('show');

    });

</script>

</body>
</html>