@extends('layouts.front')

@section('title')
My Orders
@endSection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        My Orders
                    </div>
                    <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tracking Number</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $item)
                                <tr>
                                    <td>{{$item->tracking_no}}</td>
                                    <td>&#x20b9; {{$item->total_price}}</td>
                                    <td>
                                        @if($item->status == 0 )
                                            <span class="badge bg-danger">Pending</span>
                                        @else
                                            <span class="badge bg-success">Delivered</span>
                                        @endif
                                    </td>
                                    <td><a href="/view-order/{{$item->id}}" class="btn btn-warning btn-sm">View <i class="fa fa-eye"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="float-end"> {{ $orders->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endSection