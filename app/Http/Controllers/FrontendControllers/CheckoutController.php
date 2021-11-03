<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Notifications\OrderNotification\OrderPlaceNotification;
use App\Notifications\OrderNotification\OrderPlaceDatabaseNotification;

class CheckoutController extends Controller
{
    public function index(){
        $old_cartitems = Cart::where('user_id',Auth::id())->get();
        
        foreach($old_cartitems as $item)
        {
            
            if(Product::where('id',$item->prod_id)->exists())
            {
                $product = Product::where('id',$item->prod_id)->first();
                if($item->prod_qty > $product->qty)
                {    
                    $removeitem = Cart::where('user_id',Auth::id())->where('prod_id',$item->prod_id)->first();
                    $removeitem->delete();
                }
            }
        }

        $cartitems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.checkout',compact('cartitems'));
    }

    public function placeorder(Request $request)
    {
        $total = 0;

        $order = new Order();
        $order->fname = $request->fname;
        $order->lname = $request->lname;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address1 = $request->address1;
        $order->address2 = $request->address2;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->country = $request->country;
        $order->pincode = $request->pincode;
        $order->tracking_no = 'bhat'.rand(1111,9999);
        $order->user_id = Auth::id();
        $order->payment_mode = $request->payment_mode;
        $order->payment_id = $request->payment_id;
        $order->save();

        $order->id;
        $cartitems = Cart::where('user_id',Auth::id())->get();

        foreach($cartitems as $item)
        {
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'qty' => $item->prod_qty,
                'price' => $item->products->selling_price,
            ]);

            $product = Product::where('id',$item->prod_id)->first();
            $product->qty = $product->qty - $item->prod_qty;
            $product->update();

            $total +=  $item->products->selling_price * $item->prod_qty;
        }

            $update_order = Order::where('id',$order->id)->first();
            $update_order->total_price = $total;
            $update_order->update();

        if(Auth::user()->address1 == NULL)
        {
            $user = User::where('id',Auth::id())->first();
            $user->name = $request->fname;
            $user->lname = $request->lname;
            $user->phone = $request->phone;
            $user->address1 = $request->address1;
            $user->address2 = $request->address2;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->pincode = $request->pincode;
            $user->update();
        }

        $cartitems = Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartitems);

        $user = User::where('id',Auth::id())->first();
        $order = Order::where('id',$order->id)->where('user_id',Auth::id())->first();
        $user->notify(new OrderPlaceNotification($user,$order));

        $useradmin = User::where('role_as','1')->first();
        $useradmin->notify(new OrderPlaceDatabaseNotification($order));

        if($request->payment_mode == 'Razorpay')
        {
            return response()->json(['status'=> "Order Placed Successfully"]);
        }
        else if($request->payment_mode == 'Paypal')
        {
            return response()->json(['status'=> "Order Placed Successfully"]);
        }
        else if($request->payment_mode == 'COD')
        {
            return redirect('/')->with('status','Order Placed Successfully');
        }
       
    }

    public function razorpaycheck(Request $request)
    {
        $cartitems = Cart::where('user_id',Auth::id())->get();
        $total_price = 0;
        foreach($cartitems as $item){
            $total_price += $item->products->selling_price * $item->prod_qty;
        }

        $firstname = $request->firstname;
        $lastname = $request->lastname;
        $email = $request->email;
        $phone = $request->phone;
        $address1 = $request->address1;
        $address2 = $request->address2;
        $city = $request->city;
        $state = $request->state;
        $country = $request->country;
        $pincode = $request->pincode;

        return response()->json([
                'firstname'=> $firstname,
                'lastname'=> $lastname,
                'email'=> $email,
                'phone'=> $phone,
                'address1'=> $address1,
                'address2'=> $address2,
                'city'=> $city,
                'state'=> $state,
                'country'=> $country,
                'pincode'=> $pincode,
                'total_price' => $total_price,
        ]);
    }
}
