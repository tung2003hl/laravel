@php
   use Carbon\Carbon;
@endphp
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
</head>
<body>
@section('content')
<!-- Modal -->
<form action="{{route('save.rating')}}" method="POST">
    @csrf
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Rating {{$shop->name}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="rating-css">
                <div class="star-icon">
                    <input type="hidden" value="{{$shop->id}}" name="shop_id">
                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                    <label for="rating1" class="fa fa-star"></label>
                    <input type="radio" value="2" name="product_rating" id="rating2">
                    <label for="rating2" class="fa fa-star"></label>
                    <input type="radio" value="3" name="product_rating" id="rating3">
                    <label for="rating3" class="fa fa-star"></label>
                    <input type="radio" value="4" name="product_rating" id="rating4">
                    <label for="rating4" class="fa fa-star"></label>
                    <input type="radio" value="5" name="product_rating" id="rating5">
                    <label for="rating5" class="fa fa-star"></label>
                </div>
            </div>
            <div class="form-group">
                <label for="comment">Nhận xét:</label>
                <textarea class="form-control" id="comment" name="comment" rows="4"></textarea>
            </div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</form>
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
            @php
                $ratenum = number_format($averageRating)
            @endphp
            <div class="rating">
                <span><strong>Rating:</strong></span>
                @for($i=1;$i <=$ratenum; $i++)
                <i class="fa fa-star checked"></i>
                @endfor
                @for($j = $ratenum+1; $j<=5;$j++)
                <i class="fa fa-star"></i>
                @endfor
                ({{$numberOfRatings}})
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Rate this shop
                </button>
            </div>
            <p>{{ $shop->shop_description }}</p>
            <div class="comment-box">
                <div class="comment-header">
                    <div class="comment-title">Comment</div>
                </div>
                @foreach($ratings as $ratings)
            @php
                $rate_num = number_format($ratings->rating)
            @endphp
            <hr>
                <div class="comment-content">
                    <div class="comment-info">
                        <div class="commenter-name">{{ $ratings->user->name }}</div>
                        @for($i=1;$i <=$rate_num; $i++)
                        <i class="fa fa-star checked"></i>
                        @endfor
                        @for($j = $rate_num+1; $j<=5;$j++)
                        <i class="fa fa-star"></i>
                        @endfor
                        <div class="comment-date">{{ Carbon::parse($ratings->created_at)->format('Y-m-d') }}</div>
                    </div>
                    {{ $ratings->comment }}
                </div>
                @endforeach
            </div>
            
            
        </div>
    </div>
    <br>
    <br>
    <h2 class="text-center">Food List</h2>
    <div class="product-list">
        @if(isset($foods))
            @foreach ($foods as $food)
                <div class="product">
                    <div class="product-image">
                        <img src="{{ asset('storage/images/'.$food->image_url) }}" alt="{{$food->name}}">
                    </div>
                    <h2 class="product-name">{{$food->name}}</h2>
                    <p class="product-price">{{ $food->price }} $</p>
                    <p><strong>Đã bán :{{$food->sold_count}}</strong></p>
                    
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
