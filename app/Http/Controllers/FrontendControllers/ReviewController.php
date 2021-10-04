<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function add($slug)
    {
        $product = Product::where('slug',$slug)->where('status','0')->first();
        if($product)
        {
            $product_id = $product->id;
            $review = Review::where('user_id',Auth::id())->where('prod_id',$product_id)->first();
            if($review)
            {
                return view('frontend.review.edit',compact('review'));
            }
            else
            {
                $verified_purchase = Order::where('orders.user_id',Auth::id())->join('order_items','orders.id','order_items.order_id')->where('order_items.prod_id',$product_id)->get();
                return view('frontend.review.index',compact('product','verified_purchase'));
            }
        }
        else{
            return redirect()->back()->with('status','Link was broken');
        }
    }

    public function create(Request $request){

        $product_id = $request->product_id;

        $product = Product::where('id',$product_id)->where('status','0')->first();
        if($product)
        {
            $user_review = $request->user_review;
            $review = Review::create([
                'user_id' => Auth::id(),
                'prod_id' => $product_id,
                'user_review' =>  $user_review,
            ]);

            $category_slug = $product->category->slug;
            $prod_slug = $product->slug;
            if($review)
            {
                return redirect('category/'.$category_slug.'/'.$prod_slug)->with('status','Thank you for writing a review');
            }
        }
        else{
            return redirect()->back()->with('status','Link was broken');
        }
    }

    public function edit($slug){

        $product = Product::where('slug',$slug)->where('status','0')->first();

        if($product)
        {
            $product_id = $product->id;
            $review  = Review::where('user_id',Auth::id())->where('prod_id',$product_id)->first();
            if($review)
            {
                return view('frontend.review.edit',compact('review'));
            }
            else
            {
                return redirect()->back()->with('status','Link was broken');
            }
        }
        else
        {
            return redirect()->back()->with('status','Link was broken');
        }
    }

    public function update(Request $request)
    {
        $user_review = $request->user_review;
        if($user_review != "")
        {
            $review_id = $request->review_id;
            $review = Review::where('id',$review_id)->where('user_id',Auth::id())->first();
            if($review)
            {
                $review->user_review = $request->user_review;
                $review->update();
                return redirect('category/'.$review->product->category->slug.'/'.$review->product->slug)->with('status','Review updated successfully');
            }
            else
            {
                return redirect()->back()->with('status','Link was broken');
            }
        }
        else{
            return redirect()->back()->with('status','You can not submit empty review');
        }
    }
}
