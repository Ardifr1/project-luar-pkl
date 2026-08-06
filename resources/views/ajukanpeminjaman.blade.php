<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#222;
        }

        .phone{
            max-width:360px;
            min-height:800px;
            margin:20px auto;
            background:#fff;
        }

        .header{
            background:#102C6B;
            height:82px;
            justify-content:space-between;
            display:flex;
        }
     .text-atas{
            
            color:black;
            margin-top:20px;
            text-align:center;
            font-size:30px;
        }

        .menu-card{
            background:#1F4E9D;
            width:300px;
            margin:10px auto;
            padding:20px;
            border-radius:4px;
            box-shadow:0 3px 8px rgba(0,0,0,.2);
            border-radius:15px;
        }


        .menu-text{
            color:white;
            text-align:center;
            margin-top:10px;
            font-size:18px;
        }
        .box1{
            margin-top:10px;
            background:#D9D9D9;
            width:100%;
            height:150px;
            border-radius:15px;
        }
        .box1 p{
            text-align:center;
            
            padding:20px;
        }
        
        .box2{
            margin-top:40px;
            background:#D9D9D9;
            width:100%;
            height:60px;
            border-radius:15px;
        }
         .box2 p{
            text-align:left;
            padding:20px;
        }
        .box3{
            margin-top:40px;
            background:#D9D9D9;
            width:100%;
            height:60px;
            border-radius:15px;
        }
         .box3 p{
            text-align:left;
            padding:20px;
        }
        .android-nav{
    background:#102C6B;
    height:55px;
    margin-top:40px;
    display:flex;
    justify-content:space-around;
    align-items:center;
    color:white;
    font-size:24px;
    position:fixed;
    bottom:0;
    width:360px;
    
}

        .back{
            color:#fff;
            font-size:24px;
        }

        .home{
            width:22px;
            height:22px;
            background:#fff;
        }

        .recent{
            width:24px;
            height:24px;
            background:#fff;
            border-radius:50%;
        }

    </style>

</head>
<body>

<div class="phone">

    <div class="header">
    <img src="{{asset ('gambar/download.png') }}" alt="logo" class="logo" style="width:80px; height:80px; margin-right:10px; border-radius:20%">
    <button class="btn text-white">
    <i class="bi bi-list fs-1"></i>
</button>

    </div>
<div class="text-atas"><p>Peminjaman Lab</p></div>
    <div class="menu-card">
    
    <div class="box1">
        <p>ruang lab komputer</p>
    </div>
<form action="/dashboard" method="post">
    @csrf
    <select class="pilih-guru" name="Guru_id" style="width:100%; height:45px; border-radius:15px; background:#D9D9D9; border:none; margin-top:40px;"> 
         <option value="" selected disabled hidden><p>Silahkan Pilih Guru</option>    
         @foreach($gurus as $guru)
            <option value="{{ $guru->id }}" >{{ $guru->nama_guru }}</option>
             @endforeach
         </select>
        <select class="pilih-guru" name="Pelajaran_id[]"  style="width:100%; height:45px; border-radius:15px; background:#D9D9D9; border:none; margin-top:40px;">
               
            <option value="" selected disabled hidden><p>Silahkan Pilih Mata Pelajaran</option>
            @foreach($pelajarans as $pelajaran)
                <option value="{{ $pelajaran->id }}" ><p>{{ $pelajaran->nama_pelajaran }}</option>
            @endforeach
         </select>
         <div style="margin-top:40px;">
    <input
        type="date"
        name="tanggal_peminjaman"
        style="width:100%; height:45px; border-radius:15px; background:#D9D9D9; border:none; padding:0 15px;">
</div>
    <div><a href="/dashboard"
    id="btnAjukan"
   class="btn btn-primary d-flex justify-content-center align-items-center"
   style="width:100%; height:45px; border-radius:15px; background:#102C6B; margin-top:40px;">
    Ajukan Peminjaman
</a></div>
</form>
         

</div>

    <div class="android-nav">

        <div class="back">◀</div>

        <div class="home"></div>

        <div class="recent"></div>

    </div>

</div>

<script>
document.getElementById('btnAjukan').addEventListener('click', function (e) {

    const guru = document.querySelector('select[name="Guru_id"]').value;
    const pelajaran = document.querySelector('select[name="Pelajaran_id[]"]').value;
    const tanggal = document.querySelector('input[name="tanggal_peminjaman"]').value;

    if (!guru || !pelajaran || !tanggal) {
        e.preventDefault(); // Membatalkan pindah halaman
        alert('Silakan lengkapi Guru, Mata Pelajaran, dan Tanggal terlebih dahulu.');
    }

});
</script>

</body>
</html>