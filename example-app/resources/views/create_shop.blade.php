@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header text-center display-6">Create Shop</div>
            @if(Session::get('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif

            @if(Session::get('fail'))
            <div class="alert alert-danger">
                {{Session::get('fail')}}
            </div>
            @endif
                <div class="card-body">
                    <form method="post" action="store-shop" >
                        @csrf
                        <div class="form-group">
                            <label for="shop_name">Shop Owner: </label>
                            <input type="text" name="owner_id" class="form-control" id="owner_id" required>
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
                        <br>
                        <div class="form-group">
                            <label for="shop_logo">Shop Logo: </label>
                            <input type="file" name="logo" class="form-control-file" id="logo" >
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection