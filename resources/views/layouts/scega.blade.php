<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="apFu-TXM18aw2NfJhf8ddMD8CFF8hANn2Vr2kumMi2I" />



<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name', 'SCEGA COOP') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/scega_mpc_16x16.ico') }}" >
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/coop.css" rel="stylesheet">


    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body id="app-layout">
<nav class="na navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header col-md-8">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <div class="navbar-brand col-md-8">

                <a  href="{{ url('/') }}">
                    <div class="header-link-icon col-md-2">
                        <img src = "{{ asset('img/scega_mpc_32x32.ico') }}"/>
                    </div>
                    <div class="header-link col-md-6">
                        {{ config('app.name', 'SCEGA COOP') }}
                    </div>
                </a>
            </div>

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            <li><a href="{{ url('/changepassword') }}"><i class="fa fa-btn fa-sign-out"></i>Change Password</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
@include('footervarview')


<!-- JavaScripts -->
<script src="/js/app.js"></script>
<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<meta name="_token" content="{!! csrf_token() !!}" />
@yield('content')



</body>
<footer>
    @include('footer')
</footer>
</html>
