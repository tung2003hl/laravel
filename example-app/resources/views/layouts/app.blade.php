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

@auth
@endauth
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
.product-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .product-item {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 10px;
        }
      .wishlist-iconn {
        right: 25%;
          position: relative;
          display: inline-block;
          font-size: 24px;
        }

        #wishlistCount {
          position: absolute;
          top: -10px;
          right: -10px;
          background-color: red;
          color: white;
          border-radius: 50%;
          padding: 2px 5px;
          font-size: 10px;
        }
        .wishlist-popup {
        display: none;
        position: absolute;
        top: 100%; /* Hiển thị dưới biểu tượng */
        left: 79%;
        background-color: white;
        border: 1px solid #ccc;
        padding: 10px;
        z-index: 1000;
        } /* Ẩn popup ban đầu */
        /* Thêm các kiểu CSS khác nếu cần */
        .product-list {
            background-color: #f4f4f4; /* Chọn màu sắc bạn muốn sử dụng */
            padding: 10px; /* Tăng khoảng cách giữa các phần tử trong product-list */
            border-radius: 8px; /* Bo tròn các góc của product-list */
        }

        .product-item {
            margin-bottom: 10px; /* Tăng khoảng cách giữa các product-item */
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-image img {
            width: 50px; /* Đặt kích thước hình ảnh theo ý muốn */
            height: 70px; /* Đảm bảo tỷ lệ khung hình không bị biến đổi */
            margin-right: 10px; /* Tăng khoảng cách giữa hình ảnh và thông tin sản phẩm */
        }

        .product-details {
            flex: 1; /* Mở rộng product-details để chiếm toàn bộ không gian còn lại */
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
                            <li class="nav-item {{ Request::is('home*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('/home') }}" style="font-size: 16px;">
                                    Home<span style="margin-right: 20px;"></span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('food*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('food.list') }}" style="font-size: 16px;">
                                    Food<span style="margin-right: 20px;"></span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('drink*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('drink.list')}}" style="font-size: 16px;">
                                    Drink<span style="margin-right: 20px;"></span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('flower*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('flower.list')}}" style="font-size: 16px;">
                                    Flower<span style="margin-right: 20px;"></span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('market*') ? 'active' : '' }}">
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
                            <div class="wishlist-iconn" id="wishlistIcon">&#x2665;<span id="wishlistCount">{{$wishlistcount}}</span></div>
                            <div class="wishlist-popup" id="wishlistPopup">
                            @if ($wishlistcount > 0)
                                <ul class="product-list">
                                    @foreach ($wishlistItems as $item)
                                    <li class="product-item" data-wishlist-id="{{ $item->wishlist_id }}">
                                        <div class="product-info">
                                            <div class="product-image">
                                                <img src="{{ asset('storage/images/'.$item->image_url) }}" alt="Product Image">
                                            </div>
                                            <div class="product-details">
                                                <h3>{{ $item->name }}</h3>
                                                <p>Price: ${{ $item->price }}</p>
                                                <div class="product-actions">
                                                    <a href="#" class="remove-from-wishlist">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                                </ul>
                            @endif
                            </div>
                            <div class="cart" style="margin-top:11px;margin-right:25px;padding:0px">

                                    <a href="{{route('show.cart')}}"><i class="fas fa-shopping-cart"></i></a>
                                    <span id="cart-count"></span>  <span id="total-price"></span>
                            </div>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                            
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('show.profile')}}">
                                        Profile
                                    </a>
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


            @yield('content')

    </div>
</body>
<script>
    $(document).ready(function () {
        var popupVisible = false;
        var wishlistCount = 0;

        $(".wishlist-iconn").on("click", function () {
            if (popupVisible) {
                $(".wishlist-popup").hide();
            } else {
                $(".wishlist-popup").show();
            }

            popupVisible = !popupVisible;
        });
        $(document).on("click", function (event) {
        var isInsideWishlistIcon = $(event.target).closest(".wishlist-iconn").length > 0;
        var isInsidePopup = $(event.target).closest(".wishlist-popup").length > 0;
        if (popupVisible && !isInsideWishlistIcon && !isInsidePopup) {
            $(".wishlist-popup").hide();
            popupVisible = false;
        }
    });

    });

    $(document).ready(function () {
    $(".remove-from-wishlist").on("click", function (event) {
        event.preventDefault();
        var wishlistId = $(this).closest(".product-item").data("wishlist-id");

        $.ajax({
            url: '/remove/' + wishlistId,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                // Xử lý phản hồi từ server nếu cần
                console.log(data);
                
                location.reload();
            },
            error: function (xhr, status, error) {  
                // Xử lý lỗi nếu có
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
</script>
<script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
</html>
