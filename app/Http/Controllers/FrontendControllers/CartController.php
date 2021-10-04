<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function addproduct(Request $request)
    {
        $product_id = $request->product_id;
        $product_qty = $request->product_qty;

        if(Auth::check())
        {
            $prod_check = Product::where('id',$product_id)->first();

            if($prod_check)
            {
                if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    $cartitem = Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->first();
                    $cartitem->prod_id = $product_id;
                    $cartitem->user_id = Auth::id();
                    $cartitem->prod_qty = $product_qty;
                    $cartitem->update();
                    return response()->json(['status'=> $prod_check->name." Already added to cart"]);
                }
                else{
                    $cartitem = new cart();
                    $cartitem->prod_id = $product_id;
                    $cartitem->user_id = Auth::id();
                    $cartitem->prod_qty = $product_qty;
                    $cartitem->save();
                    return response()->json(['status'=> $prod_check->name." Added to cart"]);
                }
            }
        }
        else{
            return response()->json(['status'=> "Login to continue"]);
        }
    }

    public function viewcart()
    {
        $cartitems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.products.cart',compact('cartitems'));
    }

    public function deleteproduct(Request $request)
    {
        if(Auth::check())
        {
            $product_id = $request->product_id;
            if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists())
            {
                $cartitem = Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->first();
                $cartitem->delete();
                return response()->json(['status'=> "Product deleted successfully"]);
            }
        }
        else{
            return response()->json(['status'=> "Login to continue"]);
        }
    }

    public function updatecart(Request $request)
    {
        $product_id = $request->product_id;
        $product_qty = $request->product_qty;
        if(Auth::check())
        {
            if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists())
            {
                $cart = Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status'=> "Quantity Updated"]);
            }
        }
        else{
            return response()->json(['status'=> "Login to continue"]);
        }
    }

    public function cartcount(){
        $cartcount = Cart::where('user_id',Auth::id())->count();
        return response()->json(['count'=> $cartcount]);
    }
}
