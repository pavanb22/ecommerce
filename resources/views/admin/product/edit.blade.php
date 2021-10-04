@extends('layouts.admin')

@section('title')
Edit {{$product->name}} Product
@endSection

@section('content')
    <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">Edit/Update {{$product->name}} Product
            <a href="/products" class="btn btn-info btn-sm float-right text-dark"  style="font-size:14px;"><i class="material-icons mr-1">arrow_back</i>Back</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="/edit-product/{{$product->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="cate_id">Category</label>
                        <select class="form-select">
                            <option value="">{{$product->category->name}}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$product->name}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" value="{{$product->slug}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="small_description">Small Description</label>
                        <textarea name="small_description" rows="3" class="form-control" id="small_description">{{$product->small_description}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description">Description</label>
                        <textarea name="description" rows="3" class="form-control" id="description">{{$product->description}}</textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="original_price">Original Price</label>
                        <input type="number" class="form-control" name="original_price" id="original_price" value="{{$product->original_price}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="selling_price">Selling Price</label>
                        <input type="number" class="form-control" name="selling_price" id="selling_price" value="{{$product->selling_price}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tax">Tax</label>
                        <input type="number" class="form-control" name="tax" id="tax" value="{{$product->tax}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" name="qty" id="qty" value="{{$product->qty}}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status">Status</label>
                        <input type="checkbox"  name="status" id="status" {{$product->status == "1" ? 'checked':''}}>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="trending">Trending</label>
                        <input type="checkbox"  name="trending" id="trending" {{$product->trending == "1" ? 'checked':''}}>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{$product->meta_title}}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_keywords">Meta Keywords</label>
                        <textarea name="meta_keywords" rows="3" class="form-control" id="meta_keywords">{{$product->meta_keywords}}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="meta_description">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="form-control" id="meta_description">{{$product->meta_description}}</textarea>
                    </div>
                    @if($product->image)
                        <img src="{{asset('assets/uploads/product/'. $product->image)}}" class ="pro-image mb-3" alt="Product Image">
                    @endif
                    <div class="col-md-12 mb-3">
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endSection