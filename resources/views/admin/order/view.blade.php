@extends('layouts.admin')

@section('title')
    Order Details
@endSection

@section('content')
<div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">Orders
                <a href="/orders" class="btn btn-info btn-sm float-right text-dark"  style="font-size:14px;"><i class="material-icons mr-1">arrow_back</i>Back</a>
            </h4>
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
                            <div class="col-md-6 order_details">
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
                                <h4 class="px-2 font-weight-bold mb-3">Grand Total <span class="float-right">&#x20b9; {{$orders->total_price}}</span></h4>
                                <label for="order_status">Order Status</label>
                                <form action="/update-order/{{$orders->id}}" method="POST">
                                @csrf
                                @method('PUT')
                                    <select class="form-select mb-2" name="order_status" id="order_status">
                                        <option value="0" {{$orders->status == '0' ? 'selected':''}}>Pending</option>
                                        <option value="1" {{$orders->status == '1' ? 'selected':''}}>Delivered</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm mt-2 float-right" style="font-size:14px;"><i class="material-icons mr-1">mode_edit</i>Update</button>
                                </form>
                            </div>
                        </div>
</div>
@endSection