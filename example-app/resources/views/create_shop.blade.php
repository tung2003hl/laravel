@extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header text-center display-6">Create Shop</div>            
                <div class="card-body">
                    <form method="post" action="store-shop" enctype="multipart/form-data" >
                    
    
                        @csrf
                        <div class="form-group">
                            <label for="shop_name">Shop Owner ID: </label>
                            <input type="text" name="owner_id" class="form-control" id="owner_id" value="{{$userId}}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="shop_owner">Shop Name: </label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>

                        <div class="form-group">
                            <label for="shop_location">Shop Location: </label>
                            <input type="text" name="address" class="form-control" id="address" required>
                        </div>

                        <div class="form-group">
                            <label for="shop_phone">Shop Phone: </label>
                            <input type="text" name="phone_num" class="form-control" id="phone_num" >
                        </div>

                        <div class="form-group">
                            <label for="main_food">Main Food: </label>
                            <input type="text" name="main_food" class="form-control" id="main_food" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Shop Email: </label>
                            <input type="text" name="email" class="form-control" id="email  " required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="shop_logo">Shop Logo: </label>
                            <input type="file" name="logo" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="shop_description">Shop Description: </label>
                            <input type="text" name="shop_description" class="form-control" id="shop_description" required>
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection