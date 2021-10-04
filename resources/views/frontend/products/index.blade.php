@extends('layouts.front')

@section('title')
{{$category->name}}
@endSection

@section('content')
    <div class="py-3 shadow-sm bg-warning border-top mb-3">
        <div class="container">
            <h6 class="mb-0"> 
                <a href="/category">Collections</a> / 
                <a href="/view-category/{{$category->slug}}">{{$category->name}}</a>
            </h6>
        </div>
    </div>
    
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <h4>{{$category->name}}</h4>
                            @foreach($products as $item)
                                <div class="col-md-3 mb-3 mt-2">
                                    <a href="/category/{{$category->slug}}/{{$item->slug}}">
                                        <div class="card" >
                                            <img src="{{asset('assets/uploads/product/'.$item->image)}}" class="card-img-top" height="300" alt="Product Image">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$item->name}}</h5>
                                                <span class="float-start">&#x20b9; {{$item->selling_price}}</span>
                                                <span class="float-end"><s>&#x20b9; {{$item->original_price}}</s></span>
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