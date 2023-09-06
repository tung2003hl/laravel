

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        /* CSS để định dạng nút Create Shop */
        #createShopButton {
            position: fixed;
            left: 100px;
            top: 100px;
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

    </style>
</head>
<body>
@extends('layouts.app')
  
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
  <a href="{{ route('create.shop') }}" class="btn btn-primary">Create Shop</a>

    <!-- JavaScript để xử lý sự kiện khi nhấp vào nút Create Shop -->
       
</body>
</html>