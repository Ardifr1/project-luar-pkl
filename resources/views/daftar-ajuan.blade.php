```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar ajuan</title>

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


        /* =========================
           DAFTAR AJUAN
           ========================= */

        .ajuan-container{
            background-color:#e2e8f0;
            border-radius:8px;
            padding:1rem;
            width:85%;
            margin:1rem auto;
        }

        .ajuan-container h2{
            margin-bottom:20px;
        }

        .ajuan-card{
            background-color:#f1f5f9;
            border-radius:6px;
            padding:1rem;
            margin-bottom:1rem;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
        }

        .ajuan-card p{
            margin:0.3rem 0;
        }

        .ajuan-info{
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:10px;
            margin-top:0.8rem;
        }

        .btn-detail{
            background-color:#1e3a8a;
            color:white;
            border:none;
            padding:0.4rem 0.8rem;
            border-radius:4px;
            cursor:pointer;
            text-decoration:none;
            font-size:14px;
        }

        .btn-detail:hover{
            background-color:#3b82f6;
            color:white;
        }

        .tidak-ada{
            text-align:center;
            padding:20px;
            color:#555;
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


    <!-- =========================
         HEADER
         ========================= -->

    <div class="header">

        <img
            src="{{ asset('gambar/download.png') }}"
            alt="logo"
            class="logo"
            style="
                width:100px;
                height:100px;
                margin-right:10px;
                border-radius:20%;
            "
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


    <!-- =========================
         BREADCRUMB
         ========================= -->

    <div class="menu-card1">

        <nav class="breadcrumb">

            <a href="{{ route('dashboardadmin') }}">
                Home
            </a>

            >

            <a href="{{ url()->current() }}">
                Daftar Ajuan
            </a>

        </nav>

    </div>


    <!-- =========================
         DAFTAR AJUAN
         ========================= -->

    <div class="ajuan-container">

        <h2>
            Daftar Ajuan
        </h2>


        <!-- =========================
             LOOP DATA PEMINJAMAN
             ========================= -->

        @forelse($peminjamans as $peminjaman)

            <div class="ajuan-card">

                <!-- JUDUL -->

                <p>
                    Ajuan memakai Lab
                </p>


                <!-- NAMA LAB -->

                <p>

                    <strong>
                        {{ $peminjaman->lab->nama_lab }}
                    </strong>

                </p>


                <!-- NAMA GURU -->

                <p>

                    Guru:

                    <strong>
                        {{ $peminjaman->user->name }}
                    </strong>

                </p>


                <!-- MATA PELAJARAN -->

                <p>

                    Mata Pelajaran:

                    <strong>
                        {{ $peminjaman->pelajaran->nama_pelajaran }}
                    </strong>

                </p>


                <!-- TANGGAL + DETAIL -->

                <div class="ajuan-info">

                    <span>

                        📅

                        {{ \Carbon\Carbon::parse($peminjaman->tanggal)->translatedFormat('l, d F Y') }}

                    </span>


                    <!-- LIHAT DETAIL -->

                    <a
                        href="{{ route('detail.ajuan', ['id' => $peminjaman->id]) }}"
                        class="btn-detail"
                    >

                        Lihat Detail

                    </a>

                </div>

            </div>

        @empty


            <!-- =========================
                 JIKA BELUM ADA AJUAN
                 ========================= -->

            <div class="ajuan-card">

                <div class="tidak-ada">

                    Belum ada pengajuan peminjaman.

                </div>

            </div>


        @endforelse

    </div>

    <!-- Pagination -->
<div class="d-flex justify-content-center mt-3">
    {{ $peminjamans->links('pagination::bootstrap-5') }}
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


    hamburgerBtn.addEventListener('click', function(){

        hamburgerDropdown.classList.toggle('show');

    });

</script>

</body>
</html>
```
