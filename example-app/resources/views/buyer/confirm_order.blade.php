<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/confirm.order.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="container mt-5 mb-5">

        <div class="row d-flex justify-content-center">

            <div class="col-md-8">

                <div class="card">


                        <div class="text-left logo p-2 px-5">

                            <img src="https://i.imgur.com/2zDU056.png" width="50">
                            

                        </div>

                        <div class="invoice p-5">

                            <h5>Your order Confirmed!</h5>

                            <span class="font-weight-bold d-block mt-4">Hello,{{$user->name}}</span>
                            <span>You order has been confirmed and will be shipped in next few days!</span>

                            <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">

                                <table class="table table-borderless">
                                    
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Order Date</span>
                                                <span>{{$order->order_date}}</span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Order No</span>
                                                <span>{{$order->id}}</span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Payment</span>
                                                <span>COD</span>
                                                    
                                                </div>
                                            </td>

                                            <td>
                                                <div class="py-2">

                                                    <span class="d-block text-muted">Shiping Address</span>
                                                <span>{{$order->delivery_address}}</span>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>




                                
                            </div>




                                <div class="product border-bottom table-responsive">
                                    @foreach($orderDetails as $orderdetail)
                                    <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td width="20%">
                                            
                                            <img src="{{ asset('storage/images/'.$orderdetail->image) }}" width="90">

                                        </td>
                                    
                                        <td width="60%">
                                            <span class="font-weight-bold">{{$orderdetail->name}}</span>
                                            <div class="product-qty">
                                                <span class="d-block">Quantity:{{$orderdetail->quantity}}</span>
                                                
                                            </div>
                                        </td>
                                        <td width="20%">
                                            <div class="text-right">
                                                <span class="font-weight-bold">${{$orderdetail->price}}</span>
                                            </div>
                                        </td>
                                        </tr>

                                    </tbody> 
                                        
                                    </table>
                                    @endforeach


                                </div>



                                <div class="row d-flex justify-content-end">

                                    <div class="col-md-5">

                                        <table class="table table-borderless">

                                            <tbody class="totals">

                                                <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Subtotal</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span>{{$order->total_price}}</span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                 <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Shipping Fee</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span>$0</span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                 <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Tax Fee</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span>$0</span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                 <tr>
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="text-muted">Discount</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="text-success">{{$order->total_price}}</span>
                                                        </div>
                                                    </td>
                                                </tr>


                                                 <tr class="border-top border-bottom">
                                                    <td>
                                                        <div class="text-left">

                                                            <span class="font-weight-bold">Subtotal</span>
                                                            
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-right">
                                                            <span class="font-weight-bold">{{$order->total_price}}</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                            
                                        </table>
                                        
                                    </div>
                                    


                                </div>


                                <p>We will be sending shipping confirmation email when the item shipped successfully!</p>
                                <p class="font-weight-bold mb-0">Thanks for shopping with us!</p>
                                <span>Sauve Dinner Team</span>



                            

                        </div>


                        <div class="d-flex justify-content-between footer p-3">

                             <span>{{ now()->format('Y-m-d') }}</span>
                            
                        </div>



            
        </div>
                
            </div>
            
        </div>
        
    </div>
    @endsection
</body>
</html>