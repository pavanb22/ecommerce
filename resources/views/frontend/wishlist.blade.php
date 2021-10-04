@extends('layouts.front')

@section('title')
Wishlist
@endSection

@section('content')

    <div class="py-3 shadow-sm bg-warning border-top mb-5">
        <div class="container">
            <h6 class="mb-0"> 
                <a href="/">Home</a> / 
                <a href="/wishlist">Wishlist</a> 
            </h6>
        </div>
    </div>

    <div class="container my-5">
        @if($wishlist->count() > 0)
        <div class="row justify-content-center">
            <div class="col-lg-10">
            @foreach($wishlist as $item)
            <div class="row product_data product_data">
                <div class="col-md-2 text-center">
                    <img src="{{ asset('assets/uploads/product/'.$item->products->image)}}" alt="Image here" height="100">
                </div>
                <div class="col-md-2">
                    <h5 class="mt-4">{{ $item->products->name }}</h5>
                </div>
                <div class="col-md-2">
                    <h5 class="mt-4">&#x20b9; {{ $item->products->selling_price }}</h5>
                </div>
                <div class="col-md-2">
                    <input type="hidden" value="{{ $item->prod_id }}" class="prod_id">
                    @if($item->products->qty >= $item->prod_qty)
                        <label for="quantity">Quantity</label>
                        <div class="input-group text-center mb-3">
                            <button class="input-group-text decrement-btn">-</button>
                            <input type="text" name="quantity" value="1" class="form-control text-center qty-input" />
                            <button class="input-group-text increment-btn">+</button>
                        </div>
                    @else
                        <h4><span class="badge bg-warning text-dark mt-4">Out of Stock</span></h4>
                    @endif
                </div>
                <div class="col-md-2 text-center">
                    <br/>
                    <button type="button" class="btn btn-success addtocart"><i class="fa fa-shopping-cart mr-1"></i> Add to Cart</button>
                </div>
                <div class="col-md-2 text-center">
                    <br/>
                    <button type="button" class="btn btn-danger remove-wishlist-item"><i class="fa fa-trash mr-1"></i> Remove</button>
                </div>
            </div>
            <hr>
            @endforeach
           

            </div>
        </div>
        @else
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <img src="{{asset('assets/images/emptywishlist.jpg')}}" class="mb-5" alt="Cart Image" height="400">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3">
                    <a href="/category" class="btn btn-primary w-100">Shop Now</a>
            </div>
        </div>
        @endif
    </div>
@endSection