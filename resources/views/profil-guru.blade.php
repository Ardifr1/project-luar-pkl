<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background: #222;
        }

        .phone {
            max-width: 412px;
            min-height: 917px;
            margin: 20px auto;
            background: #fff;
        }

        .header {
            background: #102C6B;
            height: 100px;
            justify-content: space-between;
            display: flex;
        }

        .card {
            background-color: #e2e8f0;
            border-radius: 10px;
            padding: 1rem;
            margin: 1rem auto;
            width: 80%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: left;
        }

        .card-title {
            background-color: #f1f5f9;
            color: #1e3a8a;
            font-weight: 600;
            text-align: center;
            padding: 0.5rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }

        .menu-card1 {
           width: auto;      
  height: 40px;
  margin: 10px auto;
  background-color: #d9d9d9;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding:  20px;
  border: 1px solid #aaa;
  border-radius: 6px;
        }

        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
            margin-right: 5px;
        }

        /* DROPDOWN HAMBURGER */

        .hamburger-container {
            position: relative;
        }

        .hamburger-dropdown {
            display: none;
            position: absolute;
            top: 70px;
            right: 10px;
            width: 180px;
            background: #D9D9D9;
            border-radius: 10px;
            overflow: hidden;
            z-index: 1000;
        }

        .hamburger-dropdown.show {
            display: block;
        }

        .hamburger-dropdown a {
            display: block;
            padding: 15px;
            color: #222;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
        }

        .hamburger-dropdown a:hover {
            background: #c5c5c5;
        }

        .hamburger-dropdown form {
            margin: 0;
        }

        .hamburger-dropdown button {
            width: 100%;
            padding: 15px;
            border: none;
            background: #D9D9D9;
            color: #222;
            font-size: 14px;
            cursor: pointer;
        }

        .hamburger-dropdown button:hover {
            background: #c5c5c5;
        }

        /* Tombol hamburger */
#hamburgerBtn {
    background: transparent;
    border: none;
    font-size: 28px;
    color: white;
    transition: opacity 0.2s ease, transform 0.2s ease;
}

/* Hover tombol */
#hamburgerBtn:hover {
    opacity: 0.8;
    transform: scale(1.05); /* sedikit membesar */
}

/* Dropdown */
.hamburger-dropdown {
    display: none;
    position: absolute;
    top: 70px;
    right: 10px;
    width: 200px;
    background: #f9f9f9;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    opacity: 0;
    transform: translateY(-5px);
    transition: opacity 0.3s ease, transform 0.3s ease;
}

/* Saat aktif */
.hamburger-dropdown.show {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

/* Link & button */
.hamburger-dropdown a,
.hamburger-dropdown button {
    display: block;
    padding: 12px;
    color: #333;
    text-decoration: none;
    text-align: left;
    font-size: 14px;
    transition: background 0.2s ease, color 0.2s ease;
    border-bottom: 1px solid #eee; 

}
        
    </style>
</head>

<body>

<div class="phone">

    <!-- HEADER -->
    <div class="header">

        <img
            src="{{ asset('gambar/download.png') }}"
            alt="logo"
            class="logo"
            style="width:100px; height:100px; margin-right:10px; border-radius:20%;"
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
                <a href="{{ route('profil.guru') }}">
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


    <!-- BREADCRUMB -->
    <div class="menu-card1">

        <nav class="breadcrumb">

            <a href="/dashboard">Home</a>
            >
            <a href="{{ route('profil.guru') }}">Profil</a>

        </nav>

    </div>


    <!-- PROFIL GURU -->
    <div class="card">

        <h3 class="card-title">
            Info Profil Guru
        </h3>

        <!-- NAMA -->
        <p>
            <strong>Nama:</strong>
            {{ $guru->name }}
        </p>

        <!-- NIP -->
        <p>
            <strong>NIP:</strong>
            {{ $guru->nip }}
        </p>

        <!-- MAPEL -->
        <p>
            <strong>Mapel:</strong>

            @if($guru->pelajaran->count() > 0)

                @foreach($guru->pelajaran as $mapel)

                    {{ $mapel->nama_pelajaran }}

                    @if(!$loop->last)
                        ,
                    @endif

                @endforeach

            @else

                Belum ada mapel

            @endif

        </p>

    </div>

</div>


<!-- JAVASCRIPT HAMBURGER -->
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