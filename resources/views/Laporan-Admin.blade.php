<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan Admin</title>


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
        }


        /* =========================
           BREADCRUMB + SEARCH
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


                /* =========================
   BREADCRUMB INTERAKTIF
========================= */
.menu-card1 {
  width: auto;      
  margin: 10px auto;
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
           SEARCH
           ========================= */

        .search-box {
            display: flex;
            align-items: center;
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


        /* =========================
           DATE RANGE
           ========================= */

        .date-container {
            width: 350px;
            margin-left: 30px;
            margin-top: 20px;
            min-height: 40px;
            background-color: #bdbdbd;
            margin-bottom: 8px;
            border-radius: 10px;
            text-align: center;
            color: black;
            padding: 6px;
        }


        .date-container input {
            border: none;
            border-radius: 5px;
            padding: 3px 5px;
            font-size: 12px;
        }


        .date-container button {
            border: none;
            background: #007bff;
            color: white;
            border-radius: 5px;
            padding: 3px 10px;
            font-size: 12px;
            cursor: pointer;
        }


        /* =========================
           PERINGATAN
           ========================= */

        .peringatan {
            width: 350px;
            margin: 10px auto;
            padding: 10px 12px;

            background-color: #fff3cd;
            border: 1px solid #ffecb5;

            color: #664d03;

            border-radius: 8px;

            font-size: 13px;

            display: flex;
            align-items: center;
            gap: 8px;
        }


        /* =========================
           DATA CONTAINER
           ========================= */

        .data-container {
            margin: 15px auto;
            background: #d9d9d9;
            width: 90%;
            min-height: 700px;
            padding: 15px;
            border-radius: 4px;

            position: relative;

            padding-bottom: 80px;
        }


        /* =========================
           TITLE
           ========================= */

        .data-title {
            background: #eadede;
            text-align: left;
            padding: 8px;
            font-weight: 600;
            color: #333;
            margin-bottom: 15px;
        }


        /* =========================
           DATA PENOLAKAN
           ========================= */

        .penolakan-item {
            background: #eeeeee;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 15px;
        }


        .isi-container {
            margin-left: 10px;
            margin-right: 5px;
            margin-top: 5px;

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 5px;
        }


        .lab-name {
            font-weight: 600;
            color: #222;

            max-width: 120px;

            overflow: hidden;

            text-overflow: ellipsis;
        }


        .tanggal {
            font-size: 13px;
            color: #333;
        }


        .tidak-setuju {
            font-size: 13px;
            background: #c99c9c;
            padding: 3px 7px;
            border-radius: 4px;
            white-space: nowrap;
        }


        /* =========================
           DETAIL PEMINJAMAN
           ========================= */

        .detail-peminjaman {
            margin-left: 10px;
            margin-top: 6px;

            font-size: 11px;

            color: #555;
        }


        /* =========================
           ALASAN PENOLAKAN
           ========================= */

        .alasan-container {
            background: #ff6767;

            width: 250px;

            min-height: 30px;

            border-radius: 10px;

            margin-left: 20px;

            margin-top: 10px;

            display: flex;

            justify-content: center;

            align-items: center;

            text-align: center;

            color: black;

            padding: 5px 10px;
        }


        .alasan-text {
            font-size: 12px;
            word-break: break-word;
        }


        /* =========================
           PEMBATAS
           ========================= */

        .pembatas {
            border: none;
            border-top: 1px solid #999;

            margin-top: 15px;
            margin-bottom: 0;
        }


        /* =========================
           TIDAK ADA DATA
           ========================= */

        .tidak-ada-data {
            text-align: center;

            padding: 30px 10px;

            color: #555;

            font-size: 14px;
        }


        /* =========================
           PAGINATION
           ========================= */

        .pagination-container {
            position: absolute;

            bottom: 20px;

            left: 0;

            width: 100%;

            display: flex;

            justify-content: center;

            align-items: center;

            gap: 8px;
        }


        .pagination-container a {
            text-decoration: none;
        }


        .pagination-container button {
            width: 30px;
            height: 30px;

            border: none;

            background: #c5c5c5;

            font-size: 12px;

            border-radius: 3px;

            cursor: pointer;
        }


        .pagination-container button:hover {
            background: #aaa;
        }


        .pagination-container .active {
            background: #007bff;
            color: white;
        }


        .pagination-container .disabled {
            opacity: 0.5;
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



    <!-- =========================
         BREADCRUMB + SEARCH
         ========================= -->

    <div class="menu-card1">


        <nav class="breadcrumb">

            <a href="{{ route('dashboardadmin') }}">
                Home
            </a>

            >

            <a href="{{ route('laporan.admin') }}">
                Laporan Admin
            </a>

        </nav>


        <!-- SEARCH -->

        <form
            action="{{ route('laporan.admin') }}"
            method="GET"
            class="search-box"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari..."
            >


            <button type="submit">

                <i class="bi bi-search"></i>

            </button>

        </form>

    </div>



    <!-- =========================
         DATE RANGE
         ========================= -->

    <form
        action="{{ route('laporan.admin') }}"
        method="GET"
    >

        @if(request('search'))

            <input
                type="hidden"
                name="search"
                value="{{ request('search') }}"
            >

        @endif


        <div class="date-container">


            <div class="mb-1">

                <small>
                    Date Range
                </small>

            </div>

<!-- Tombol buka popup -->
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#filterModal">
    Filter Tanggal
</button>

            <input
                type="date"
                name="tanggal_mulai"
                value="{{ request('tanggal_mulai') }}"
            >


            <span>
                -
            </span>


            <input
                type="date"
                name="tanggal_selesai"
                value="{{ request('tanggal_selesai') }}"
            >


        
    </form>



    <!-- =========================
         PERINGATAN
         ========================= -->

    @if(session('error'))

        <div class="peringatan">

            <i class="bi bi-exclamation-triangle-fill"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif



    <!-- =========================
         DATA PENOLAKAN
         ========================= -->

    <div class="data-container">


        <!-- JUDUL -->

        <div class="data-title">

            Daftar Penolakan

        </div>



        <!-- =========================
             DATA
             ========================= -->

        @forelse($penolakan as $data)


            <div class="penolakan-item">


                <!-- DATA UTAMA -->

                <div class="isi-container">


                    <!-- LAB -->

                    <div class="lab-name">

                        {{ $data->lab->nama_lab ?? '-' }}

                    </div>


                    <!-- TANGGAL -->

                    <div class="tanggal">

                        {{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}

                    </div>


                    <!-- STATUS -->

                    <div class="tidak-setuju">

                        Tidak setuju

                    </div>


                </div>



                <!-- =========================
                     DETAIL GURU
                     ========================= -->

                <div class="detail-peminjaman">

                    Guru:

                    <strong>
                        {{ $data->user->name ?? '-' }}
                    </strong>


                    @if($data->pelajaran)

                        <br>

                        Pelajaran:

                        <strong>
                            {{ $data->pelajaran->nama_pelajaran ?? '-' }}
                        </strong>

                    @endif


                    @if($data->jam_mulai && $data->jam_selesai)

                        <br>

                        Jam:

                        <strong>
                            {{ $data->jam_mulai }}
                            -
                            {{ $data->jam_selesai }}
                        </strong>

                    @endif

                </div>



                <!-- =========================
                     ALASAN PENOLAKAN
                     ========================= -->

                <div class="alasan-container">

                    <div class="alasan-text">

                        <strong>
                            Alasan:
                        </strong>

                        {{ $data->alasan_penolakan ?? 'Tidak ada alasan.' }}

                    </div>

                </div>



                <hr class="pembatas">


            </div>


        @empty


            <!-- =========================
                 TIDAK ADA DATA
                 ========================= -->

            <div class="tidak-ada-data">

                <i class="bi bi-inbox fs-2"></i>

                <br>

                @if(request('tanggal_mulai') || request('tanggal_selesai'))

                    Data laporan tidak ditemukan pada rentang tanggal yang dipilih.

                @elseif(request('search'))

                    Data laporan tidak ditemukan berdasarkan pencarian.

                @else

                    Belum ada pengajuan yang ditolak.

                @endif

            </div>


        @endforelse



        <!-- =========================
             PAGINATION
             ========================= -->

        @if($penolakan->hasPages())


            <div class="pagination-container">


                <!-- PREVIOUS -->

                @if($penolakan->onFirstPage())


                    <button
                        type="button"
                        class="disabled"
                        disabled
                    >

                        &lt;

                    </button>


                @else


                    <a href="{{ $penolakan->previousPageUrl() }}">

                        <button type="button">

                            &lt;

                        </button>

                    </a>


                @endif



                <!-- NOMOR HALAMAN -->

                @foreach(
                    $penolakan->getUrlRange(
                        max(1, $penolakan->currentPage() - 2),
                        min(
                            $penolakan->lastPage(),
                            $penolakan->currentPage() + 2
                        )
                    )
                    as $page => $url
                )


                    @if($page == $penolakan->currentPage())


                        <a href="{{ $url }}">

                            <button
                                type="button"
                                class="active"
                            >

                                {{ $page }}

                            </button>

                        </a>


                    @else


                        <a href="{{ $url }}">

                            <button type="button">

                                {{ $page }}

                            </button>

                        </a>


                    @endif


                @endforeach



                <!-- NEXT -->

                @if($penolakan->hasMorePages())


                    <a href="{{ $penolakan->nextPageUrl() }}">

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

<!-- Modal Filter -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="filterModalLabel">Filter Tanggal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="{{ route('laporan.admin') }}" method="GET">
          @if(request('search'))
            <input type="hidden" name="search" value="{{ request('search') }}">
          @endif

          <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ request('tanggal_mulai') }}" class="form-control">
          </div>

          <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ request('tanggal_selesai') }}" class="form-control">
          </div>

          <button type="submit" class="btn btn-primary">Terapkan Filter</button>
        </form>
      </div>

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


    hamburgerBtn.addEventListener('click', function () {

        hamburgerDropdown.classList.toggle('show');

    });


    /*
     * Tutup dropdown jika klik di luar
     */

    document.addEventListener('click', function (event) {

        if (
            !hamburgerBtn.contains(event.target) &&
            !hamburgerDropdown.contains(event.target)
        ) {

            hamburgerDropdown.classList.remove('show');

        }

    });

</script>


</body>

</html>