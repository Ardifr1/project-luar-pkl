<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Status Ajukan Lab</title>


    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>



        body {
            background: #222;
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
            align-items: center;
        }


        .menu-text{
            color:white;
            text-align:center;
            margin-top:10px;
            font-size:18px;
        }
.menu-card1 {
  width: auto;      
  margin: 10px auto;
  height: 60px;
  background-color: #f1f5f9;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  transition: box-shadow 0.3s ease;
}

.breadcrumb a {
  color: #1F4E9D;
  text-decoration: none;
  margin-right: 5px;
  font-weight: 500;
  transition: color 0.3s ease, transform 0.2s ease;
}





        /* =========================
           PHONE
        ========================= */

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


        .menu-text {
            color: white;
            text-align: center;
            margin-top: 10px;
            font-size: 18px;
        }


        /* =========================
           BREADCRUMB
        ========================= */



        .breadcrumb {
            margin: 0;
        }


        .breadcrumb a {
            color:  #1F4E9D;
            text-decoration: none;
            margin-right: 5px;
        }


        /* =========================
           HAMBURGER CONTAINER
        ========================= */

        .hamburger-container {
            position: relative;
        }


        /* =========================
           HAMBURGER BUTTON
        ========================= */

        #hamburgerBtn {
            background: transparent;
            border: none;
            font-size: 28px;
            color: white;

            transition:
                opacity 0.2s ease,
                transform 0.2s ease;
        }


        #hamburgerBtn:hover {
            opacity: 0.8;
            transform: scale(1.05);
        }


        /* =========================
           HAMBURGER DROPDOWN
        ========================= */

        .hamburger-dropdown {
            display: none;

            position: absolute;

            top: 70px;
            right: 10px;

            width: 200px;

            background: #f9f9f9;

            border-radius: 10px;

            overflow: hidden;

            box-shadow:
                0 4px 10px rgba(0, 0, 0, 0.15);

            opacity: 0;

            transform: translateY(-5px);

            transition:
                opacity 0.3s ease,
                transform 0.3s ease;

            z-index: 1000;
        }


        /* DROPDOWN AKTIF */

        .hamburger-dropdown.show {
            display: block;

            opacity: 1;

            transform: translateY(0);
        }


        /* =========================
           LINK DROPDOWN
        ========================= */

        .hamburger-dropdown a,
        .hamburger-dropdown button {

            display: block;

            width: 100%;

            padding: 12px;

            color: #333;

            text-decoration: none;

            text-align: left;

            font-size: 14px;

            transition:
                background 0.2s ease,
                color 0.2s ease;

            border: none;

            border-bottom: 1px solid #eee;

            background: #f9f9f9;
        }


        .hamburger-dropdown button {
            background: #D9D9D9;
            padding: 15px;
        }


        .hamburger-dropdown a:hover,
        .hamburger-dropdown button:hover {

            background: #e5e5e5;
        }


        .hamburger-dropdown form {
            margin: 0;
        }


        /* =========================
           STATUS CONTAINER
        ========================= */

        .status-container {

            background-color: #e2e8f0;

            border-radius: 8px;

            padding: 1rem;

            width: 85%;

            margin: 1rem auto;

            text-align: center;
        }


        /* =========================
           TITLE
        ========================= */

        .status-container h3 {

            font-size: 20px;

            margin-bottom: 20px;

            color: #102C6B;
        }


        /* =========================
           STATUS CARD
        ========================= */

        .status-card {

            background-color: #f1f5f9;

            border-radius: 10px;

            padding: 1rem;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.1);

            text-align: left;

            margin-bottom: 20px;
        }


        /* =========================
           TEXT CARD
        ========================= */

        .status-card p {

            margin: 0.7rem 0;
        }


        /* =========================
           STATUS BADGE
        ========================= */

        .status-badge {

            display: inline-block;

            padding: 8px 14px;

            border-radius: 20px;

            font-size: 13px;

            font-weight: bold;

            margin-top: 5px;
        }


        /* MENUNGGU */

        .status-menunggu {

            background: #fff3cd;

            color: #856404;
        }


        /* DISETUJUI */

        .status-disetujui {

            background: #d4edda;

            color: #155724;
        }


        /* DIBATALKAN */

        .status-dibatalkan {

            background: #f8d7da;

            color: #842029;
        }


        /* DITOLAK */

        .status-ditolak {

            background: #f8d7da;

            color: #842029;
        }


        /* =========================
           ACTION
        ========================= */

        .status-actions {

            text-align: right;

            margin-top: 1rem;
        }


        /* =========================
           BUTTON BATALKAN
        ========================= */

        .btn-cancel {

            background-color: #1e3a8a;

            color: white;

            border: none;

            padding: 0.5rem 1rem;

            border-radius: 4px;

            cursor: pointer;

            transition:
                background-color 0.2s ease;
        }


        .btn-cancel:hover {

            background-color: #3b82f6;
        }


        .btn-cancel:disabled {

            opacity: 0.6;

            cursor: not-allowed;
        }


        /* =========================
           EMPTY
        ========================= */

        .empty-status {

            background: #f1f5f9;

            border-radius: 10px;

            padding: 25px 15px;

            box-shadow:
                0 2px 5px rgba(0, 0, 0, 0.1);
        }


        .empty-status i {

            font-size: 40px;

            color: #1F4E9D;
        }


        .empty-status p {

            margin-top: 10px;

            margin-bottom: 0;

            color: #555;
        }


        /* =========================
           ALERT
        ========================= */

        .alert {

            font-size: 13px;
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


        <!-- LOGO -->

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


        <!-- =========================
             HAMBURGER
        ========================= -->

        <div class="hamburger-container">


            <button
                class="btn text-white"
                id="hamburgerBtn"
                type="button"
            >

                <i class="bi bi-list fs-1"></i>

            </button>


            <!-- =========================
                 DROPDOWN
            ========================= -->

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
                Status ajukan lab
            </a>

        </nav>

    </div>



    <!-- =========================
         STATUS CONTAINER
    ========================= -->

    <div class="status-container">


        <h3>

            Status Pengajuan Lab Anda

        </h3>


        <!-- =========================
             SUCCESS
        ========================= -->

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif


        <!-- =========================
             ERROR
        ========================= -->

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

                        {{
                            $item->pelajaran->nama_pelajaran
                            ?? $item->pelajaran->nama
                            ?? '-'
                        }}

                    </strong>

                </p>


                <!-- LAB -->

                <p>

                    Lab :

                    <strong>

                        {{ $item->lab->nama_lab ?? '-' }}

                    </strong>

                </p>


                <!-- =========================
                     STATUS
                ========================= -->

                <p>

                    Status :


                    <!-- MENUNGGU -->

                    @if($item->status == 'menunggu')

                        <span class="status-badge status-menunggu">

                            <i class="bi bi-hourglass-split"></i>

                            Pending / Menunggu Persetujuan

                        </span>


                    <!-- DISETUJUI -->

                    @elseif($item->status == 'disetujui')

                        <span class="status-badge status-disetujui">

                            <i class="bi bi-check-circle"></i>

                            Disetujui

                        </span>


                    <!-- DIBATALKAN -->

                    @elseif($item->status == 'dibatalkan')

                        <span class="status-badge status-dibatalkan">

                            <i class="bi bi-x-circle"></i>

                            Dibatalkan

                        </span>


                    <!-- DITOLAK -->

                    @elseif($item->status == 'ditolak')

                        <span class="status-badge status-ditolak">

                            <i class="bi bi-x-circle"></i>

                            Ditolak

                        </span>

                    @endif

                </p>


                <!-- =========================
                     TOMBOL BATALKAN
                ========================= -->

                @if($item->status == 'menunggu')

                    <div class="status-actions">


                        <button
                            type="button"
                            class="btn-cancel btn-batalkan"
                            data-id="{{ $item->id }}"
                        >

                            Batalkan

                        </button>


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

                @if($pengajuan->onFirstPage())

                    <button
                        type="button"
                        class="disabled"
                        disabled
                    >

                        &lt;

                    </button>

                @else

                    <a
                        href="{{ $pengajuan->previousPageUrl() }}"
                    >

                        <button type="button">

                            &lt;

                        </button>

                    </a>

                @endif


                <!-- =========================
                     NOMOR HALAMAN
                ========================= -->

                @php

                    $currentPage =
                        $pengajuan->currentPage();

                    $lastPage =
                        $pengajuan->lastPage();


                    if ($currentPage <= 2) {

                        $startPage = 1;

                    } elseif ($currentPage >= $lastPage - 1) {

                        $startPage = max(
                            1,
                            $lastPage - 2
                        );

                    } else {

                        $startPage =
                            $currentPage - 1;

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

                    <a
                        href="{{ $pengajuan->url($page) }}"
                    >

                        <button
                            type="button"
                            class="{{
                                $currentPage == $page
                                ? 'active'
                                : ''
                            }}"
                        >

                            {{ $page }}

                        </button>

                    </a>

                @endfor


                <!-- =========================
                     BERIKUTNYA
                ========================= -->

                @if($pengajuan->hasMorePages())

                    <a
                        href="{{ $pengajuan->nextPageUrl() }}"
                    >

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
     JAVASCRIPT
