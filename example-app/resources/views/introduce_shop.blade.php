@extends('layouts.app1') {{-- Sử dụng layout mặc định hoặc tùy chỉnh --}}
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/images/'.$shop->logo)  }}" alt="Logo" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h1>{{ $shop->name }}</h1>
                <p>{{ $shop->shop_description }}</p>
                <p><strong>Địa chỉ:</strong> {{ $shop->address }}</p>
                <p><strong>Số điện thoại:</strong> {{ $shop->phone_num }}</p>
                <p><strong>Món chính:</strong> {{ $shop->main_food }}</p>
                <p><strong>Email:</strong> {{ $shop->email }}</p>
            </div>
        </div>
    </div>

@endsection