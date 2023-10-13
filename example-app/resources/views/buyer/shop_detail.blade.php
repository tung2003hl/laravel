@extends('layouts.app') {{-- Sử dụng layout mặc định hoặc tùy chỉnh --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img style="width:600px;height:500px" src="{{ asset('storage/images/'.$shop->logo) }}" alt="Logo" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h1>{{ $shop->name }}</h1>
            <p><strong>Main Food:</strong> {{ $shop->main_food }}</p>
            <p><strong>Location:</strong> {{ $shop->address }}</p>
            <p><strong>Contact:</strong> {{ $shop->email }}</p>
            <p><strong>Phone:</strong> {{ $shop->phone_num }}</p>
            <p>{{ $shop->shop_description }}</p>
        </div>
    </div>
    <br>
    <br>
    <<h2 class="text-center">Food List</h2>
    <div class="product-list">
        @if(isset($foods))
            @foreach ($foods as $food)
                <div class="product">
                    <div class="product-image">
                        <img src="{{ asset('storage/images/'.$food->image_url) }}" alt="{{$food->name}}">
                    </div>
                    <h2 class="product-name">{{$food->name}}</h2>
                    <p class="product-price">{{ $food->price }} $</p>
                    <a href="#" class="add-to-cart">
                        <i class="fas fa-heart text-danger fa-2x"></i>
                    </a>
                    
                    <a href="#" data-url="{{ route('addToCart', ['id' => $food->id]) }}" class="add-to-cart"><i class="fas fa-plus-circle text-danger fa-2x"></i></a>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function addToCart(event) {
        event.preventDefault();
        let urlCart = $(this).data('url');
        $.ajax({
            type: "GET",
            url: urlCart,
            dataType: 'json',
            success: function (data) {
                if (data.code === 200) {
                    alert('Adding success');
                }
            },
            error: function () {
                // Xử lý lỗi khi gửi yêu cầu AJAX
            }
        });
    }   

    
    $(function () {
        $('.add-to-cart').on('click', addToCart);
    });
</script>
</body>
</html>
