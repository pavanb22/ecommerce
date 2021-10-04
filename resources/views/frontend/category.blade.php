@extends('layouts.front')

@section('title')
    Categories
@endSection

@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <h4>All Categories</h4>
                        @foreach($category as $item)
                            <div class="col-md-3 mb-3 mt-2">
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
    </div>
@endSection