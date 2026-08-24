<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Ajuan</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >

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

        .menu-card1{
            width:auto;
            height:40px;
            margin:10px auto;
            background-color:#d9d9d9;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:20px;
            border:1px solid #aaa;
            border-radius:6px;
        }

        .breadcrumb a{
            color:#007bff;
            text-decoration:none;
            margin-right:5px;
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
           DETAIL
           ========================= */

        .detail-container{
            background-color:#e2e8f0;
            border-radius:8px;
            padding:1rem;
            width:85%;
            margin:1rem auto;
        }

        .detail-card{
            background-color:#f1f5f9;
            border-radius:6px;
            padding:1rem;
            box-shadow:0 2px 5px rgba(0,0,0,0.1);
        }

        .detail-card p{
            margin:0.4rem 0;
        }


        /* =========================
           BUTTON
           ========================= */

        .detail-actions{
            display:flex;
            justify-content:center;
            gap:1rem;
            margin-top:1rem;
        }

        .btn-approve{
            background-color:#1e3a8a;
            color:white;
            border:none;
            padding:0.5rem 1rem;
            border-radius:4px;
            cursor:pointer;
        }

        .btn-reject{
            background-color:#94a3b8;
            color:white;
            border:none;
            padding:0.5rem 1rem;
            border-radius:4px;
            cursor:pointer;
        }

        .btn-approve:hover{
            background-color:#3b82f6;
        }

        .btn-reject:hover{
            background-color:#64748b;
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

                <a href="{{ route('profil.admin') }}">
                    Profil
                </a>

                <a href="{{ route('ubah.password') }}">
                    Ubah Password
                </a>

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

            <a href="{{ route('daftar.ajuan') }}">
                Daftar Ajuan
            </a>

            >

            <a href="#">
                Detail Ajuan
            </a>

        </nav>

    </div>


    <!-- =========================
         DETAIL AJUAN
         ========================= -->

    <div class="detail-container">

        <h2>
            Detail Ajuan
        </h2>


        <div class="detail-card">

            <p>
                Ajuan memakai Lab
            </p>


            <p>
                Mapel :
                <strong>
                    {{ $peminjaman->pelajaran->nama_pelajaran }}
                </strong>
            </p>


            <p>
                Guru :
                <strong>
                    {{ $peminjaman->user->name }}
                </strong>
            </p>


            <p>
                Lab :
                <strong>
                    {{ $peminjaman->lab->nama_lab }}
                </strong>
            </p>


            <p>
                Tanggal :
                <strong>
                    {{ \Carbon\Carbon::parse($peminjaman->tanggal)->translatedFormat('l, d F Y') }}
                </strong>
            </p>


            <p>
                Jam :
                <strong>
                    {{ $peminjaman->jam_mulai }}
                    -
                    {{ $peminjaman->jam_selesai }}
                </strong>
            </p>


            <p>
                Keterangan :
                <strong>
                    {{ $peminjaman->keterangan }}
                </strong>
            </p>


            <!-- =========================
                 STATUS
                 ========================= -->

            <p>

                Status :

                <strong>
                    {{ ucfirst($peminjaman->status) }}
                </strong>

            </p>


            <!-- =========================
                 TOMBOL
                 ========================= -->

           @if($peminjaman->status === 'menunggu')

    <div class="detail-actions">

        <!-- SETUJUI -->

        <form
            action="{{ route('ajuan.setujui', ['id' => $peminjaman->id]) }}"
            method="POST"
        >

            @csrf

            <button
                type="submit"
                class="btn-approve"
            >
                Setujui
            </button>

        </form>


        <!-- TIDAK SETUJUI -->

        <button
            type="button"
            class="btn-reject"
            id="btnTidakSetuju"
        >
            Tidak Setujui
        </button>

    </div>


    <!-- =========================
         FORM ALASAN PENOLAKAN
         ========================= -->

    <div
        id="formAlasan"
        style="
            display:none;
            margin-top:20px;
        "
    >

        <form
            action="{{ route('ajuan.tolak', ['id' => $peminjaman->id]) }}"
            method="POST"
        >

            @csrf


            <label
                for="alasan_penolakan"
                class="form-label"
            >
                <strong>
                    Alasan Tidak Menyetujui
                </strong>
            </label>


            <textarea
                name="alasan_penolakan"
                id="alasan_penolakan"
                class="form-control"
                rows="4"
                placeholder="Masukkan alasan tidak menyetujui ajuan..."
                required
            ></textarea>


            @error('alasan_penolakan')

                <div class="text-danger mt-2">
                    {{ $message }}
                </div>

            @enderror


            <div
                style="
                    display:flex;
                    gap:10px;
                    margin-top:10px;
                "
            >

                <button
                    type="submit"
                    class="btn-reject"
                >
                    Kirim Penolakan
                </button>


                <button
                    type="button"
                    id="btnBatalTolak"
                    class="btn btn-secondary"
                >
                    Batal
                </button>

            </div>

        </form>

    </div>

@endif

        </div>

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


    // =========================
    // FORM ALASAN PENOLAKAN
    // =========================

    const btnTidakSetuju =
        document.getElementById('btnTidakSetuju');

    const formAlasan =
        document.getElementById('formAlasan');

    const btnBatalTolak =
        document.getElementById('btnBatalTolak');


    if (btnTidakSetuju) {

        btnTidakSetuju.addEventListener('click', function(){

            formAlasan.style.display = 'block';

            btnTidakSetuju.style.display = 'none';

            document
                .getElementById('alasan_penolakan')
                .focus();

        });

    }


    if (btnBatalTolak) {

        btnBatalTolak.addEventListener('click', function(){

            formAlasan.style.display = 'none';

            btnTidakSetuju.style.display = 'inline-block';

            document
                .getElementById('alasan_penolakan')
                .value = '';

        });

    }

</script>

</body>
</html>