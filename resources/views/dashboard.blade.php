<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama</title>

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


        .menu-card1 {
            width: 400px;
            height: 40px;
            background-color: #d9d9d9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border: 1px solid #aaa;
            border-radius: 6px;
        }


        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
            margin-right: 5px;
        }


        .search-box {
            display: flex;
            align-items: ;
        }


        .search-box input {
            width: 122px;
            height: 30px;
            border: 1px solid #aaa;
            padding-left: 15px;
        }


        .search-box button {
            width: 40px;
            height: 30px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }


        .box1{
            margin-top:10px;
            background:#D9D9D9;
            width:100%;
            height:58px;
            border-radius:15px;
        }


        .box1 p{
            text-align:center;
            padding:20px;
        }


        .box2{
            margin-top:40px;
            background:#D9D9D9;
            width:100%;
            height:58px;
            border-radius:15px;
        }


        .box2 p{
            text-align:center;
            padding:20px;
        }


        .box3{
            margin-top:40px;
            background:#D9D9D9;
            width:100%;
            height:58px;
            border-radius:15px;
        }


        .box3 p{
            text-align:center;
            padding:20px;
        }


        .box4{
            margin-top:40px;
            background:#D9D9D9;
            width:100%;
            height:58px;
            border-radius:15px;
        }


        .box4 p{
            text-align:center;
            padding:20px;
        }


        .box5{
            margin-top:40px;
            background:#D9D9D9;
            width:100%;
            height:58px;
            border-radius:15px;
        }


        .box5 p{
            text-align:center;
            padding:20px;
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
           POP UP PENGAJUAN BERHASIL
           ========================= */

        .popup-overlay{
            position:fixed;
            top:0;
            left:0;
            width:100%;
            height:100%;

            background:rgba(0,0,0,0.5);

            display:flex;
            justify-content:center;
            align-items:center;

            z-index:9999;
        }


        .popup-box{
            width:320px;
            background:white;

            border-radius:15px;

            padding:25px;

            text-align:center;

            box-shadow:0 5px 20px rgba(0,0,0,0.3);
        }


        .popup-icon{
            width:60px;
            height:60px;

            margin:0 auto 15px;

            border-radius:50%;

            background:#1F4E9D;

            display:flex;
            justify-content:center;
            align-items:center;

            color:white;

            font-size:32px;
        }


        .popup-title{
            font-size:20px;
            font-weight:bold;

            margin-bottom:10px;
        }


        .popup-message{
            font-size:14px;
            color:#555;

            margin-bottom:20px;
        }


        .popup-button{
            width:100%;
            height:40px;

            border:none;
            border-radius:10px;

            background:#102C6B;

            color:white;

            cursor:pointer;
        }


        .popup-button:hover{
            background:#1F4E9D;
        }

    </style>

</head>

<body>


<div class="phone">

    <div class="header">

        <img
            src="{{asset ('gambar/download.png') }}"
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


    <div class="menu-card1">

        <nav class="breadcrumb">

            <a href="#">
                Home
            </a>

            >

            <a href="#"></a>

        </nav>


        <div class="search-box">
  <form action="{{ route('search.global') }}" method="GET" style="display:flex;">
    <input type="text" name="q" placeholder="Cari...">
    <button type="submit"><i class="bi bi-search"></i></button>
  </form>
</div>


    </div>


    <div class="menu-card">


        <a
            href="/pilihanlab"
            class="text-decoration-none"
            style="color:black;"
        >

            <div class="box1">

                <p>
                    Ajukan Peminjaman Lab
                </p>

            </div>

        </a>


        <a href="jadwallab-dipinjam"  class="text-decoration-none" style="color:black;">
<div class="box2">

            <p>
                Jadwal Peminjaman Lab
            </p>

        </div>
        </a>


        <a href="/Laporan-Guru" class="text-decoration-none" style="color:black;">
   <div class="box3">

            <p>
                Laporan Penolakan
            </p>

        </div>
        </a>


        <a href="/statusajukan-lab"  class="text-decoration-none" style="color:black;">
 <div class="box4">

            <p>
                Status ajukan
            </p>

        </div>
        </a>

       


</div>


<!-- =========================
     POP UP PENGAJUAN BERHASIL
     ========================= -->

@if(session('success'))

    <div
        class="popup-overlay"
        id="successPopup"
    >

        <div class="popup-box">

            <div class="popup-icon">

                <i class="bi bi-check-lg"></i>

            </div>


            <div class="popup-title">

                Pengajuan Berhasil

            </div>


            <div class="popup-message">

                {{ session('success') }}

            </div>


            <button
                type="button"
                class="popup-button"
                id="closePopup"
            >

                OK

            </button>

        </div>

    </div>

@endif


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


    /* =========================
       TUTUP POP UP
       ========================= */

    const closePopup =
        document.getElementById('closePopup');


    const successPopup =
        document.getElementById('successPopup');


    if(closePopup && successPopup){

        closePopup.addEventListener('click', function(){

            successPopup.style.display = 'none';

        });

    }

</script>


</body>
</html>