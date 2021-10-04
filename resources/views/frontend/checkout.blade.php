@extends('layouts.front')

@section('title')
    Checkout
@endSection

@section('content')
    <div class="container mt-5">
        <form action="/place-order" method="POST">
        @csrf
            <div class="row">
                <div  class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6">
                                    <label for="fname">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control firstname" name="fname" id="fname" value="{{ Auth::user()->name }}" placeholder="Enter First Name">
                                    <span id="fname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="lname">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control lastname"  name="lname" id="lname" value="{{ Auth::user()->lname }}"  placeholder="Enter Last Name">
                                    <span id="lname_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control email" name="email" id ="email" value="{{ Auth::user()->email }}"   placeholder="Enter Email">
                                    <span id="email_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="phone">Phone Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control phone" name="phone" id="phone"  value="{{ Auth::user()->phone }}"   placeholder="Enter Phone Number">
                                    <span id="phone_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="address1">Address 1 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control address1" name="address1"  id="address1"  value="{{ Auth::user()->address1 }}"  placeholder="Enter Address 1">
                                    <span id="address1_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="address2">Address 2 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control address2" name="address2"  id="address2"  value="{{ Auth::user()->address2 }}"  placeholder="Enter Address 2">
                                    <span id="address2_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="city">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control city" name="city" id="city"  value="{{ Auth::user()->city }}"  placeholder="Enter City">
                                    <span id="city_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="state">State <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control state" name="state" id="state"  value="{{ Auth::user()->state }}"  placeholder="Enter State">
                                    <span id="state_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="country">Country <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control country" name="country" id="country"  value="{{ Auth::user()->country }}"   placeholder="Enter Country">
                                    <span id="country_error" class="text-danger"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="pincode">Pin Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control pincode" name="pincode" id="pincode"  value="{{ Auth::user()->pincode }}"  placeholder="Enter Pincode">
                                    <span id="pincode_error" class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>
                            @if($cartitems->count() > 0)
                                @php $total=0 @endphp
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartitems as $item)
                                            <tr>
                                                @php $total += ($item->products->selling_price * $item->prod_qty) @endphp
                                                <td>{{$item->products->name}}</td>
                                                <td>{{$item->prod_qty}}</td>
                                                <td>&#x20b9; {{$item->products->selling_price}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h6 class="px-2">Grand Total <span class="float-end">&#x20b9; {{$total}}</span></h6>
                                <hr>
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" class="btn btn-primary btn-block w-100 mb-2">Place Order | COD</button>
                                <button type="button" class="btn btn-success btn-block w-100 mb-2 razorpaybtn">Pay with Razorpay</button>
                                <div id="paypal-button-container"></div>
                            @else
                                <img src="{{asset('assets/images/emptycart.jpg')}}"  alt="Cart Image" height="310">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endSection

@section('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=AfWiPsi6YkbCwqb_oFdUyaXBUzEk0jssoYNft7Bu-Ihi_4p4L7rlSb9EuOVT3iZQGKa0NC0EHKhDQg6E"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
  paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: '{{$total}}'
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
       // alert('Transaction completed by ' + details.payer.name.given_name);

        var firstname = $('.firstname').val();
        var lastname = $('.lastname').val();
        var email = $('.email').val();
        var phone = $('.phone').val();
        var address1 = $('.address1').val();
        var address2 = $('.address2').val();
        var city = $('.city').val();
        var state = $('.state').val();
        var country = $('.country').val();
        var pincode = $('.pincode').val();

        $.ajax({
            method:"POST",
            url:"/place-order",
            data:{
                'fname':firstname,
                'lname':lastname,
                'email':email,
                'phone':phone,
                'address1':address1,
                'address2':address2,
                'city':city,
                'state':state,
                'country':country,
                'pincode':pincode,
                'payment_mode':"Paypal",
                'payment_id':details.id,
            },
            success:function(responce){
                swal(responce.status);
                window.location.href = "/my-orders";
            }
        });

      });
    }
  }).render('#paypal-button-container');
  //This function displays Smart Payment Buttons on your web page.
</script>

@endSection