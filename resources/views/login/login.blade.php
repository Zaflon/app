<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- Page tittle -->
    <title>{{ $view->action }}</title>

    <!-- js dependency-->
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>

    <!-- css dependency-->
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="{{URL::asset('css/app.css')}}">
</head>

<body>
    <div id="container">
        <!-- attributes of this module -->
        <form style="display: hidden" id="data">
            <input type="hidden" name="controller" value="{{ $view->controller }}">
            <input type="hidden" name="date" value="{{ date('Y/m/d H:i:s') }}">
            <input type="hidden" name="url" value="{{ request()->fullUrl() }}">
            <input type="hidden" name="csrf" value="{{ csrf_token() }}">
        </form>

        <form action="{{ route('autenticate') }}" method="POST">
            @csrf
            <img src="img/logo.jpg" alt="Login Logo"><br>
            <input type="email" name="email" title="Email" required><br>
            <input type="password" name="password" title="Password" required><br>
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
    @if($errors->any())
    <div class=container>
        <div class="alert alert-danger alert-dismissable text-center">
            <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close">×</a>
            <strong>{{ $errors->first() }}</strong>
        </div>
    </div>
    @endif
</body>

</html>