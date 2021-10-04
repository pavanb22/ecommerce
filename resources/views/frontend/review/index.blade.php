@extends('layouts.front')

@section('title','Review '.$product->name)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5> Add Review </h5>
                    </div>
                    <div class="card-body">
                        @if($verified_purchase->count() > 0)
                            <h6>You are writing a review for {{ $product->name }}</h6>
                            <form action="/add-review" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <textarea class="form-control" rows='5' name="user_review" placeholder = "Write a review"></textarea>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-3 float-center">Submit Reviews</button>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-danger">
                                <h5>You are not eligible to reviews this product</h5>
                                <p>
                                    For the trustworthiness of the reviews, only customers who purchased
                                    the product can write a review about the product.
                                </p>
                                <div class="text-center">
                                    <a href="/" class="btn btn-primary mt-3 float-center">Home</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection