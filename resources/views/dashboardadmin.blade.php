<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard admin</title>

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
               background: #1F4E9D;
    width: 340px;
    margin: 40px auto;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 6px 14px rgba(0,0,0,0.25);
    transition: all 0.3s ease-in-out;
        }

        .menu-text{
            color:white;
            text-align:center;
            margin-top:10px;
            font-size:18px;
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
            margin-bottom:20px;
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
            margin-bottom:20px;
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

     /* Efek shadow untuk semua box */
.box1, .box2, .box3, .box4, .box5 {
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    transition: all 0.3s ease-in-out;
}

/* Efek hover biar lebih interaktif */
.box1:hover, .box2:hover, .box3:hover, .box4:hover, .box5:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 10px rgba(0,0,0,0.25);
    cursor: pointer;
}

.box1:hover ~ .menu-card,
.menu-card:hover .box1:hover {
    background: #4CAF50;
}

.box2:hover ~ .menu-card,
.menu-card:hover .box2:hover {
    background: #2196F3;
}

.box3:hover ~ .menu-card,
.menu-card:hover .box3:hover {
    background: #F44336;
}

.box4:hover ~ .menu-card,
.menu-card:hover .box4:hover {
    background: #FF9800;
}

.box5:hover ~ .menu-card,
.menu-card:hover .box5:hover {
    background: #b5cb0b;
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
    <a href="#">Home</a> >
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

    <a href="/data-guru" class="text-decoration-none" style="color:black;">
    <div class="box1">
        <p>Data Guru</p>
    </div>
</a>
<a href="/data-lab" class="text-decoration-none" style="color:black;">
    <div class="box2"> <p>Data Lab</p>   
        </div>
</a>
<a href="/Laporan-Admin" class="text-decoration-none" style="color:black;">
    <div class="box3"> <p>Laporan</p>    
        </div>
</a>
<a href="/daftar-ajuan" class="text-decoration-none" style="color:black;">
    <div class="box4"> <p>Daftar ajukan</p>
        </div>
</a>
<a href="/datamapel" class="text-decoration-none" style="color:black;">
    <div class="box5"> <p>Daftar Mapel</p>
        </div>
</a>
       
       
       
</div>

   
</div>

<!-- =========================
     JAVASCRIPT HAMBURGER
     ========================= -->

<script>

    const hamburgerBtn = document.getElementById('hamburgerBtn');

    const hamburgerDropdown = document.getElementById('hamburgerDropdown');


    hamburgerBtn.addEventListener('click', function () {

        hamburgerDropdown.classList.toggle('show');

    });

</script>

</body>
</html>