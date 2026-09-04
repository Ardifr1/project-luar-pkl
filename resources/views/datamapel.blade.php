<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mapel</title>

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
   SEARCH AUTOCOMPLETE (PERKECIL & RESPONSIF)
========================= */
.search-box {
  position: relative;
  display: flex;
  align-items: center;
  gap: 6px; /* jarak antar elemen */
  justify-content: center;
}

.search-box input {
  width: 160px; /* diperkecil dari 180px */
  height: 30px;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding-left: 8px;
  font-size: 13px;
}

.search-box button {
  width: 36px;
  height: 30px;
  background-color: #1F4E9D;
  color: #fff;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 14px;
}

/* =========================
   RESPONSIVE FIX (TETAP SEJEJAR DI MOBILE)
========================= */
@media (max-width: 480px) {
  .search-box {
    flex-direction: row; /* tetap sejajar */
    justify-content: center;
    gap: 6px;
  }

  .search-box input {
    flex: 1; /* biar input menyesuaikan lebar */
    min-width: 120px;
  }

  .search-box button {
    flex-shrink: 0; /* tombol tetap kecil di samping */
  }
}

/* =========================
   SUGGESTIONS
========================= */
.search-suggestions {
  position: absolute;
  top: 40px;
  left: 0;
  width: 100%;
  background: #fff;
  border: 1px solid #ddd;
  border-radius: 6px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  z-index: 1000;
  display: none;
}

.search-suggestions a {
  display: block;
  padding: 8px 12px;
  text-decoration: none;
  color: #333;
  transition: background 0.2s ease;
}

.search-suggestions a:hover {
  background: #f1f5f9;
}

        /* =========================
           DATA MAPEL
           ========================= */

        .data-container {
            margin: 15px auto;
            background: #d9d9d9;
            width: 90%;
            height: 700px;
            padding: 15px;
            border-radius: 4px;

            position: relative;
        }

        .data-title {
            background: #eadede;
            text-align: center;
            padding: 8px;
            font-weight: 600;
            color: #333;
            margin-bottom: 0;
        }

        /* =========================
   TABLE MODERN DARK BLUE
========================= */
.table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

/* Header */
.table thead th {
  background: #102C6B;       /* biru gelap elegan */
  color: #fff;
  text-align: center;
  font-size: 12px;
  font-weight: 600;
  padding: 10px;
  text-transform: uppercase;
  border-bottom: 1px solid #0f2b80; /* garis bawah tipis */
  letter-spacing: 0.5px;
}

/* Body */
.table tbody td {
  font-weight: 600;
  text-align: center;
  vertical-align: middle;
  font-size: 11px;
  padding: 8px;
  border: 1px solid #bbb;   /* garis tipis abu gelap */
  background: #fff;
}

/* Zebra effect */
.table tbody tr:nth-child(odd) {
  background-color: #f9fafb;
}
.table tbody tr:nth-child(even) {
  background-color: #ffffff;
}

/* Hover effect */
.table tbody tr:hover {
  background-color: #e5e7eb; /* abu muda highlight */
  transition: background 0.2s ease;
  cursor: pointer;
}

/* =========================
   RESPONSIVE FIX
========================= */
@media (max-width: 480px) {
  .table thead th,
  .table tbody td {
    font-size: 10px;
    padding: 6px;
    border: 1px solid #999; /* tetap jelas di mobile */
  }
}
        /* =========================
           TOMBOL EDIT
           ========================= */

        .btn-edit {
            background: #eadede;
            border: none;
            padding: 5px 14px;
            font-size: 11px;
            border-radius: 4px;
            color: #333;
            text-decoration: none;
        }

        .btn-edit:hover {
            background: #d5c5c5;
        }

        /* =========================
           TOMBOL HAPUS
           ========================= */

        .btn-hapus {
            background: #b40c0c;
            border: none;
            padding: 5px 14px;
            font-size: 11px;
            border-radius: 4px;
            color: #ffffff;
        }

        .btn-hapus:hover {
            background: #675b5b;
        }

       /* =========================
           TOMBOL TAMBAH
           ========================= */

        .tambah-container {
    text-align: right;
    margin-bottom: 8px;
}

.btn-tambah {
    background: #39b62b;
    border: none;
    padding: 5px 14px; /* lebih kecil dari 5px 15px */
    font-size: 10px;   /* diperkecil dari 11px */
    border-radius: 3px;
    color: #222;
    text-decoration: none;
}

.btn-tambah:hover {
    background: #aaa;
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

            gap: 12px;
        }

        .pagination-container button {
            width: 30px;
            height: 30px;

            border: none;

            background: #c5c5c5;

            font-size: 12px;

            border-radius: 3px;
        }

        .pagination-container button:hover {
            background: #aaa;
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

            <a href="{{ route('data.mapel') }}">
                Data Mata pelajaran
            </a>

        </nav>


    </div>


    <!-- =========================
         DATA MAPEL
         ========================= -->

    <div class="data-container">


      <div class="d-flex justify-content-between align-items-center mb-3">

    <!-- SEARCH BOX -->
    <form method="GET" action="{{ route('data.mapel') }}" class="search-box" style="display:flex; align-items:center; gap:5px;">
        <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama mapel...">
        <button type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>

    <!-- TOMBOL TAMBAH -->
    <a href="{{ route('tambah.mapel') }}" class="btn-tambah">
        Tambah
    </a>

</div>



        <!-- JUDUL -->

        <div class="data-title">

            Data Mapel

        </div>


        <!-- =========================
             TABLE
             ========================= -->

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>

                        <th>
                            Nama Mata pelajaran
                        </th>

                        <th>
                            Edit
                        </th>

                        <th>
                            Hapus
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse ($pelajaran as $mapel)

                        <tr>

                            <td>
                                {{ $mapel->nama_pelajaran }}
                            </td>


                            <!-- EDIT -->

                            <td>

<a
    href="{{ route('edit.mapel', $mapel->id) }}"
    class="btn-edit"
>
    edit
</a>

                            </td>


                            <!-- HAPUS -->

                            <td>

<form
    action="{{ route('hapus.mapel', $mapel->id) }}"
    method="POST"
>
    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="btn-hapus"
    >
        hapus
    </button>
</form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="3"
                                class="text-center"
                            >

                                Belum ada data mata pelajaran.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- =========================
     PAGINATION
     ========================= -->
<div class="d-flex justify-content-center mt-3">
    {{ $pelajaran->links('pagination::bootstrap-5') }}
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

</script>


</body>
</html>