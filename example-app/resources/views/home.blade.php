<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
    <title>Centered Column Layout</title>
    <script>
        let cart = [];

// Hàm để thêm sản phẩm vào giỏ hàng
function addToCart(product) {
    cart.push(product);
    updateCart();
}

// Hàm để cập nhật giao diện giỏ hàng
function updateCart() {
    const cartList = document.getElementById('cart-list');
    cartList.innerHTML = '';

    cart.forEach(product => {
        const listItem = document.createElement('li');
        listItem.textContent = product.name;
        cartList.appendChild(listItem);
    });
}

// Bắt sự kiện khi người dùng nhấp vào biểu tượng "cart-plus"
const cartPlusButtons = document.querySelectorAll('.fa-cart-plus');
cartPlusButtons.forEach(button => {
    button.addEventListener('click', () => {
        const productName = button.getAttribute('data-product-name');
        const product = { name: productName };
        addToCart(product);
    });
});
    </script>
</head>
<body>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach ($food as $food)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-details">
                        <div class="product-img">
                            <div class="label-offer bg-red">Sale</div>
                            <div class="product-img">
                            <img src="{{ asset('storage/images/'.$food->image_url) }}" alt="...">
                            </div>
                            <div class="product-cart">
                                <a href="#!"><i class="fa-solid fa fa-eye"></i></a>
                                <a href="#!"><i class="fas fa-cart-plus"></i></a>
                                <a href="#!"><i class="fas fa-heart"></i></a>
                            </div>
                        </div>

                        <div class="product-info text-center">
                            <a href="#!">{{$food->name}}</a>
                            <p class="price text-center m-0">
                                <!-- <span class="red line-through me-2">$600</span> -->
                                <span>${{$food->price}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>    
@endsection
</body>
</html>
