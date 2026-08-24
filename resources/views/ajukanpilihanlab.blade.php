```blade
<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ajukan Pilihan Lab</title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- BOOTSTRAP ICONS -->

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
            align-items: center;
        }


        /* =========================
           BREADCRUMB
        ========================= */

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


        .breadcrumb {
            margin-bottom: 0;
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


        /* =========================
           TOMBOL AJUKAN
        ========================= */

        .btn-ajukan {
            display: inline-block;

            background: #1e3a8a;

            color: white;

            border: none;

            padding: 0.5rem 1rem;

            border-radius: 4px;

            text-decoration: none;

            cursor: pointer;
        }


        .btn-ajukan:hover {
            background: #3b82f6;

            color: white;
        }


        /* =========================
           TOMBOL TIDAK TERSEDIA
        ========================= */

        .btn-tidak-tersedia {
            display: inline-block;

            background: #999;

            color: white;

            border: none;

            padding: 0.5rem 1rem;

            border-radius: 4px;

            cursor: not-allowed;

            opacity: 1;
        }


        /* =========================
           PAGINATION
        ========================= */

        .pagination {
            margin-top: 1rem;

            justify-content: center;

            display: flex;

            align-items: center;
        }


        .pagination button {
            background-color: #f1f5f9;

            border: none;

            padding: 0.5rem 0.8rem;

            margin: 0 0.2rem;

            border-radius: 4px;

            cursor: pointer;
        }


        .pagination button:hover {
            background-color: #dbeafe;
        }


        .pagination .active {
            background-color: #1e3a8a;

            color: white;
        }


        .pagination .disabled {
            background-color: #e5e7eb;

            color: #999;

            cursor: not-allowed;
        }


        .pagination a {
            text-decoration: none;
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


        <h2>

            Silahkan Pilih Lab

        </h2>


        <div class="lab-container">


            @forelse($labs as $lab)


                @php

                    /*
                     * Cari peminjaman yang sudah disetujui
                     * untuk lab ini.
                     */

                    $peminjaman = $lab->peminjaman
                        ->where('status', 'disetujui')
                        ->first();

                @endphp


                <div class="lab-card">


                    <!-- =========================
                         NAMA LAB
                    ========================= -->

                    <h4>

                        {{ $lab->nama_lab }}

                    </h4>


                    <!-- =========================
                         KAPASITAS
                    ========================= -->

                    <p>

                        <strong>Kapasitas:</strong>

                        {{ $lab->kapasitas_murid }} murid

                    </p>


                    <!-- =========================
                         STATUS LAB
                    ========================= -->

                    @if($peminjaman)


                        <!-- LAB SEDANG DIPAKAI -->

                        <span class="status status-dipinjam">

                            Sedang Dipinjam

                        </span>


                    @elseif($lab->status == 'sedang_maintenance')


                        <!-- LAB SEDANG MAINTENANCE -->

                        <span class="status status-maintenance">

                            Sedang Maintenance

                        </span>


                    @elseif($lab->status == 'tersedia')


                        <!-- LAB TERSEDIA -->

                        <span class="status status-tersedia">

                            Tersedia

                        </span>


                    @else


                        <!-- STATUS LAIN -->

                        <span class="status status-maintenance">

                            {{ $lab->status }}

                        </span>


                    @endif


                    <!-- =========================
                         INFORMASI PEMINJAM
                    ========================= -->

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

                            {{ $peminjaman->tanggal ?? '-' }}

                        </p>


                        <p>

                            <strong>Jam:</strong>

                            {{ $peminjaman->jam_mulai ?? '-' }}

                            -

                            {{ $peminjaman->jam_selesai ?? '-' }}

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


                    <!-- =========================
                         TOMBOL AJUKAN
                    ========================= -->

                    @if($peminjaman || $lab->status == 'sedang_maintenance')


                        <!-- LAB TIDAK BISA DIAJUKAN -->

                        <button
                            type="button"
                            class="btn-tidak-tersedia"
                            disabled
                        >

                            Tidak Tersedia

                        </button>


                    @else


                        <!-- LAB TERSEDIA -->

                        <a
                            href="{{ url('/ajukan-peminjaman/' . $lab->id) }}"
                            class="btn-ajukan"
                        >

                            Ajukan

                        </a>


                    @endif


                </div>


            @empty


                <!-- =========================
                     BELUM ADA LAB
                ========================= -->

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


            {{-- TOMBOL SEBELUMNYA --}}

            @if ($labs->onFirstPage())

                <button
                    type="button"
                    class="disabled"
                    disabled
                >

                    &lt;

                </button>

            @else

                <a href="{{ $labs->previousPageUrl() }}">

                    <button type="button">

                        &lt;

                    </button>

                </a>

            @endif


            {{-- NOMOR HALAMAN --}}

            @php

                $currentPage = $labs->currentPage();

                $lastPage = $labs->lastPage();

                /*
                 * Menampilkan maksimal 3 nomor halaman.
                 */

                if ($currentPage <= 2) {

                    $startPage = 1;

                } elseif ($currentPage >= $lastPage - 1) {

                    $startPage = max(1, $lastPage - 2);

                } else {

                    $startPage = $currentPage - 1;

                }

                $endPage = min($lastPage, $startPage + 2);

            @endphp


            @for ($page = $startPage; $page <= $endPage; $page++)

                <a href="{{ $labs->url($page) }}">

                    <button
                        type="button"
                        class="{{ $currentPage == $page ? 'active' : '' }}"
                    >

                        {{ $page }}

                    </button>

                </a>

            @endfor


            {{-- TOMBOL BERIKUTNYA --}}

            @if ($labs->hasMorePages())

                <a href="{{ $labs->nextPageUrl() }}">

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
```