========================= -->

<script>


    /* =========================
       HAMBURGER
    ========================= */

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

    </script>

<script>
    /* =========================
       BATALKAN PENGAJUAN
    ========================= */

    const tombolBatalkan =
        document.querySelectorAll('.btn-batalkan');


    tombolBatalkan.forEach(function(button) {


        button.addEventListener(
            'click',
            async function() {


                /* =========================
                   AMBIL ID
                ========================= */

                const id =
                    this.dataset.id;


                /* =========================
                   KONFIRMASI
                ========================= */

                const yakin =
                    confirm(
                        'Apakah Anda yakin ingin membatalkan pengajuan ini?'
                    );


                if (!yakin) {

                    return;

                }


                /* =========================
                   DISABLE BUTTON
                ========================= */

                this.disabled = true;

                this.innerText =
                    'Membatalkan...';


                try {


                    /* =========================
                       CSRF TOKEN
                    ========================= */

                    const csrfToken =
                        document
                        .querySelector(
                            'meta[name="csrf-token"]'
                        )
                        .getAttribute('content');


                    /* =========================
                       REQUEST DELETE
                    ========================= */

                    const response =
                        await fetch(
                            "{{ url('/statusajukan-lab') }}/" +
                            id +
                            "/batalkan",
                            {

                                method: 'DELETE',

                                headers: {

                                    'X-CSRF-TOKEN':
                                        csrfToken,

                                    'Accept':
                                        'application/json'

                                }

                            }
                        );


                    /* =========================
                       BACA RESPONSE
                    ========================= */

                    const result =
                        await response.json();


                    console.log(
                        'Status HTTP:',
                        response.status
                    );


                    console.log(
                        'Response:',
                        result
                    );


                    /* =========================
                       BERHASIL
                    ========================= */

                    if (
                        response.status === 200 &&
                        result.success === true
                    ) {


                        alert(
                            result.message
                            ??
                            'Pengajuan berhasil dibatalkan.'
                        );


                        /*
                         * Reload halaman
                         * agar status menjadi Dibatalkan
                         */

                        window.location.reload();


                        return;

                    }


                    /* =========================
                       GAGAL
                    ========================= */

                    alert(
                        result.message
                        ??
                        'Pengajuan gagal dibatalkan.'
                    );


                    this.disabled = false;

                    this.innerText =
                        'Batalkan';


                } catch(error) {


                    /* =========================
                       ERROR
                    ========================= */

                    console.error(
                        'Error:',
                        error
                    );


                    alert(
                        'Terjadi kesalahan saat membatalkan pengajuan.'
                    );


                    this.disabled = false;

                    this.innerText =
                        'Batalkan';

                }

            }
        );

    });

</script>


</body>

</html>