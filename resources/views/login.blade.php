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
            width:80px;
            height:80px;
        }
        .text-atas{
            
            color:black;
            padding:10px;
            text-align:center;
            font-size:30px;
        }

        .login-box{
            background:#fff;
            padding:20px;
            border-radius:5px;
        }
        .login{
            background:gray;
            color:#fff;
            border:none;
            border-radius:30px;
            width:50%;
            height:45px;
            font-weight:bold;
        }
        
    </style>
</head>
<body>

<div class="phone">

    <div class="header">
        <div class="user-btn"></div>
    </div>

    <div class="container py-4">
        <div class="text-atas"><p>Login</p></div>

        <div class="text-center logo mb-4">
            <img src="{{asset ('gambar/download.png') }}" class="logo"alt="">
        </div>

        <div class="login-box">
<form action="{{ route('login') }}" method="POST">
    @csrf

    {{-- Error Username --}}
    @error('username')
        <div class="alert alert-danger py-2">
            {{ $message }}
        </div>
    @enderror

    <input type="text"
           name="username"
           value="{{ old('username') }}"
           class="form-control mb-3"
           placeholder="Username"
           style="border-radius:15px; background:#D9D9D9; border:none; height:45px;">

    {{-- Error Password --}}
    @error('password')
        <div class="alert alert-danger py-2">
            {{ $message }}
        </div>
    @enderror

    <input type="password"
           name="password"
           class="form-control mb-3"
           placeholder="Password"
           style="border-radius:15px; background:#D9D9D9; border:none; height:45px;">

    <div class="text-end">
        <button type="submit" class="login" style="justify-content:center; align-items:center; display:flex; margin:0 auto;">
            Log in
        </button>
    </div>

</form>

        </div>

        </div>

    </div>

</div>

</body>
</html>