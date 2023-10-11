<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/transaction_history.css') }}">
</head>
<body>
    @extends('layouts.app')
    @section('content')
    <div class="container-fluid my-5  d-flex  justify-content-center">
        <div class="card card-1">
            <div class="card-header bg-white">
                <div class="media flex-sm-row flex-column-reverse justify-content-between  ">
                    <div class="col my-auto"> <h4 class="mb-0">Thanks for your Order<span class="change-color"></span> !</h4> </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-between mb-3">
                    <div class="col-auto"> <h6 class="color-1 mb-0 change-color">Receipt</h6> </div>
                    <div class="col-auto  "> <small>Receipt Voucher : 1KAU9-84UIL</small> </div>
                </div>
                @foreach($orderDetail as $orderdetail)
                <div class="row">
                    <div class="col">
                        <div class="card card-2">
                            <div class="card-body">
                                <div class="media">
                                    <div class="sq align-self-center "> <img class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" src="{{ asset('storage/images/'.$orderdetail->image) }}" width="135" height="135" /> </div>
                                    <div class="media-body my-auto text-right">
                                        <div class="row  my-auto flex-column flex-md-row">
                                            <div class="col my-auto"> <h6 class="mb-0">{{$orderdetail->name}}</h6>  </div>
                                            <div class="col my-auto"> <small></small></div>
                                            <div class="col my-auto"> <small>Quantity : {{$orderdetail->quantity}}</small></div>
                                            <div class="col my-auto"><h6 class="mb-0">${{$orderdetail->price}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-3 ">
                                <div class="row">
                                    <div class="col-md-3 mb-3"> <small> Track Order <span><i class=" ml-2 fa fa-refresh"  aria-hidden="true"></i></span></small> </div>
                                    <div class="col mt-auto">
                                        <div class="progress my-auto"> <div class="progress-bar progress-bar  rounded" style="width: 62%" role="progressbar" aria-valuenow="25" aria-valuemin="0"  aria-valuemax="100"></div> </div>
                                        <div class="media row justify-content-between ">
                                            <div class="col-auto text-right"><span> <small  class="text-right mr-sm-2"></small> <i class="fa fa-circle active"></i> </span></div>
                                            <div class="flex-col"> <span> <small class="text-right mr-sm-2">Out for delivary</small><i class="fa fa-circle active"></i></span></div>
                                            <div class="col-auto flex-col-auto"><small  class="text-right mr-sm-2">Delivered</small><span> <i  class="fa fa-circle"></i></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="row mt-4">
                    <div class="col">
                        <div class="row justify-content-between">
                            <div class="col-auto"><p class="mb-1 text-dark"><b>Order Details</b></p></div><br><br>
                            <div class="flex-sm-col text-right col"> <p class="mb-1"><b>Total</b></p> </div>
                            <div class="flex-sm-col col-auto"> <p class="mb-1">${{$order->total_price}}</p> </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="flex-sm-col text-right col"><p class="mb-1"> <b>Discount</b></p> </div>
                            <div class="flex-sm-col col-auto"><p class="mb-1">$0</p></div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="flex-sm-col text-right col"><p class="mb-1"><b></b></p></div>
                            <div class="flex-sm-col col-auto"><p class="mb-1"></p></div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="flex-sm-col text-right col"><p class="mb-1"><b>Delivery Charges</b></p></div>
                            <div class="flex-sm-col col-auto"><p class="mb-1">Free</p></div>
                        </div>
                    </div>
                </div>
                <div class="row invoice ">
                    <div class="col"><p class="mb-1"> Order Number : {{$order->id}}</p><p class="mb-1">Order Date : {{$order->order_date}}</p><p class="mb-1"></p></div>
                </div>
            </div>
            <div class="card-footer">
                <div class="jumbotron-fluid">
                    <div class="row justify-content-between ">
                        <div class="col-auto my-auto "><h2 class="mb-0 font-weight-bold">TOTAL PAID</h2></div>
                        <div class="col-auto my-auto ml-auto"><h1 class="display-3 ">${{$order->total_price}}</h1></div>
                    </div>
                    <div class="row mb-3 mt-3 mt-md-0">
                        <div class="col-auto border-line"> <small class="text-white">PAN:AA02hDW7E</small></div>
                        <div class="col-auto border-line"> <small class="text-white">CIN:UMMC20PTC </small></div>
                        <div class="col-auto "><small class="text-white">GSTN:268FD07EXX </small> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
</body>
</html>