@extends('layouts.front')

@section('title')
User Profile
@endSection

@section('content')
<div class="container mt-5">
    <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3 col-md-2" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <button class="nav-link {{$data['tab'] == 'profile' ? 'active':''}}" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-user me-2" aria-hidden="true"></i>My Profile</button>
            <button class="nav-link {{$data['tab'] == 'address' ? 'active':''}}" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa fa-address-book-o me-2" aria-hidden="true"></i>My Address Book</button>
        </div>
       
        <div class="tab-content col-md-10" id="v-pills-tabContent">
            <div class="tab-pane fade {{$data['tab'] == 'profile' ? 'show active':''}}" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <form action="/update-profile/{{Auth::user()->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div  class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6>My Details</h6>
                                    <hr>
                                    <div class="row checkout-form">
                                        <div class="col-md-6">
                                            <label for="fname">First Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control firstname" name="fname" id="fname" value="{{ Auth::user()->name }}" placeholder="Enter First Name">
                                            <span id="fname_error" class="text-danger">{{ $errors->first('fname') }}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lname">Last Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control lastname"  name="lname" id="lname" value="{{ Auth::user()->lname }}"  placeholder="Enter Last Name">
                                            <span id="lname_error" class="text-danger">{{ $errors->first('lname') }}</span>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control email" name="email" id ="email" value="{{ Auth::user()->email }}"   placeholder="Enter Email">
                                            <span id="email_error" class="text-danger">{{ $errors->first('email') }}</span>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control phone" name="phone" id="phone"  value="{{ Auth::user()->phone }}"   placeholder="Enter Phone Number">
                                            <span id="phone_error" class="text-danger">{{ $errors->first('phone') }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-3 text-center">
                                            <input type="submit" class="btn btn-primary btn-sm" value="Update Profile">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade {{$data['tab'] == 'address' ? 'show active':''}}" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                <form action="/update-address/{{Auth::user()->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div  class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h6>My Address</h6>
                                    <hr>
                                    <div class="row checkout-form">
                                        <div class="col-md-6 mt-3">
                                            <label for="address1">Address 1 <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control address1" name="address1"  id="address1"  value="{{ Auth::user()->address1 }}"  placeholder="Enter Address 1">
                                            <span id="address1_error" class="text-danger">{{ $errors->first('address1') }}</span>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="address2">Address 2 <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control address2" name="address2"  id="address2"  value="{{ Auth::user()->address2 }}"  placeholder="Enter Address 2">
                                            <span id="address2_error" class="text-danger">{{ $errors->first('address2') }}</span>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="city">City <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control city" name="city" id="city"  value="{{ Auth::user()->city }}"  placeholder="Enter City">
                                            <span id="city_error" class="text-danger">{{ $errors->first('city') }}</span>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="state">State <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control state" name="state" id="state"  value="{{ Auth::user()->state }}"  placeholder="Enter State">
                                            <span id="state_error" class="text-danger">{{ $errors->first('state') }}</span>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="country">Country <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control country" name="country" id="country"  value="{{ Auth::user()->country }}"   placeholder="Enter Country">
                                            <span id="country_error" class="text-danger">{{ $errors->first('country') }}</span>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="pincode">Pin Code <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control pincode" name="pincode" id="pincode"  value="{{ Auth::user()->pincode }}"  placeholder="Enter Pincode">
                                            <span id="pincode_error" class="text-danger">{{ $errors->first('pincode') }}</span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-3 text-center">
                                            <input type="submit" class="btn btn-primary btn-sm" value="Update Address">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endSection