<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ajukan Peminjaman</title>


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
     align-items: center;
}


        .text-atas{
            color:black;
            margin-top:20px;
            text-align:center;
            font-size:30px;
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



        .menu-card {
    background: #1F4E9D;
    width: 82%;
    margin: 10px auto;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 3px 8px rgba(0,0,0,.2);
}


        .box1{
            margin-top:10px;
            background:#D9D9D9;
            width:100%;
            min-height:80px;
            border-radius:15px;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:15px;
        }

        .box1 p{
            text-align:center;
            padding:10px;
            margin:0;
            font-weight:bold;
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

        .server-error{
            margin-top:15px;
            padding:10px;
            background:#f8d7da;
            color:#842029;
            border-radius:10px;
            font-size:13px;
        }


        /* =========================
           SUCCESS
           ========================= */

        .success-message{
            display:none;
            margin-top:15px;
            padding:12px;
            background:#d1e7dd;
            color:#0f5132;
            border-radius:10px;
            font-size:13px;
            text-align:center;
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
    transform: scale(1.05);
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
    style="
        width:100px;
        height:100px;
        margin-right:10px;
        border-radius:20%;
    "
>



        <div class="hamburger-container">

            <button
                class="btn text-white"
                id="hamburgerBtn"
                type="button"
            >

                <i class="bi bi-list fs-1"></i>

            </button>


            <div
                class="hamburger-dropdown"
                id="hamburgerDropdown"
            >

                <a href="{{ route('profil.guru') }}">
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

            <a href="{{ route('dashboard') }}">
                Home
            </a>

            >

            <a href="#">
                Peminjaman
            </a>

        </nav>

    </div>


    <!-- =========================
         JUDUL
         ========================= -->

    <div class="text-atas">

        <p>
            {{ $labDipilih->nama_lab }}
        </p>

    </div>


    <!-- =========================
         CARD
         ========================= -->

    <div class="menu-card">


        <!-- LAB -->

        <div class="box1">

            <p>

                @if($labDipilih)

                    {{ $labDipilih->nama_lab }}

                @else

                    Silahkan pilih lab terlebih dahulu

                @endif

            </p>

        </div>


        <!-- =========================
             FORM
             ========================= -->

        <form
            id="formPeminjaman"
        >

            @csrf


            <!-- LAB ID -->

            @if($labDipilih)

                <input
                    type="hidden"
                    name="lab_id"
                    value="{{ $labDipilih->id }}"
                >

            @endif


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
            >{{ old('keterangan') }}</textarea>


            <!-- MATA PELAJARAN -->

            <select
                name="pelajaran_id"
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

                    <option
                        value="{{ $pelajaran->id }}"
                        {{ old('pelajaran_id') == $pelajaran->id ? 'selected' : '' }}
                    >

                        {{ $pelajaran->nama_pelajaran }}

                    </option>

                @endforeach

            </select>


            <!-- =========================
                 TANGGAL + JAM
                 ========================= -->

            <div class="tanggal-jam">


                <div class="tanggal-box">
 
                    <input
                        type="date"
                        name="tanggal"
                        id="tanggal"
                        value="{{ old('tanggal') }}"
                    >

                </div>


                <div class="pemisah"></div>


                <div class="jam-box">

                    <input
                        type="time"
                        name="jam_mulai"
                        id="jam_mulai"
                        value="{{ old('jam_mulai') }}"
                    >

                </div>


                <span class="tanda">

                    ->

                </span>


                <div class="jam-box">

                    <input
                        type="time"
                        name="jam_selesai"
                        id="jam_selesai"
                        value="{{ old('jam_selesai') }}"
                    >

                </div>

            </div>


            <!-- ERROR -->

            <div
                id="errorMessage"
                class="error-message"
            ></div>


            <!-- SUCCESS -->

            <div
                id="successMessage"
                class="success-message"
            ></div>


            <!-- SERVER ERROR -->

            @if($errors->any())

                <div class="server-error">

                    @foreach($errors->all() as $error)

                        <div>
                            {{ $error }}
                        </div>

                    @endforeach

                </div>

            @endif


            <!-- BUTTON -->

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

    // =========================================================
    // HAMBURGER
    // =========================================================

    const hamburgerBtn =
        document.getElementById('hamburgerBtn');

    const hamburgerDropdown =
        document.getElementById('hamburgerDropdown');


    hamburgerBtn.addEventListener('click', function(){

        hamburgerDropdown.classList.toggle('show');

    });


    // =========================================================
    // FORM PEMINJAMAN
    // =========================================================

    const formPeminjaman =
        document.getElementById('formPeminjaman');

    const errorMessage =
        document.getElementById('errorMessage');

    const successMessage =
        document.getElementById('successMessage');

    const btnAjukan =
        document.getElementById('btnAjukan');


    formPeminjaman.addEventListener(
        'submit',
        async function(event){

            event.preventDefault();


            // =================================================
            // AMBIL DATA
            // =================================================

            const labId =
                document.querySelector(
                    'input[name="lab_id"]'
                );

            const keterangan =
                document
                    .getElementById('keterangan')
                    .value
                    .trim();

            const pelajaran =
                document
                    .getElementById('pelajaran')
                    .value;

            const tanggal =
                document
                    .getElementById('tanggal')
                    .value;

            const jamMulai =
                document
                    .getElementById('jam_mulai')
                    .value;

            const jamSelesai =
                document
                    .getElementById('jam_selesai')
                    .value;


            let pesan = '';


            // =================================================
            // VALIDASI LAB
            // =================================================

            if(!labId){

                pesan =
                    'Silahkan pilih lab terlebih dahulu.';

            }


            // =================================================
            // VALIDASI KETERANGAN
            // =================================================

            else if(keterangan === ''){

                pesan =
                    'Keterangan tidak boleh kosong.';

            }


            // =================================================
            // VALIDASI PELAJARAN
            // =================================================

            else if(!pelajaran){

                pesan =
                    'Silahkan pilih mata pelajaran.';

            }


            // =================================================
            // VALIDASI TANGGAL
            // =================================================

            else if(!tanggal){

                pesan =
                    'Silahkan pilih tanggal peminjaman.';

            }


            // =================================================
            // VALIDASI JAM MULAI
            // =================================================

            else if(!jamMulai){

                pesan =
                    'Silahkan pilih jam mulai.';

            }


            // =================================================
            // VALIDASI JAM SELESAI
            // =================================================

            else if(!jamSelesai){

                pesan =
                    'Silahkan pilih jam selesai.';

            }


            // =================================================
            // VALIDASI JAM
            // =================================================

            else if(jamSelesai <= jamMulai){

                pesan =
                    'Jam selesai harus lebih besar dari jam mulai.';

            }


            // =================================================
            // TAMPILKAN ERROR
            // =================================================

            if(pesan !== ''){

                errorMessage.innerText = pesan;

                errorMessage.style.display = 'block';

                successMessage.style.display = 'none';

                return;

            }


            errorMessage.style.display = 'none';


            // =================================================
            // NONAKTIFKAN BUTTON
            // =================================================

            btnAjukan.disabled = true;

            btnAjukan.innerText =
                'Mengirim...';


            try {


                // =================================================
                // AMBIL CSRF TOKEN
                // =================================================

                const csrfToken =
                    document
                        .querySelector(
                            'meta[name="csrf-token"]'
                        )
                        .getAttribute('content');


                // =================================================
                // SIAPKAN DATA
                // =================================================

                const formData =
                    new window.FormData(formPeminjaman);


                // =================================================
                // KIRIM KE API
                // =================================================

                const response =
                    await fetch(
                        '/api/peminjaman',
                        {

                            method: 'POST',

                            headers: {

                                'X-CSRF-TOKEN':
                                    csrfToken,

                                'Accept':
                                    'application/json',

                                // =================================
                                // TOKEN SANCTUM
                                // =================================

                                'Authorization':
                                    'Bearer {{ session('api_token') }}'

                            },

                            credentials: 'same-origin',

                            body: formData

                        }
                    );


                // =================================================
                // AMBIL RESPONSE
                // =================================================

                const data =
                    await response.json();


                // =================================================
                // JIKA ERROR
                // =================================================

                if(!response.ok){

                    let pesanError =
                        data.message ||
                        'Pengajuan gagal dikirim.';


                    if(data.errors){

                        const semuaError =
                            Object.values(data.errors)
                                .flat();

                        pesanError =
                            semuaError.join('\n');

                    }


                    throw new Error(
                        pesanError
                    );

                }


                // =================================================
                // BERHASIL
                // =================================================

                successMessage.innerText =
                    data.message ||
                    'Pengajuan berhasil dikirim.';

                successMessage.style.display =
                    'block';


                // Bersihkan form

                formPeminjaman.reset();


                // =================================================
                // KEMBALIKAN BUTTON
                // =================================================

                btnAjukan.disabled = false;

                btnAjukan.innerText =
                    'Ajukan Peminjaman';


                // =================================================
                // PINDAH KE DASHBOARD
                // =================================================

                setTimeout(function(){

                    window.location.href =
                        "{{ route('dashboard') }}";

                }, 1000);


            } catch(error) {


                // =================================================
                // ERROR
                // =================================================

                errorMessage.innerText =
                    error.message ||
                    'Terjadi kesalahan saat mengirim pengajuan.';

                errorMessage.style.display =
                    'block';


                successMessage.style.display =
                    'none';


                btnAjukan.disabled =
                    false;

                btnAjukan.innerText =
                    'Ajukan Peminjaman';

            }

        }
    );

</script>


</body>

</html>