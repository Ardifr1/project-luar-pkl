<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #222;
            font-family: Arial, sans-serif;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .phone {
            width: 412px;
            min-height: 120vh;
            background: white;

            padding: 70px 45px 40px;

            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo {
            width: 80px;
            height: 80px;
            
            object-fit: contain;

            margin-bottom: 100px;
        }

        .form-login {
            width: 100%;
        }

        .form-group {
            width: 100%;
            margin-bottom: 8px;
        }

        .form-group label {
            display: block;

            font-size: 13px;
            color: #222;

            margin-left: 10px;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            height: 42px;

            border: none;
            outline: none;

            background: #d9d9d9;

            border-radius: 14px;

            padding: 0 15px;

            font-size: 14px;
        }

        .form-group input:focus {
            background: #d0d0d0;
        }

        .btn-login {
    display: block;

    width: 150px;
    height: 42px;

    margin: 25px auto 0;

    border: none;
    border-radius: 13px;

    background: #d9d9d9;

    color: #222;

    font-size: 13px;

    cursor: pointer;

    -webkit-appearance: none;
    appearance: none;

    -webkit-tap-highlight-color: transparent;

    touch-action: manipulation;
}

        .btn-login:hover {
            background: #cfcfcf;
        }

        .forgot {
            margin-top: 38px;

            text-align: center;

            font-size: 12px;

            color: #222;

            text-decoration: none;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        @media (max-width: 400px) {
            .phone {
                width: 100%;
                padding-left: 45px;
                padding-right: 45px;
            }
        }
    </style>
</head>

<body>

    <div class="phone">

        <!-- LOGO -->
        <img
            src="{{ asset('gambar/logo mp png.png') }}"
            alt="Logo"
            class="logo"
        >

        @if ($errors->any())
    <div style="
        width: 100%;
        margin-bottom: 15px;
        padding: 10px;
        background: #f8d7da;
        color: #842029;
        border-radius: 10px;
        font-size: 12px;
        text-align: center;
    ">
        {{ $errors->first() }}
    </div>
@endif

        <!-- FORM LOGIN -->
        <form
            action="{{ route('login.submit') }}"
            method="POST"
            class="form-login"
        >

            @csrf

            <!-- NIP / USERNAME -->
            <div class="form-group">


                <input
                    type="text"
                    id="login"
                    name="login"
                    autocomplete="username"
                    required
                    placeholder="NIP / Username"
                >

            </div>

            <!-- PASSWORD -->
            <div class="form-group">

                <input
                placeholder="Password"
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    required
                >

            </div>

            <!-- LOGIN -->
            <input
    type="submit"
    value="Login"
    class="btn-login"
>


        </form>

        <!-- LUPA PASSWORD -->
        <a href="#" class="forgot">
            Lupa password? hubungi admin
        </a>

    </div>

</body>
</html>