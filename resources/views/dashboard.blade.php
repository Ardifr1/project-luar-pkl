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
            min-height:600px;
            margin:20px auto;
            background:#fff;
        }

        .header{
            background:#102C6B;
            height:82px;
            justify-content:space-between;
            display:flex;
        }


        .menu-card{
            background:#1F4E9D;
            width:300px;
            margin:50px auto;
            padding:20px;
            border-radius:4px;
            box-shadow:0 3px 8px rgba(0,0,0,.2);
            border-radius:15px;
        }

        .icon-box{
            width:75px;
            height:75px;
            background:#ececec;
            margin:auto;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .icon-box i{
            font-size:38px;
            color:#000;
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
            height:60px;
            border-radius:15px;
        }
        .box1 p{
            text-align:left;
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

    <div class="menu-card">
    
    <a href="{{ route('ajukanpeminjaman') }}" class="text-decoration-none">
    <div class="box1">
        <p>Ajukan Peminjaman Lab</p>
    </div>
</a>
        <div class="box2"> <p>Jadwal Peminjaman Lab</p>   
        </div>
        <div class="box3"> <p>Laporan Penolakan</p>    
        </div>
        
</div>

   

</div>

</body>
</html>