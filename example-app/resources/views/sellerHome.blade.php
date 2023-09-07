@extends('layouts.app1')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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
    left: 100px;
}

    </style>
</head>
<body>
  
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
  @endsection
  <div class="button-container">
  <a href="{{ route('create.shop') }}" class="button">Create Shop</a>
  </div>
    <!-- JavaScript để xử lý sự kiện khi nhấp vào nút Create Shop -->
       
</body>
</html>