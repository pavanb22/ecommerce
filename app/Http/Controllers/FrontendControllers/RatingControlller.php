<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class RatingControlller extends Controller
{
    public function addrating(Request $request){

        $star_rate = $request->product_rating;
        $product_id = $request->prod_id;

        $product_check = Product::where('id',$product_id)->where('status','0')->first();

        if($product_check)
        {
            $verified_purchase = Order::where('orders.user_id',Auth::id())->join('order_items','orders.id','order_items.order_id')->where('order_items.prod_id',$product_id)->get();

            if($verified_purchase->count() > 0)
            {
                if(Rating::where('user_id',Auth::id())->where('prod_id',$product_id)->exists())
                {
                    $rating = Rating::where('user_id',Auth::id())->where('prod_id',$product_id)->first();
                    $rating->star_rated = $star_rate;
                    $rating->update();
                }
                else{
                    Rating::create([
                        'user_id' => Auth::id(),
                        'prod_id' =>  $product_id,
                        'star_rated' => $star_rate,
                    ]);
                }
                return redirect()->back()->with('status','Thank you rating this product');
            }
            else{
                return redirect()->back()->with('status','You can not rate product without purchase');
            }
        }
        else{
            return redirect()->back()->with('status','Link was broken');
        }
    }
}
