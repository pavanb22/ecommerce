@extends('layouts.admin')

@section('title')
    Orders History
@endSection

@section('content')
<div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title"> Order History
            <a href="/orders" class="btn btn-info btn-sm float-right text-dark"  style="font-size:14px;"><i class="material-icons mr-1">playlist_add</i>New Orders</a>
            </h4>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm" id="order_history_table">
                <thead class="text-primary">
                    <tr>
                        <th>Order Date</th>
                        <th>Tracking Number</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $item)
                        <tr>
                            <td>{{date('d F,Y',strtotime($item->created_at)) }}</td>
                            <td>{{$item->tracking_no}}</td>
                            <td>&#x20b9; {{$item->total_price}}</td>
                            <td>
                                @if($item->status == 0 )
                                    <h4><span class="badge bg-danger text-white" style="font-size:14px;padding: 7px;">Pending</span></h4>
                                @else
                                    <h4><span class="badge bg-success text-white" style="font-size:14px;padding: 7px;">Delivered</span></h4>
                                @endif
                            </td>
                            <td><a href="admin/view-order/{{$item->id}}" class="btn btn-primary btn-sm"><i class="material-icons">remove_red_eye</i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>

@endSection