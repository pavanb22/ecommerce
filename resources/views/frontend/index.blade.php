@extends('layouts.front')

@section('title')
    Welcome to E-Com
@endSection

@section('content')
   @include('layouts.inc.slider')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h3>Featured Products</h3>
                <div class="owl-carousel featured-carousel owl-theme mt-2">
                    @foreach($featured_products as $item)
                    <div class="item">
                        <div class="card" >
                            <img src="{{asset('assets/uploads/product/'.$item->image)}}" class="card-img-top" height="300" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->name}}</h5>
                                <span class="float-start">&#x20b9; {{$item->selling_price}}</span>
                                <span class="float-end"><s>&#x20b9; {{$item->original_price}}</s></span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <h3>Trending Categories</h3>
                <div class="owl-carousel featured-carousel owl-theme mt-2">
                    @foreach($trending_category as $item)
                    <div class="item">
                        <a href="/view-category/{{$item->slug}}">
                            <div class="card" >
                                <img src="{{asset('assets/uploads/category/'.$item->image)}}" class="card-img-top" height="200" alt="Category Image">
                                <div class="card-body">
                                    <h5 class="card-title">{{$item->name}}</h5>
                                    <p>{{$item->description}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endSection

