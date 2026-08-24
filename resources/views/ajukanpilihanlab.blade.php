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


        /* =========================
           TIMER
        ========================= */

        .timer {
            display: inline-block;
            margin-left: 5px;
            font-size: 12px;
            font-weight: bold;
            color: #991b1b;
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
                     * Gunakan timezone Jakarta secara eksplisit.
                     */

                    $timezone = 'Asia/Jakarta';

                    $sekarang = \Carbon\Carbon::now($timezone);


                    /*
                     * Cari peminjaman yang sedang berlangsung.
                     *
                     * Syarat:
                     * - status disetujui
                     * - tanggal sesuai
                     * - sekarang berada antara jam mulai
                     *   dan jam selesai
                     */

                    $peminjaman = $lab->peminjaman
                        ->where('status', 'disetujui')
                        ->filter(function ($pinjam) use ($sekarang, $timezone) {

                            if (
                                !$pinjam->tanggal ||
                                !$pinjam->jam_mulai ||
                                !$pinjam->jam_selesai
                            ) {
                                return false;
                            }


                            $mulai = \Carbon\Carbon::parse(
                                $pinjam->tanggal . ' ' . $pinjam->jam_mulai,
                                $timezone
                            );


                            $selesai = \Carbon\Carbon::parse(
                                $pinjam->tanggal . ' ' . $pinjam->jam_selesai,
                                $timezone
                            );


                            return $sekarang->between(
                                $mulai,
                                $selesai
                            );

                        })
                        ->sortBy(function ($pinjam) use ($timezone) {

                            return \Carbon\Carbon::parse(
                                $pinjam->tanggal . ' ' . $pinjam->jam_mulai,
                                $timezone
                            )->timestamp;

                        })
                        ->first();


                    /*
                     * Jika ada peminjaman aktif,
                     * buat waktu selesai untuk timer.
                     */

                    $waktuSelesai = null;

                    if ($peminjaman) {

                        $waktuSelesai = \Carbon\Carbon::parse(
                            $peminjaman->tanggal . ' ' . $peminjaman->jam_selesai,
                            $timezone
                        )->toIso8601String();

                    }

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

                            {{ $peminjaman->pelajaran->nama_pelajaran ?? '-' }}

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


                        <!-- =========================
                             TIMER
                        ========================= -->

                        <p>

                            <strong>Sisa waktu:</strong>

                            <span
                                class="timer"
                                data-end="{{ $waktuSelesai }}"
                            >

                                Menghitung...

                            </span>

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

                    @if(
                        $peminjaman ||
                        $lab->status == 'sedang_maintenance'
                    )


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
     JAVASCRIPT
========================= -->

<script>

    /* =========================================
       HAMBURGER
    ========================================= */

    document.addEventListener('DOMContentLoaded', function () {

        const hamburgerBtn =
            document.getElementById('hamburgerBtn');

        const hamburgerDropdown =
            document.getElementById('hamburgerDropdown');


        if (hamburgerBtn && hamburgerDropdown) {

            hamburgerBtn.addEventListener('click', function () {

                hamburgerDropdown.classList.toggle('show');

            });

        }


        /* =========================================
           TIMER PEMINJAMAN
        ========================================= */

        const timers =
            document.querySelectorAll('.timer');


        timers.forEach(function (timer) {

            const endTimeString =
                timer.getAttribute('data-end');


            /*
             * Jika data-end kosong,
             * jangan jalankan timer.
             */

            if (!endTimeString) {

                timer.textContent = '-';

                return;

            }


            /*
             * Ubah waktu ISO menjadi timestamp.
             */

            const endTime =
                new Date(endTimeString).getTime();


            /*
             * Pastikan tanggal valid.
             */

            if (isNaN(endTime)) {

                timer.textContent = 'Waktu tidak valid';

                console.error(
                    'Timer error: data-end tidak valid:',
                    endTimeString
                );

                return;

            }


            let interval;


            function updateTimer() {

                const sekarang =
                    Date.now();


                const selisih =
                    endTime - sekarang;


                /*
                 * Jika waktu sudah habis.
                 */

                if (selisih <= 0) {

                    timer.textContent =
                        'Waktu selesai';


                    clearInterval(interval);


                    /*
                     * Reload halaman agar status lab
                     * diperbarui oleh Laravel.
                     */

                    setTimeout(function () {

                        window.location.reload();

                    }, 1000);


                    return;

                }


                /*
                 * Hitung jam.
                 */

                const jam =
                    Math.floor(
                        selisih /
                        (1000 * 60 * 60)
                    );


                /*
                 * Hitung menit.
                 */

                const menit =
                    Math.floor(
                        (selisih %
                        (1000 * 60 * 60)) /
                        (1000 * 60)
                    );


                /*
                 * Hitung detik.
                 */

                const detik =
                    Math.floor(
                        (selisih %
                        (1000 * 60)) /
                        1000
                    );


                /*
                 * Tampilkan HH:MM:SS.
                 */

                timer.textContent =
                    String(jam).padStart(2, '0')
                    + ':'
                    + String(menit).padStart(2, '0')
                    + ':'
                    + String(detik).padStart(2, '0');

            }


            /*
             * Jalankan langsung.
             */

            updateTimer();


            /*
             * Update setiap 1 detik.
             */

            interval =
                setInterval(
                    updateTimer,
                    1000
                );

        });

    });

</script>


</body>

</html>