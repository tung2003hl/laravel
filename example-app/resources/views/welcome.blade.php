@extends('layouts.app1') {{-- Sử dụng layout mặc định hoặc tùy chỉnh --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .product-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .product {
            width: 48%; /* Đặt chiều rộng để có 2 sản phẩm trên mỗi hàng */
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center; /* Căn giữa nội dung */
        }

        .product img {
            max-width: 70%; /* Đặt chiều rộng của hình ảnh là 70% */
            height: auto;
            display: block; /* Để canh giữa hình ảnh */
            margin: 0 auto; /* Canh giữa hình ảnh ngang dọc */
        }
    </style>
</head>
<body>
    <div class="product-list">
        <div class="product">
            <img src="{{ asset('storage/images/com-chien-ga-xoi-mo-thumbnail.jpg') }}" alt="Product 1">
            <h2>Tên Sản Phẩm 1</h2>
            <p>Giá tiền: $100</p>
        </div>

        <div class="product">
            <img src="{{ asset('storage/images/com-chien-ga-xoi-mo-thumbnail.jpg') }}" alt="Product 2">
            <h2>Tên Sản Phẩm 2</h2>
            <p>Giá tiền: $120</p>
        </div>

        <div class="product">
            <img src="{{ asset('storage/images/com-chien-ga-xoi-mo-thumbnail.jpg') }}" alt="Product 2">
            <h2>Tên Sản Phẩm 2</h2>
            <p>Giá tiền: $120</p>
        </div>

        <!-- Thêm sản phẩm khác nếu cần -->
    </div>
</body>
</html>
