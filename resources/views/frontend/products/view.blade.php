@extends('layouts.front')

@section('title',$product->name)

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/add-rating" method="POST">
                @csrf
                    <input type="hidden" value="{{$product->id}}" name="prod_id"> 
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Rate {{$product->name}}</h5></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css">
                            <div class="star-icon">
                                @if($user_rating)
                                    @for($i=1; $i<= $user_rating->star_rated; $i++)
                                        <input type="radio" value="{{ $i }}" name="product_rating" checked id="rating{{$i}}">
                                        <label for="rating{{$i}}" class="fa fa-star"></label>
                                    @endfor
                                    @for($j = $user_rating->star_rated+1; $j<= 5; $j++)
                                        <input type="radio" value="{{ $j }}" name="product_rating" id="rating{{$j}}">
                                        <label for="rating{{$j}}" class="fa fa-star"></label>
                                    @endfor
                                @else
                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                    <label for="rating1" class="fa fa-star"></label>
                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                    <label for="rating2" class="fa fa-star"></label>
                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                    <label for="rating3" class="fa fa-star"></label>
                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                    <label for="rating4" class="fa fa-star"></label>
                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                    <label for="rating5" class="fa fa-star"></label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="py-3 shadow-sm bg-warning border-top mb-5">
        <div class="container">
            <h6 class="mb-0"> 
                <a href="/category">Collections</a> / 
                <a href="/view-category/{{$product->category->slug}}">{{$product->category->name}}</a> / 
                <a href="/category/{{$product->category->slug}}/{{$product->slug}}">{{$product->name}}</a>
            </h6>
        </div>
    </div>
   
    <div class="container product_data">
        <div class="row mb-2">
            <div class="col-md-4 border-right">
                <img src="{{ asset('assets/uploads/product/'.$product->image)}}" class="w-100" alt="">
            </div>
            <div class="col-md-8">
                <h2 class="mb-0">
                    {{$product->name}}
                    <label style="font-size: 16px;" class="float-end badge bg-danger trending_tag">{{$product->trending == '1' ? 'Trending' : ''}}</label>
                </h2>

                <hr>

                <label class="me-3">Original Price : <s>&#x20b9; {{$product->original_price}}</s></label>
                <label class="fw-bold">Selling Price : &#x20b9; {{$product->selling_price}}</label>

                <div class="rating">
                    @for($i=1; $i<= number_format($rating_value); $i++)
                    <i class="fa fa-star checked"></i>
                    @endfor

                    @for($j = number_format($rating_value)+1; $j<= 5; $j++)
                    <i class="fa fa-star"></i>
                    @endfor

                    <span class="mr-1">
                        @if($rating->count() > 0)
                            {{ $rating->count() }} Ratings
                        @else
                            No Ratings
                        @endif
                    </span> 
                </div>

                <p class="mt-3">
                    {!! $product->small_description !!}
                </p>
                <hr>

                @if($product->qty > 0)
                    <label class="badge bg-success">In stock</label>
                @else
                    <label class="badge bg-danger">Out of stock</label>
                @endif

                <div class="row mt-2">
                    <div class="col-md-2">
                        <input type="hidden" value="{{$product->id}}" class="prod_id">
                        <label for="quantity">Quantity</label>
                        <div class="input-group text-center mb-3">
                            <button class="input-group-text decrement-btn">-</button>
                            <input type="text" name="quantity" value="1" class="form-control text-center qty-input" />
                            <button class="input-group-text increment-btn">+</button>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <br/>
                        @if($product->qty > 0)
                            <button type="button" class="btn btn-primary me-3 addtocart float-start">Add to Cart <i class="fa fa-shopping-cart"></i></button>
                        @endif
                            <button type="button" class="btn btn-success me-3 addtowishlist float-start">Add to Wishlist <i class="fa fa-heart"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="row mt-2">
            <div class="col-md-12">
                <h4>Description</h4>
                <p class="mt-1">{!!$product->description!!}</p>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-8">
                @foreach($reviews as $item)
                    <label for="">{{ $item->users->name.' '.$item->users->lname }}</label>
                    @if($item->users->id == Auth::id())
                        <a href="/edit-review/{{ $product->slug }}/userreview"><i class="fa fa-pencil"></i></a>
                    @endif
                    <br/>

                    @php 
                        $rating = App\Models\Rating::where('prod_id',$product->id)->where('user_id',$item->users->id)->first();
                    @endphp

                    @if($rating)
                        @php $user_rated = $rating->star_rated @endphp
                        @for($i=1; $i<= $user_rated; $i++)
                            <i class="fa fa-star checked"></i>
                        @endfor
                        @for($j = $user_rated+1; $j<= 5; $j++)
                            <i class="fa fa-star"></i>
                        @endfor
                    @endif

                    <small>Reviewed on {{ $item->created_at->format('d M Y') }}</small>
                    <p>{{$item->user_review}}</p>
                @endforeach
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Rate this product
                </button>
                <a href="/add-review/{{$product->slug}}/userreview" class="btn btn-link">
                    Write a review
                </a>
            </div>
        </div>
    </div>
@endSection
