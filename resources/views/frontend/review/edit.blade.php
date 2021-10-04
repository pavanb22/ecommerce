@extends('layouts.front')

@section('title','Edit Review '.$review->product->name)

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5> Edit Review </h5>
                    </div>
                    <div class="card-body">
                        <h6>You are writing a review for {{ $review->product->name }}</h6>
                        <form action="/edit-review" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="review_id" value="{{ $review->id }}">
                            <textarea class="form-control" rows='5' name="user_review" placeholder = "Write a review">{{$review->user_review}}</textarea>
                            <div class="text-center">
                                   <button type="submit" class="btn btn-primary mt-3 float-center">Update Reviews</button>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection