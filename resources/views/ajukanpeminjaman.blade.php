<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajukan peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#222;
        }

        .phone{
            max-width:360px;
            min-height:800px;
            margin:20px auto;
            background:#fff;
        }

        .header{
            background:#102C6B;
            height:82px;
            justify-content:space-between;
            display:flex;
        }
     .text-atas{
            
            color:black;
            margin-top:20px;
            text-align:center;
            font-size:30px;
        }
.menu-card1 {
  width: 360px;      
  height: 40px;
  background-color: #d9d9d9;
  display: block;
  justify-content: space-between;
  align-items: center;
  padding:  10px;
  border: 1px solid #aaa;
  border-radius: 6px;
}
    .breadcrumb a {
  color: #007bff;
  text-decoration: none;
  margin-right: 5px;
}

        .menu-card{
            background:#1F4E9D;
            width:300px;
            margin:10px auto;
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
        .box1{
            margin-top:10px;
            background:#D9D9D9;
            width:100%;
            height:150px;
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
            height:60px;
            border-radius:15px;
        }
         .box2 p{
            text-align:left;
            padding:20px;
        }
        .box3{
            margin-top:40px;
            background:#D9D9D9;
            width:100%;
            height:60px;
            border-radius:15px;
        }
         .box3 p{
            text-align:left;
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


    </style>

</head>
<body>

<div class="phone">

    <div class="header">
    <img src="{{asset ('gambar/download.png') }}" alt="logo" class="logo" style="width:80px; height:80px; margin-right:10px; border-radius:20%">

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
    <a href="#">Home</a> >
    <a href="#">profil</a>
  </nav>
  
    </div>
<div class="text-atas"><p>Peminjaman Lab</p></div>
    <div class="menu-card">
    
    <div class="box1">
        <p>ruang lab komputer</p>
    </div>
<form action="/dashboard" method="post">
    
    <select class="pilih-guru" name="Guru_id" style="width:100%; height:45px; border-radius:15px; background:#D9D9D9; border:none; margin-top:40px;"> 
         <option value="" selected disabled hidden><p>Silahkan Pilih Guru</option>    
         
            <option></option>
         </select>
        <select class="pilih-guru" name="Pelajaran_id[]"  style="width:100%; height:45px; border-radius:15px; background:#D9D9D9; border:none; margin-top:40px;">
               
            <option value="" selected disabled hidden><p>Silahkan Pilih Mata Pelajaran</option>
            @foreach($pelajarans as $pelajaran)
                <option value="{{ $pelajaran->id }}" ><p>{{ $pelajaran->nama_pelajaran }}</option>
            @endforeach
         </select>
         <div style="margin-top:40px;">
    <input
        type="date"
        name="tanggal_peminjaman"
        style="width:100%; height:45px; border-radius:15px; background:#D9D9D9; border:none; padding:0 15px;">
</div>
    <div><a href="/dashboard"
    id="btnAjukan"
   class="btn btn-primary d-flex justify-content-center align-items-center"
   style="width:100%; height:45px; border-radius:15px; background:#102C6B; margin-top:40px;">
    Ajukan Peminjaman
</a></div>
</form>
         

</div>

</div>


<script>

    const hamburgerBtn = document.getElementById('hamburgerBtn');

    const hamburgerDropdown = document.getElementById('hamburgerDropdown');


    hamburgerBtn.addEventListener('click', function () {

        hamburgerDropdown.classList.toggle('show');

    });
</script>

</body>
</html>