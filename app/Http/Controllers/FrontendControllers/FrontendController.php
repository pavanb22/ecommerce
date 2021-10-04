<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index(){
        $featured_products = Product::where('trending','1')->take(15)->get();
        $trending_category = Category::where('popular','1')->take(15)->get();
        return view('frontend.index',compact('featured_products','trending_category'));
    }

    public function category()
    {
        $category = Category::where('status','0')->get();
        return view('frontend.category',compact('category'));
    }

    public function viewcategory($slug)
    {
        if(Category::where('slug',$slug)->exists())
        {
            $category = Category::where('slug',$slug)->first();
            $products = Product::where('cate_id',$category->id)->where('status','0')->get();
            return view('frontend.products.index',compact('category','products'));
        }
        else{
            return redirect('/')->with('status',"Slug does not exists");
        }
    }

    public function viewproduct($cate_slug,$pro_slug)
    {
        if(Category::where('slug',$cate_slug)->exists())
        {
            if(Product::where('slug',$pro_slug)->exists())
            {
                $product = Product::where('slug',$pro_slug)->first();
                $rating = Rating::where('prod_id',$product->id)->get();
                $rating_sum = Rating::where('prod_id',$product->id)->sum('star_rated');
                $user_rating = Rating::where('prod_id',$product->id)->where('user_id',Auth::id())->first();
                $reviews = Review::where('prod_id',$product->id)->get();
                if($rating->count() > 0)
                {
                    $rating_value = $rating_sum / $rating->count();
                }
                else{
                    $rating_value = 0;
                }
                
                return view('frontend.products.view',compact('product','rating','rating_value','user_rating','reviews'));
            }
            else{
                return redirect('/')->with('status',"Slug does not exists");
            }
        }
        else{
            return redirect('/')->with('status',"Slug does not exists");
        }
    }
}
