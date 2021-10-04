<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    public function index(){
        $wishlist = Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist',compact('wishlist'));
    }

    public function addwishlist(Request $request){
        if(Auth::check())
        {
            $product_id = $request->product_id;
            if(Product::find($product_id))
            {
                $wishlist = new Wishlist();
                $wishlist->prod_id = $product_id;
                $wishlist->user_id = Auth::id();
                $wishlist->save();
                return response()->json(['status'=> "Product added to wishlist"]);
            }
            else{
                return response()->json(['status'=> "Product dose not exists"]);
            }
        }
        else{
            return response()->json(['status'=> "Login to continue"]);
        }
    }

    public function deleteitem(Request $request){
        if(Auth::check())
        {
            $product_id = $request->product_id;
            if(Wishlist::where('prod_id',$product_id)->where('user_id',Auth::id())->exists())
            {
                $wishlistitem = Wishlist::where('prod_id',$product_id)->where('user_id',Auth::id())->first();
                $wishlistitem->delete();
                return response()->json(['status'=> "Item remove from wishlist"]);
            }
        }
        else{
            return response()->json(['status'=> "Login to continue"]);
        }
    }

    public function wishlistcount(){
        $wishlistcount = Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count'=> $wishlistcount]);
    }
}
