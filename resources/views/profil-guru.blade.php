<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Guru</title>

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
    <a href="#">profil</a>
  </nav>


</body>
</html>