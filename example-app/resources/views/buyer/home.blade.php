<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
@extends('layouts.app')

@section('content')
<section style="background-color: #eee;">
  <div class="text-center container py-5">
    <h4 class="mt-4 mb-5"><strong>Bestsellers</strong></h4>
    
    <div class="row">
    @foreach ($food as $food)
      <div class="col-lg-4 col-md-12 mb-4">
      
        <div class="card">
          <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
            data-mdb-ripple-color="light">
            <a href="{{ route('shop.detail', ['shop_id' => $food->shop_id]) }}">
            <img style="height:275px;width:275px" src="{{ asset('storage/images/'.$food->image_url) }}"
              class="w-100" />
            
              <div class="mask">
                <div class="d-flex justify-content-start align-items-end h-100">
                  <h5><span class="badge bg-primary ms-2">New</span></h5>
                </div>
              </div>
              <div class="hover-overlay">
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
            </a>
          </div>
          <div class="card-body">
            <a href="{{ route('shop.detail', ['shop_id' => $food->shop_id]) }}" class="text-reset">
              <h5 class="card-title mb-3">{{$shopName[$food->shop_id]}}-{{$food->name}}</h5>
            </a>
            <a href="" class="text-reset">
              <p>{{$food->category_name}}</p>
            </a>
            <h6 class="mb-3">${{$food->price}}</h6>
            
          </div>
        </div>
        
      </div>
      @endforeach
      
    </div>
    
  </div>
</section>
@endsection
</body>
</html>