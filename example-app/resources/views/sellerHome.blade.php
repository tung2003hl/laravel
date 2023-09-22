
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-Zy8Blm5ST6inBdvy5iH+2w6tSmwTcxhg1KwpbuR5AhlkP6Sm9z/+so4p9ylx1+zR" crossorigin="anonymous">
    <!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Font Awesome 5 CSS -->
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.2/css/all.css'>
<!-- Products List CSS -->
<link rel="stylesheet" href="css/style.css">

    <style>
        /* CSS để định dạng nút Create Shop */
        .button {
    display: block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 4px;
}
.button-container {
    position: fixed;
    top: 100px;
    left: 130px;
}
.shop-list {
            list-style: none;
            padding: 0;
            color:#000;
        }

        .shop-list-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color:#000;
        }

        .shop-list-item img {
            width: 50px; /* Điều chỉnh kích thước ảnh logo */
            height: 50px;
            margin-right: 10px;
            color:#000;
        }
        .shop-link {
    text-decoration: none; /* Loại bỏ gạch chân */
    color: #000; /* Màu đen cho văn bản */
}
.delete-button {
    color: #d9534f; /* Màu đỏ hoặc màu khác tùy bạn chọn */
    text-decoration: none;
    margin-left: 10px; /* Để tạo khoảng cách giữa nút "Delete" và cửa hàng */
}

    </style>
</head>
<body>
  
@extends('layouts.app1')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
    
                    <div class="card-body">
                        You are a Seller.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="button-container">
        <a href="{{ route('create.shop') }}" class="button">Create Shop</a>
    </div>

    <!-- Danh sách cửa hàng của bạn -->
    <div class="container">
        <h2>Shop List</h2>
        <ul class="shop-list">
            <!-- Duyệt danh sách cửa hàng của bạn và hiển thị từng cửa hàng -->
            @foreach ($shop as $shop)
    <a href="{{ route('introduce.shop', ['id' => $shop->id]) }}" class="shop-link">
        <li class="shop-list-item">
            <img src="{{ asset('storage/images/'.$shop->logo) }}" alt="Logo">
            <span>{{ $shop->name }}</span>
            <a href="{{ route('delete.shop', ['id' => $shop->id]) }}" class="delete-button">Delete</a>
        </li>
    </a>
@endforeach
        </ul>
    </div>
@endsection

</body>
</html>