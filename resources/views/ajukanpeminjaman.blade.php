<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#222;
        }

        .phone{
            max-width:360px;
            min-height:850px;
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

        .menu-card1{
            width:360px;
            height:40px;
            background-color:#d9d9d9;
            display:block;
            padding:10px;
            border:1px solid #aaa;
            border-radius:6px;
        }

        .breadcrumb a{
            color:#007bff;
            text-decoration:none;
            margin-right:5px;
        }

        .menu-card{
            background:#1F4E9D;
            width:300px;
            margin:10px auto;
            padding:20px;
            border-radius:15px;
            box-shadow:0 3px 8px rgba(0,0,0,.2);
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
           TANGGAL + JAM
           ========================= */

        .tanggal-jam{
            display:flex;
            align-items:center;
            width:100%;
            height:45px;
            margin-top:40px;
            background:#D9D9D9;
            border-radius:15px;
            padding:0 8px;
        }

        .tanggal-box{
            width:38%;
            display:flex;
            align-items:center;
        }

        .tanggal-box input{
            width:100%;
            height:40px;
            border:none;
            outline:none;
            background:transparent;
            font-size:11px;
            padding:0;
        }

        .pemisah{
            width:1px;
            height:25px;
            background:#999;
            margin:0 5px;
        }

        .jam-box{
            width:25%;
            display:flex;
            align-items:center;
        }

        .jam-box input{
            width:100%;
            height:40px;
            border:none;
            outline:none;
            background:transparent;
            font-size:11px;
            padding:0;
        }

        .tanda{
            margin:0 3px;
            font-size:13px;
        }

        /* =========================
           ERROR
           ========================= */

        .error-message{
            display:none;
            margin-top:10px;
            padding:10px;
            background:#f8d7da;
            color:#842029;
            border-radius:10px;
            font-size:13px;
            text-align:center;
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
            style="
                width:80px;
                height:80px;
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
                <a href="{{ route('profil.guru') }}">
                    Profil
                </a>

                <!-- UBAH PASSWORD -->
                <a href="{{ route('ubah.password') }}">
                    Ubah Password
                </a>

                <!-- LOGOUT -->
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

            <a href="{{ route('dashboard') }}">
                Home
            </a>

            >

            <a href="#">
                Peminjaman
            </a>

        </nav>

    </div>


    <!-- JUDUL -->
    <div class="text-atas">

        <p>Peminjaman Lab</p>

    </div>


    <!-- CARD -->
    <div class="menu-card">

        <!-- LAB -->
        <div class="box1">

            <p>
                Ruang Lab Komputer
            </p>

        </div>


        <!-- FORM -->
        <form
            id="formPeminjaman"
            action="{{ route('ajukanpeminjaman.store') }}"
            method="POST"
        >

            @csrf


            <!-- KETERANGAN -->
            <textarea
                name="keterangan"
                id="keterangan"
                placeholder="Keterangan"
                style="
                    overflow:hidden;
                    width:100%;
                    height:90px;
                    border-radius:15px;
                    background:#D9D9D9;
                    border:none;
                    padding:10px;
                    margin-top:40px;
                    resize:none;
                "
            ></textarea>


            <!-- MATA PELAJARAN -->
            <select
                class="pilih-guru"
                name="Pelajaran_id"
                id="pelajaran"
                style="
                    width:100%;
                    height:45px;
                    border-radius:15px;
                    background:#D9D9D9;
                    border:none;
                    margin-top:40px;
                    padding:0 10px;
                "
            >

                <option
                    value=""
                    selected
                    disabled
                >
                    Silahkan Pilih Mata Pelajaran
                </option>

                @foreach($pelajarans as $pelajaran)

                    <option value="{{ $pelajaran->id }}">
                        {{ $pelajaran->nama_pelajaran }}
                    </option>

                @endforeach

            </select>


            <!-- TANGGAL + JAM -->
            <div class="tanggal-jam">

                <!-- TANGGAL -->
                <div class="tanggal-box">

                    <input
                        type="date"
                        name="tanggal"
                        id="tanggal"
                    >

                </div>


                <!-- PEMISAH -->
                <div class="pemisah"></div>


                <!-- JAM MULAI -->
                <div class="jam-box">

                    <input
                        type="time"
                        name="jam_mulai"
                        id="jam_mulai"
                    >

                </div>


                <!-- TANDA - -->
                <span class="tanda">
                    -
                </span>


                <!-- JAM SELESAI -->
                <div class="jam-box">

                    <input
                        type="time"
                        name="jam_selesai"
                        id="jam_selesai"
                    >

                </div>

            </div>


            <!-- PESAN ERROR -->
            <div
                id="errorMessage"
                class="error-message"
            ></div>


            <!-- TOMBOL AJUKAN -->
            <button
                type="submit"
                id="btnAjukan"
                class="btn btn-primary d-flex justify-content-center align-items-center"
                style="
                    width:100%;
                    height:45px;
                    border-radius:15px;
                    background:#102C6B;
                    margin-top:40px;
                    border:none;
                "
            >
                Ajukan Peminjaman
            </button>

        </form>

    </div>

</div>


<script>

    /* =========================
       HAMBURGER
       ========================= */

    const hamburgerBtn =
        document.getElementById('hamburgerBtn');

    const hamburgerDropdown =
        document.getElementById('hamburgerDropdown');

    hamburgerBtn.addEventListener('click', function(){

        hamburgerDropdown.classList.toggle('show');

    });


    /* =========================
       VALIDASI FORM
       ========================= */

    const formPeminjaman =
        document.getElementById('formPeminjaman');

    const errorMessage =
        document.getElementById('errorMessage');


    formPeminjaman.addEventListener('submit', function(event){

        const keterangan =
            document.getElementById('keterangan').value.trim();

        const pelajaran =
            document.getElementById('pelajaran').value;

        const tanggal =
            document.getElementById('tanggal').value;

        const jamMulai =
            document.getElementById('jam_mulai').value;

        const jamSelesai =
            document.getElementById('jam_selesai').value;


        let pesan = '';


        if(keterangan === ''){

            pesan = 'Keterangan tidak boleh kosong.';

        }

        else if(!pelajaran){

            pesan = 'Silahkan pilih mata pelajaran.';

        }

        else if(!tanggal){

            pesan = 'Silahkan pilih tanggal peminjaman.';

        }

        else if(!jamMulai){

            pesan = 'Silahkan pilih jam mulai.';

        }

        else if(!jamSelesai){

            pesan = 'Silahkan pilih jam selesai.';

        }

        else if(jamSelesai <= jamMulai){

            pesan = 'Jam selesai harus lebih besar dari jam mulai.';

        }


        if(pesan !== ''){

            event.preventDefault();

            errorMessage.innerText = pesan;

            errorMessage.style.display = 'block';

            return;

        }


        errorMessage.style.display = 'none';

    });

</script>

</body>
</html>