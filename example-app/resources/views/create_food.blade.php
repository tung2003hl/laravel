@extends('layouts.app1')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#price').on('input', function() {
            // Loại bỏ tất cả dấu phân cách hiện có
            var input = $(this).val().replace(/,/g, '');

            // Sử dụng regex để thêm dấu phân cách sau mỗi 3 số
            input = input.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // Cập nhật giá trị trong input
            $(this).val(input);
        });
    });
</script>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header text-center display-6">Create Product</div>            
                <div class="card-body">
                    <form method="POST" action="{{ route('store.food') }}" enctype="multipart/form-data" >
                    
    
                        @csrf
                        <div class="form-group">
                            <label for="shop_name">Shop ID: </label>
                            <input type="text" name="shop_id" class="form-control" value="{{ $shop_id }}" readonly>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="shop_owner">Product Name: </label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>

                        <div class="form-group">
                        <label for="category">Category:</label>
                        <select name="category_id" id="category" class="form-control">
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                        </select>
                            </div>
                        <br>
                        <div class="form-group">
                            <label for="shop_location">Product Price: </label>
                            <input type="text" name="price" class="form-control" id="price" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="shop_phone">Product Image: </label>
                            <input type="file" name="image_url" class="form-control" >
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="shop_description">Food Description: </label>
                            <input type="text" name="description" class="form-control" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection