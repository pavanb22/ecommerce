@extends('layouts.admin')

@section('title')
Users
@endSection

@section('content')
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title">Registered Users</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm" id="user_table">
                <thead class="text-primary">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($users as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name.' '.$item->lname}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td>
                            <a href="/view-user/{{$item->id}}" class="btn btn-primary btn-sm"  style="font-size:14px;"><i class="material-icons">remove_red_eye</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endSection