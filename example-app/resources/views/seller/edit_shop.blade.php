@extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header text-center display-6">Edit Shop</div>            
                <div class="card-body">
                <form method="post" action="{{ route('update.shop', ['id' => $shop->id]) }}">
                    
    
                        @csrf
                        <div class="form-group">
                            <label for="shop_name">Shop Owner ID: </label>
                            <input type="text" name="owner_id" class="form-control" id="owner_id" value="{{$shop->owner_id}}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="shop_owner">Shop Name: </label>
                            <input type="text" name="name" class="form-control" id="name" value="{{$shop->name}}" required>
                        </div>

                        <div class="form-group">
                            <label for="shop_location">Shop Location: </label>
                            <input type="text" name="address" class="form-control" id="address" value="{{$shop->address}}" required>
                        </div>

                        <div class="form-group">
                            <label for="shop_phone">Shop Phone: </label>
                            <input type="text" name="phone_num" class="form-control" id="phone_num" value="{{$shop->phone_num}}" required>
                        </div>

                        <div class="form-group">
                            <label for="main_food">Main Food: </label>
                            <input type="text" name="main_food" class="form-control" id="main_food" value="{{$shop->main_food}}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Shop Email: </label>
                            <input type="text" name="email" class="form-control" id="email" value="{{$shop->email}}" required>
                        </div>
                        <br>
                            <div class="form-group">
                            <label for="shop_description">Shop Description: </label>
                            <input type="text" name="shop_description" class="form-control" id="shop_description" value="{{$shop->shop_description}}">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection