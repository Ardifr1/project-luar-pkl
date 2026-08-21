<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>detail ajuan</title>

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

    .detail-container {
  background-color: #e2e8f0;
  border-radius: 8px;
  padding: 1rem;
  width: 85%;
  margin: 1rem auto;
}

.detail-card {
  background-color: #f1f5f9;
  border-radius: 6px;
  padding: 1rem;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.detail-card p {
  margin: 0.4rem 0;
}

.detail-actions {
  display: flex;
  justify-content: center;
  gap: 1rem;
  margin-top: 1rem;
}

.btn-approve {
  background-color: #1e3a8a;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  cursor: pointer;
}

.btn-reject {
  background-color: #94a3b8;
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 4px;
  cursor: pointer;
}

.btn-approve:hover {
  background-color: #3b82f6;
}

.btn-reject:hover {
  background-color: #64748b;
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
    <a href="#">daftar ajuan</a>
  </nav>
  </div>

<div class="detail-container">
  <h2>Detail Ajuan</h2>

  <div class="detail-card">
    <p class="text">Ajuan memakai Lab</p>
    <p>Mapel : Informatika</p>
    <p>Guru : Denis</p>
    <p>Lab : Lab 1</p>
    <p>Jadwal : Senin, Agustus 2026</p>

    <div class="detail-actions">
      <button class="btn-approve">Setujui</button>
      <button class="btn-reject">Tidak Setujui</button>
    </div>
  </div>
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