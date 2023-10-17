@extends('layouts.app')
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thank You for Your Order</title>
    <!-- Include Bootstrap CSS -->
    
</head>
<body style="background-color: #f2e0e0;">
    @section('content') 
    <div class="container" style="text-align: center;
    padding: 50px;">
        <div style="background-color: #fff; /* Card background color */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
            <h1 style="color: #ff5733;">Thank You for Your Order!</h1>
            <p style="font-size: 24px;
            color: #27ae60; /* Thank you text color */
            font-weight: bold;color: #2c3e50; ">We appreciate your support.</p>
            <p style="color: #2c3e50; ">Thank you for trusting and shopping with us. We hope you are satisfied with your purchase.</p>
            <a style="margin: 10px;" href="{{route('home')}}" class="btn btn-success">Continue Buying</a>
        </div>
    </div>
    @endsection
    <!-- Include Bootstrap JavaScript (for interactive features) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
