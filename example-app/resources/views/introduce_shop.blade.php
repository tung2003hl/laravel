@extends('layouts.app1') {{-- Sử dụng layout mặc định hoặc tùy chỉnh --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css.css') }}">
    
</head>
<body>
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/images/'.$shop->logo) }}" alt="Logo" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h1>{{ $shop->name }}</h1>
            <p><strong>Địa chỉ:</strong> {{ $shop->address }}</p>
            <p><strong>Số điện thoại:</strong> {{ $shop->phone_num }}</p>
            <p><strong>Món chính:</strong> {{ $shop->main_food }}</p>
            <p><strong>Email:</strong> {{ $shop->email }}</p>
            <p>{{ $shop->shop_description }}</p>
            <div class="button-container">
                <a href="{{ route('create.food', ['shop_id' => $shop->id]) }}" class="button">Create Product</a>
            </div>
        </div>
    </div>
<br>
    <h2 class="text-center">Danh sách sản phẩm</h2>
    <br>
    <div class="product-list">
    @if(isset($foods))
        @foreach ($foods as $food)
            <div class="product">
                <div class="product-image">
                    <img src="{{ asset('storage/images/'.$food->image_url) }}" alt="{{$food->name}}">
                </div>
                <h2 class="product-name">{{$food->name}}</h2>
                <p class="product-price">{{$food->price}}</p>
            </div>
        @endforeach
    @endif
</div>
</div>
@endsection
</body>
</html>