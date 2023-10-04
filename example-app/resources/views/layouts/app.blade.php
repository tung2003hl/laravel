<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>


<!-- Include Font Awesome CSS for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .btnnn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    margin-right: 10px;
    cursor: pointer;
}

/* Định dạng nút Log In */
.btn-login {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    margin-right: 10px;
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #007bff;
}

/* Định dạng nút Register */
.btn-register {
    background-color: #007bff;
}

/* Đưa nút vào góc trên cùng bên phải */
body {
    position: relative;
}

.btnnn   {
    position: absolute;
    top: 10px;
    right: 100px;
}
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Sauve Dinner
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @auth
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ url('/home') }}" style="font-size: 16px;">
                                    Home<span style="margin-right: 20px;"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('food.list')}}" style="font-size: 16px;">
                                    Food<span style="margin-right: 20px;"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('drink.list')}}" style="font-size: 16px;">
                                    Drink<span style="margin-right: 20px;"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('flower.list')}}" style="font-size: 16px;">
                                    Flower<span style="margin-right: 20px;"></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('market.list')}}" style="font-size: 16px;">
                                    Market<span style="margin-right: 20px;"></span>
                                </a>
                        </ul>
                    </div>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                    <a href="{{ route('login') }}" class="btn-login">{{ __('Login') }}</a>
                            @endif

                            @if (Route::has('register'))
                                    <a class="btnnn btn-register" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <div class="cart" style="margin-top:11px;margin-right:25px;padding:0px">

                                    <a href="{{route('show.cart')}}"><i class="fas fa-shopping-cart"></i></a>
                                    <span id="cart-count">0</span> - <span id="total-price">$0.00</span>
                            </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
