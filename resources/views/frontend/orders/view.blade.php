@extends('layouts.front')

@section('title')
My Orders
@endSection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5> Order View
                            <a href="/my-orders" class="btn btn-info btn-sm float-end">Back</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order_details">
                                <h6>Shipping Details</h6>
                                <hr>
                                <label class="mb-1">First Name</label>
                                <div class="border mb-2">{{$orders->fname}}</div>
                                <label class="mb-1">Last Name</label>
                                <div class="border mb-2">{{$orders->lname}}</div>
                                <label class="mb-1">Email</label>
                                <div class="border mb-2">{{$orders->email}}</div>
                                <label class="mb-1">Contact Number</label>
                                <div class="border mb-2">{{$orders->phone}}</div>
                                <label class="mb-1">Shipping Address</label>
                                <div class="border mb-2">{{$orders->address1}},{{$orders->address2}},<br>
                                        {{$orders->city}},{{$orders->state}},{{$orders->country}}</div>
                                <label class="mb-1">Zipcode</label>
                                <div class="border mb-2">{{$orders->pincode}}</div>
                            </div>
                            <div class="col-md-6">
                            <h6>Order Details</h6>
                            <hr>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders->order_items as $item)
                                            <tr>
                                                <td>{{$item->products->name}}</td>
                                                <td>{{$item->qty}}</td>
                                                <td>&#x20b9; {{$item->price}}</td>
                                                <td>
                                                    <img src="{{asset('assets/uploads/product/'.$item->products->image)}}" height="70"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h6 class="px-2">Grand Total <span class="float-end">&#x20b9; {{$orders->total_price}}</span></h6>
                                <h6 class="px-2">Payment Mode <span class="float-end">{{$orders->payment_mode}}</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection