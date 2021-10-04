@extends('layouts.admin')

@section('title')
Products
@endSection

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Products
        <a href="/add-products" class="btn btn-info btn-sm float-right text-dark"  style="font-size:14px;"><i class="material-icons mr-1">playlist_add</i>Add New Product</a>
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm" id="product_table">
                <thead class="text-primary">
                    <th>Id</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Selling Price</th>
                    <th>Image</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($products as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->category->name}}</td>
                        <td>{{$item->name}}</td>
                        <td>&#x20b9; {{$item->selling_price}}</td>
                        <td><img src="{{ asset('assets/uploads/product/'.$item->image)}}" class="pro-image" alt="Image here"></td>
                        <td>
                            <a href="/edit-product/{{$item->id}}" class="btn btn-primary btn-sm mr-1" style="font-size:14px;"><i class="material-icons">mode_edit</i></a>
                            <a href="/delete-product/{{$item->id}}" class="btn btn-danger btn-sm mr-1" style="font-size:14px;"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endSection