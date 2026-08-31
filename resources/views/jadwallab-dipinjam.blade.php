<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jadwal Lab Dipinjam</title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- BOOTSTRAP ICON -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


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


        /* =========================
           HEADER
        ========================= */

        .header {
            background: #102C6B;
            height: 100px;
            justify-content: space-between;
            display: flex;
        }


        /* =========================
           BREADCRUMB
        ========================= */

        .menu-card1 {
            width: auto;
            height: 40px;
            margin: 10px auto;
            background-color: #d9d9d9;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border: 1px solid #aaa;
            border-radius: 6px;
        }


        .breadcrumb {
            margin: 0;
        }


        .breadcrumb a {
            color: #007bff;
            text-decoration: none;
            margin-right: 5px;
        }


        /* =========================
           JADWAL CONTAINER
        ========================= */

        .jadwal-container {
            background-color: #e2e8f0;
            border-radius: 8px;
            padding: 1rem;
            width: 85%;
            margin: 1rem auto;
            text-align: center;
        }


        /* =========================
           JUDUL
        ========================= */

        .jadwal-container h2 {
            font-size: 22px;
            color: #102C6B;
            margin-bottom: 20px;
        }


        /* =========================
           LAB CARD
        ========================= */

        .lab-card {
            background-color: #f1f5f9;
            border-radius: 6px;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: left;
        }


        .lab-card h4 {
            color: #1e3a8a;
            margin-bottom: 0.7rem;
        }


        .lab-card p {
            margin: 0.4rem 0;
            font-size: 14px;
        }


        /* =========================
           STATUS
        ========================= */

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            background: #d4edda;
            color: #155724;
            font-size: 12px;
            font-weight: bold;
        }


        /* =========================
           EMPTY DATA
        ========================= */

        .empty-data {
            background: #f1f5f9;
            border-radius: 8px;
            padding: 30px 15px;
            text-align: center;
            color: #555;
        }


        .empty-data i {
            font-size: 40px;
            color: #1F4E9D;
        }


        .empty-data p {
            margin-top: 10px;
            margin-bottom: 0;
        }


        /* =========================
           PAGINATION
        ========================= */

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px;
            margin-top: 20px;
            margin-bottom: 5px;
        }


        .pagination a {
            text-decoration: none;
        }


        .pagination button {
            width: 32px;
            height: 32px;
            border: none;
            background: #c5c5c5;
            font-size: 12px;
            border-radius: 4px;
            cursor: pointer;
        }


        .pagination button:hover {
            background: #aaa;
        }


        .pagination .active {
            background: #1e3a8a;
            color: white;
        }


        .pagination .disabled {
            background: #e5e7eb;
            color: #999;
            cursor: not-allowed;
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

            <a href="/dashboard">

                Home

            </a>

            >

            <a href="#">

                Jadwal Lab Dipinjam

            </a>

        </nav>

    </div>



    <!-- =========================
         JADWAL LAB
    ========================= -->

    <div class="jadwal-container">


        <h2>

            Jadwal Lab Dipinjam

        </h2>


        <!-- =========================
             DATA PEMINJAMAN
        ========================= -->

        @forelse($peminjaman as $pinjam)


            <div class="lab-card">


                <!-- NAMA LAB -->

                <h4>

                    {{ $pinjam->lab->nama_lab ?? '-' }}

                </h4>


                <!-- PEMINJAM -->

                <p>

                    Peminjam :

                    <strong>

                        {{ $pinjam->user->name ?? '-' }}

                    </strong>

                </p>


                <!-- MAPEL -->

                <p>

                    Mapel :

                    <strong>

                        {{ $pinjam->pelajaran->nama_pelajaran
                            ?? $pinjam->pelajaran->nama
                            ?? '-' }}

                    </strong>

                </p>


                <!-- JADWAL -->

                <p>

                    Jadwal :

                    <strong>

                        {{ \Carbon\Carbon::parse($pinjam->tanggal)->format('d-m-Y') }}

                        &nbsp;

                        {{ \Carbon\Carbon::parse($pinjam->jam_mulai)->format('H:i') }}

                        -

                        {{ \Carbon\Carbon::parse($pinjam->jam_selesai)->format('H:i') }}

                    </strong>

                </p>


                <!-- KAPASITAS -->

                <p>

                    Kapasitas Siswa :

                    <strong>

                        {{ $pinjam->lab->kapasitas_murid ?? '-' }}

                    </strong>

                </p>


                <!-- STATUS -->

                <p>

                    Status :

                    <span class="status-badge">

                        {{ ucfirst($pinjam->status) }}

                    </span>

                </p>


            </div>


        @empty


            <!-- =========================
                 TIDAK ADA DATA
            ========================= -->

            <div class="empty-data">

                <i class="bi bi-calendar-x"></i>

                <p>

                    Belum ada lab yang sedang dipinjam.

                </p>

            </div>


        @endforelse



        <!-- =========================
             PAGINATION
        ========================= -->

        @if($peminjaman->hasPages())


            <div class="pagination">


                <!-- SEBELUMNYA -->

                @if($peminjaman->onFirstPage())


                    <button
                        type="button"
                        class="disabled"
                        disabled
                    >

                        &lt;

                    </button>


                @else


                    <a href="{{ $peminjaman->previousPageUrl() }}">

                        <button type="button">

                            &lt;

                        </button>

                    </a>


                @endif



                <!-- NOMOR HALAMAN -->

                @php

                    $currentPage = $peminjaman->currentPage();

                    $lastPage = $peminjaman->lastPage();


                    if ($currentPage <= 2) {

                        $startPage = 1;

                    } elseif ($currentPage >= $lastPage - 1) {

                        $startPage = max(
                            1,
                            $lastPage - 2
                        );

                    } else {

                        $startPage = $currentPage - 1;

                    }


                    $endPage = min(
                        $lastPage,
                        $startPage + 2
                    );

                @endphp



                @for(
                    $page = $startPage;
                    $page <= $endPage;
                    $page++
                )


                    <a href="{{ $peminjaman->url($page) }}">

                        <button
                            type="button"
                            class="{{ $currentPage == $page ? 'active' : '' }}"
                        >

                            {{ $page }}

                        </button>

                    </a>


                @endfor



                <!-- BERIKUTNYA -->

                @if($peminjaman->hasMorePages())


                    <a href="{{ $peminjaman->nextPageUrl() }}">

                        <button type="button">

                            &gt;

                        </button>

                    </a>


                @else


                    <button
                        type="button"
                        class="disabled"
                        disabled
                    >

                        &gt;

                    </button>


                @endif


            </div>


        @endif


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


    hamburgerBtn.addEventListener(
        'click',
        function () {

            hamburgerDropdown.classList.toggle('show');

        }
    );


    /*
     * Tutup dropdown jika klik di luar
     */

    document.addEventListener(
        'click',
        function (event) {

            if (
                !hamburgerBtn.contains(event.target) &&
                !hamburgerDropdown.contains(event.target)
            ) {

                hamburgerDropdown.classList.remove('show');

            }

        }
    );


</script>


</body>

</html>