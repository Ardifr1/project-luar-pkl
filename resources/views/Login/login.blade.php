<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

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
            background:#fff;
            padding:10px;
        }


        .logo img{
            width:100px;
            height:100px;
        }
        .text-atas{
            
            color:black;
            padding:10px;
            text-align:center;
            font-size:16px;
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
            height:52px;
            border-radius:15px;
        }
        .box1 p{
            text-align:center;
            padding:15px;
        }
        
        .box2{
            margin-top:40px;
            background:#D9D9D9;
            width:100%;
            height:52px;
            border-radius:15px;
        }
         .box2 p{
            text-align:center;
            padding:15px;
        }
      
       
    </style>
</head>
<body>



<div class="phone">

    <div class="header">
        <div class="user-btn"></div>
    </div>

     <div class="text-center logo mb-4">
            <img src="{{asset ('gambar/download.png') }}" class="logo"alt="">
        </div>


    <div class="container py-4">
        <div class="text-atas"><p>Posisi sebagai</p></div>

     <div class="menu-card">
    
    <a href="{{ route('ajukanpeminjaman') }}" class="text-decoration-none">
    <div class="box1">
        <p>Guru</p>
    </div>
</a>
        <a href="{{ route('admin') }}" class="text-decoration-none">
        <div class="box2"> <p>Admin</p>   
        </div>
       
</div>


</form>

        </div>

        </div>

    </div>

</div>

</body>
</html>