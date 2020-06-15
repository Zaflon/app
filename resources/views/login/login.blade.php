<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- Page tittle -->
    <title>Login</title>

    <!-- css dependency-->
    <link rel="stylesheet" href="css/login.css">

</head>

<body>
    <div id="container">
        <!-- attributes of this module -->
        <form style="display: hidden" id="data">
            <input type="hidden" name="controller" value="{{ $data->controller }}">
            <input type="hidden" name="date" value="{{ date('Y/m/d H:i:s') }}">
            <input type="hidden" name="url" value="{{ request()->fullUrl() }}">
            <input type="hidden" name="csrf" value="{{ csrf_token() }}">
        </form>

        <form action="{{ route('autenticate') }}" method="POST">
            @csrf
            <img src="img/logo.jpg" alt="Login Logo"><br>
            <input type="text" value="@AmJustSam" name="email" required><br>
            <input type="password" name="password" required><br>
            <input type="submit" value="SIGN IN"><br>

            <span>
                <a href="#" id="recover-password">
                    Forgot Password?
                </a>
            </span>

            <div id="social-network-link">
                <a href="https://pt-br.facebook.com">
                    <span>
                        <img src="img/Facebook_f_logo_(2019).svg" alt="Facebook Logo">
                    </span>
                </a>
                <a href="https://www.google.com">
                    <span>
                        <img src="img/Google_G_Logo.svg" alt="Google Logo">
                    </span>
                </a>
                <a href="https://www.instagram.com">
                    <span>
                        <img src="img/Instagram-Icon-logo-vector-01.svg" alt="Instagram Logo">
                    </span>
                </a>
            </div>
        </form>
    </div>
</body>

</html>