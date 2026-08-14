<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        .menu-card{
            background:#1F4E9D;
            width:320px;
            margin:50px auto;
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

        .menu-card1 {
  width: 400px;      
  height: 40px;
  background-color: #d9d9d9;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding:  20px;
  border: 1px solid #aaa;
  border-radius: 6px;
}

.breadcrumb a {
  color: #007bff;
  text-decoration: none;
  margin-right: 5px;
}

.search-box {
  display: flex;
  align-items: ;
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

        .box1{
            margin-top:10px;
            background:#D9D9D9;
            width:100%;
            height:58px;
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
            height:58px;
            border-radius:15px;
        }
         .box2 p{
            text-align:center;
            padding:20px;
        }
        .box3{
            margin-top:40px;
            background:#D9D9D9;
            width:100%;
            height:58px;
            border-radius:15px;
        }
         .box3 p{
            text-align:center;
            padding:20px;
        }
        .box4{
            margin-top:40px;
            margin-bottom:20px;
            background:#D9D9D9;
            width:100%;
            height:58px;
            border-radius:15px;
        }
         .box4 p{
            text-align:center;
            padding:20px;
        }
       
        
    </style>



</head>
<body>
    <div class="phone">

    <div class="header">
    <img src="{{asset ('gambar/download.png') }}" alt="logo" class="logo" style="width:100px; height:100px; margin-right:10px; border-radius:20%">
    <button class="btn text-white">
    <i class="bi bi-list fs-1"></i>
</button>

    </div>

<div class="menu-card1">
  <nav class="breadcrumb">
    <a href="#">Home</a> >
    <a href="#"></a>
  </nav>
  <div class="search-box">
    <input type="text" placeholder="Cari...">
    <button><i class="fa fa-search"></i></button>
  </div>
</div>


    <div class="menu-card">

    <a href="{{ route('ajukanpeminjaman') }}" class="text-decoration-none">
    <div class="box1">
        <p>Data Guru</p>
    </div>
</a>
        <div class="box2"> <p>Data Lab</p>   
        </div>
        <div class="box3"> <p>Laporan</p>    
        </div>
        <div class="box4"> <p>Daftar ajukan</p>
        </div>
</div>

   

</div>


</body>
</html>