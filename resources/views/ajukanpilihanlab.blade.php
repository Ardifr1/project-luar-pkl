<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Pilihan Lab</title>

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

        /* =========================
           DROPDOWN HAMBURGER
        ========================= */

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

        /* =========================
           LAB
        ========================= */

        .lab-section {
            text-align: center;
            margin: 2rem auto;
            width: 90%;
        }

        .lab-container {
            background-color: #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        .lab-card {
            background-color: #f1f5f9;
            border-radius: 6px;
            padding: 1rem;
            width: 80%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: left;
        }

        .lab-card h4 {
            margin-bottom: 0.5rem;
            color: #1e3a8a;
        }

        .lab-card p {
            margin-bottom: 8px;
        }

        .lab-card button {
            background-color: #1e3a8a;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }

        .lab-card button:hover {
            background-color: #3b82f6;
        }

        /* =========================
           PAGINATION
        ========================= */

        .pagination {
            margin-top: 1rem;
            justify-content: center;
        }

        .pagination button {
            background-color: #f1f5f9;
            border: none;
            padding: 0.5rem 0.8rem;
            margin: 0 0.2rem;
            border-radius: 4px;
            cursor: pointer;
        }

        .pagination button a {
            text-decoration: none;
            color: #222;
        }

        .pagination .active {
            background-color: #1e3a8a;
            color: white;
        }

        /* =========================
           STATUS
        ========================= */

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 13px;
            margin-bottom: 10px;
        }

        .status-tersedia {
            background: #d1fae5;
            color: #065f46;
        }

        .status-menunggu {
            background: #fef3c7;
            color: #92400e;
        }

        .status-dipinjam {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-maintenance {
            background: #e5e7eb;
            color: #374151;
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


    <!-- =========================
         BREADCRUMB
    ========================= -->

    <div class="menu-card1">

        <nav class="breadcrumb">

            <a href="{{ route('dashboard') }}">
                Home
            </a>

            >

            <a href="#">
                Pilih Lab
            </a>

        </nav>

    </div>


    <!-- =========================
         PILIH LAB
    ========================= -->

    <section class="lab-section">

        <h2>Silahkan Pilih Lab</h2>

        <div class="lab-container">

            @forelse($labs as $lab)

                <div class="lab-card">

                    <!-- NAMA LAB -->

                    <h4>
                        {{ $lab->nama_lab }}
                    </h4>


                    <!-- KAPASITAS -->

                    <p>
                        <strong>Kapasitas:</strong>

                        {{ $lab->kapasitas_murid }} murid
                    </p>


                    @php

                        $peminjaman = $lab->peminjaman
                            ->where('status', 'disetujui')
                            ->first();

                    @endphp


                    <!-- STATUS -->

                    @if($peminjaman)

                        <span class="status status-dipinjam">
                            Sedang Dipinjam
                        </span>

                    @else

                        @if($lab->status == 'tersedia')

                            <span class="status status-tersedia">
                                Tersedia
                            </span>

                        @elseif($lab->status == 'sedang_maintenance')

                            <span class="status status-maintenance">
                                Sedang Maintenance
                            </span>

                        @else

                            <span class="status status-maintenance">
                                {{ $lab->status }}
                            </span>

                        @endif

                    @endif


                    <!-- INFORMASI PEMINJAM -->

                    @if($peminjaman)

                        <p>
                            <strong>Peminjam:</strong>

                            {{ $peminjaman->user->name ?? '-' }}
                        </p>


                        <p>
                            <strong>Pelajaran:</strong>

                            {{ $peminjaman->pelajaran->nama ?? '-' }}
                        </p>


                        <p>
                            <strong>Tanggal:</strong>

                            {{ $peminjaman->tanggal }}
                        </p>


                        <p>
                            <strong>Jam:</strong>

                            {{ $peminjaman->jam_mulai }}
                            -
                            {{ $peminjaman->jam_selesai }}
                        </p>

                    @else

                        <p>
                            <strong>Peminjam:</strong>
                            -
                        </p>


                        <p>
                            <strong>Pelajaran:</strong>
                            -
                        </p>

                    @endif


                    <!-- BUTTON AJUKAN -->

                    @if($peminjaman)

                        <button
                            type="button"
                            disabled
                            style="background:#999; cursor:not-allowed;"
                        >
                            Tidak Tersedia
                        </button>

                    @else

                        <button type="button">
                            Ajukan
                        </button>

                    @endif

                </div>

            @empty

                <div class="lab-card text-center">

                    <h4>
                        Belum Ada Lab
                    </h4>

                    <p>
                        Belum ada data lab yang ditambahkan oleh admin.
                    </p>

                </div>

            @endforelse

        </div>


        <!-- =========================
             PAGINATION
        ========================= -->

        <div class="pagination">

            <button>
                &lt;
            </button>

            <button class="active">
                1
            </button>

            <button>
                <a href="">
                    2
                </a>
            </button>

            <button>
                <a href="">
                    3
                </a>
            </button>

            <button>
                <a href="">
                    4
                </a>
            </button>

            <button>
                &gt;
            </button>

        </div>

    </section>

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