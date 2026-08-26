<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Status Ajukan Lab</title>


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


        .breadcrumb{
            margin:0;
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
           STATUS CONTAINER
           ========================= */

        .status-container{

            background-color:#e2e8f0;

            border-radius:8px;

            padding:1rem;

            width:85%;

            margin:1rem auto;

            text-align:center;
        }


        .status-container h3{

            font-size:20px;

            margin-bottom:20px;

            color:#102C6B;

        }


        /* =========================
           STATUS CARD
           ========================= */

        .status-card{

            background-color:#f1f5f9;

            border-radius:10px;

            padding:1rem;

            box-shadow:0 2px 5px rgba(0,0,0,0.1);

            text-align:left;

            margin-bottom:20px;

        }


        .status-card p{

            margin:0.7rem 0;

        }


        /* =========================
           STATUS BADGE
           ========================= */

        .status-badge{

            display:inline-block;

            padding:8px 14px;

            border-radius:20px;

            font-size:13px;

            font-weight:bold;

            margin-top:5px;

        }


        .status-menunggu{

            background:#fff3cd;

            color:#856404;

        }


        .status-disetujui{

            background:#d4edda;

            color:#155724;

        }


        /* =========================
           BUTTON
           ========================= */

        .status-actions{

            text-align:right;

            margin-top:1rem;

        }


        .btn-cancel{

            background-color:#1e3a8a;

            color:white;

            border:none;

            padding:0.5rem 1rem;

            border-radius:4px;

            cursor:pointer;

        }


        .btn-cancel:hover{

            background-color:#3b82f6;

        }


        /* =========================
           EMPTY
           ========================= */

        .empty-status{

            background:#f1f5f9;

            border-radius:10px;

            padding:25px 15px;

            box-shadow:0 2px 5px rgba(0,0,0,0.1);

        }


        .empty-status i{

            font-size:40px;

            color:#1F4E9D;

        }


        .empty-status p{

            margin-top:10px;

            margin-bottom:0;

            color:#555;

        }


        /* =========================
           ALERT
           ========================= */

        .alert{

            font-size:13px;

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

            <a href="/dashboard">

                Home

            </a>

            >

            <a href="#">

                Status Pengajuan Lab

            </a>

        </nav>

    </div>


    <!-- =========================
         STATUS
         ========================= -->

    <div class="status-container">


        <h3>

            Status Pengajuan Lab Anda

        </h3>


        <!-- =========================
             NOTIFIKASI
             ========================= -->

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif


        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif


        <!-- =========================
             DAFTAR PENGAJUAN
             ========================= -->

        @forelse($pengajuan as $item)


            <div class="status-card">


                <!-- PEMINJAM -->

                <p>

                    Peminjam :

                    <strong>

                        {{ $item->user->name ?? auth()->user()->name }}

                    </strong>

                </p>


                <!-- JADWAL -->

                <p>

                    Jadwal :

                    <strong>

                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}

                        {{ \Carbon\Carbon::parse($item->jam_mulai)->format('H:i') }}

                        -

                        {{ \Carbon\Carbon::parse($item->jam_selesai)->format('H:i') }}

                    </strong>

                </p>


                <!-- KAPASITAS -->

                <p>

                    Kapasitas murid :

                    <strong>

                        {{ $item->lab->kapasitas_murid ?? '-' }}

                    </strong>

                </p>


                <!-- MAPEL -->

                <p>

                    Mapel :

                    <strong>

                        {{ $item->pelajaran->nama_pelajaran
                            ?? $item->pelajaran->nama
                            ?? '-' }}

                    </strong>

                </p>


                <!-- LAB -->

                <p>

                    Lab :

                    <strong>

                        {{ $item->lab->nama_lab ?? '-' }}

                    </strong>

                </p>


                <!-- STATUS -->

                <p>

                    Status :

                    


                    @if($item->status == 'menunggu')

                        <span class="status-badge status-menunggu">

                            <i class="bi bi-hourglass-split"></i>

                            Pending / Menunggu Persetujuan

                        </span>


                    @elseif($item->status == 'disetujui')

                        <span class="status-badge status-disetujui">

                            <i class="bi bi-check-circle"></i>

                            Disetujui

                        </span>

                    @endif

                </p>


                <!-- =========================
                     BATalkan
                     ========================= -->

                @if($item->status == 'menunggu')

                    <div class="status-actions">

                        <form
                            action="{{ route('statusajukan.batalkan', $item->id) }}"
                            method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan ini?')"
                        >

                            @csrf

                            @method('DELETE')


                            <button
                                type="submit"
                                class="btn-cancel"
                            >

                                Batalkan

                            </button>

                        </form>

                    </div>

                @endif


            </div>


        @empty


            <!-- =========================
                 BELUM ADA PENGAJUAN
                 ========================= -->

            <div class="empty-status">


                <i class="bi bi-info-circle"></i>


                <p>

                    Belum ada pengajuan peminjaman lab yang aktif.

                </p>


            </div>


        @endforelse


      <!-- =========================
     PAGINATION
========================= -->

@if($pengajuan->hasPages())

    <div class="pagination">

        <!-- SEBELUMNYA -->

        @if ($pengajuan->onFirstPage())

            <button
                type="button"
                class="disabled"
                disabled
            >
                &lt;
            </button>

        @else

            <a href="{{ $pengajuan->previousPageUrl() }}">

                <button type="button">
                    &lt;
                </button>

            </a>

        @endif


        <!-- NOMOR HALAMAN -->

        @php

            $currentPage = $pengajuan->currentPage();

            $lastPage = $pengajuan->lastPage();

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


        @for (
            $page = $startPage;
            $page <= $endPage;
            $page++
        )

            <a href="{{ $pengajuan->url($page) }}">

                <button
                    type="button"
                    class="{{ $currentPage == $page ? 'active' : '' }}"
                >

                    {{ $page }}

                </button>

            </a>

        @endfor


        <!-- BERIKUTNYA -->

        @if ($pengajuan->hasMorePages())

            <a href="{{ $pengajuan->nextPageUrl() }}">

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


    hamburgerBtn.addEventListener('click', function(){

        hamburgerDropdown.classList.toggle('show');

    });


</script>


</body>

</html>