<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    @php
    $total = 0;
@endphp

<div class="container wrapper">
    <div class="row cart-head">
        <div class="container">
            <div class="row">
                <p></p>
            </div>
            <div class="row">
                <p></p>
            </div>
        </div>
    </div>    
    <div class="row cart-body">
        <form class="form-horizontal" method="POST" action="{{ route('place.order') }}">
            @csrf
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-push-6 col-sm-push-6">
                <!-- REVIEW ORDER -->
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Review Order 
                        <div class="pull-right"><small><a class="afix-1" href="{{ route('show.cart') }}">Edit Cart</a></small></div>
                    </div>
                    <div class="panel-body">
                        @foreach($cart as $cartItem)
                            @php
                                $total += $cartItem['price'] * $cartItem['quantity'];
                            @endphp
                            <div class="form-group">
                                <div class="col-sm-3 col-xs-3">
                                    <img class="img-responsive" src="{{ asset('storage/images/' . $cartItem['image']) }}" />
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="col-xs-12">{{ $cartItem['name'] }}</div>
                                    <div class="col-xs-12"><small>Quantity:<span>{{ $cartItem['quantity'] }}</span></small></div>
                                </div>
                                <div class="col-sm-3 col-xs-3 text-right">
                                    <h6><span>$</span>{{ number_format($cartItem['price'] * $cartItem['quantity']) }}</h6>
                                </div>
                            </div>
                        @endforeach
                        <div class="form-group"><hr /></div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <strong>Subtotal</strong>
                                <div class="pull-right"><span>$</span><span>{{ $total }}</span></div>
                            </div>
                            <div class="col-xs-12">
                                <small>Shipping</small>
                                <div class="pull-right"><span>-</span></div>
                            </div>
                        </div>
                        <div class="form-group"><hr /></div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <strong>Order Total</strong>
                                <div class="pull-right"><span>$</span><span name="total">{{ $total }}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- REVIEW ORDER END -->
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-md-pull-6 col-sm-pull-6">
                <!-- SHIPPING METHOD -->
                <div class="panel panel-info">
                    <div class="panel-heading">Address</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <h4>Shipping Address</h4>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Address:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="address" class="form-control" value="" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Name:</strong></div>
                            <div class="col-md-12"><input type="text" name="name" class="form-control" value="" required /></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Phone Number:</strong></div>
                            <div class="col-md-12"><input type="text" name="phone_number" class="form-control" value="" required /></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Email Address:</strong></div>
                            <div class="col-md-12"><input type="text" name="email_address" class="form-control" value="" required /></div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12"><strong>Notes:</strong></div>
                            <div class="col-md-12">
                                <input type="text" name="note">
                            </div>
                        </div>
                        <div class="form-group d-flex">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <button type="submit" class="btn btn-primary btn-submit-fix">Place Order</button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="{{ route('vnpay.payment') }}" class="btn btn-primary btn-submit-fix">Order With VNPAY</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SHIPPING METHOD END -->
                <!-- CREDIT CARD PAYMENT -->
                <!-- CREDIT CARD PAYMENT END -->
            </div>
        </form>
    </div>
    <div class="row cart-footer">
    </div>
</div>
</body>
</html>