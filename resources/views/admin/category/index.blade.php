@extends('layouts.admin')

@section('title')
Categories
@endSection

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Categories
            <a href="/add-categories" class="btn btn-info btn-sm float-right text-dark"  style="font-size:14px;"><i class="material-icons mr-1">playlist_add</i>Add New Category</a>
        </h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm" id="category_table">
                <thead class="text-primary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($category as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                        <td><img src="{{ asset('assets/uploads/category/'.$item->image)}}" class="cate-image" alt="Image here"></td>
                        <td>
                            <a href="/edit-category/{{$item->id}}" class="btn btn-primary btn-sm mr-1" style="font-size:14px;"><i class="material-icons">mode_edit</i></a>
                            <a href="/delete-category/{{$item->id}}" class="btn btn-danger btn-sm mr-1" style="font-size:14px;"><i class="material-icons">delete</i></a>
                        </td>
                    </tr>
                    @endforeach   
                </tbody>
            </table>
        </div>
    </div>
</div>
@endSection