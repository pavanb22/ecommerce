<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));
    }

    public function add()
    {
        $category = Category::all();
        return view('admin.product.add',compact('category'));
    }

    public function insert(Request $request)
    {
        $products = new Product();
        
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/product',$filename);
            $products->image = $filename;
        }

        $products->cate_id = $request->cate_id;
        $products->name = $request->name;
        $products->slug = $request->slug;
        $products->small_description = $request->small_description;
        $products->description = $request->description;
        $products->original_price = $request->original_price;
        $products->selling_price = $request->selling_price;
        $products->qty = $request->qty;
        $products->tax = $request->tax;
        $products->status = $request->status == TRUE ? '1':'0';
        $products->trending = $request->trending == TRUE ? '1':'0';
        $products->meta_title = $request->meta_title;
        $products->meta_keywords = $request->meta_keywords;
        $products->meta_description = $request->meta_description;
        $products->save();
        return redirect('/products')->with('status','Product Added Successfully');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit',compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($request->hasFile('image'))
        {
            $path = "assets/uploads/product/".$product->image;

            if(File::exists($path))
            {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/product',$filename);
            $product->image = $filename;
        }

        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->small_description = $request->small_description;
        $product->description = $request->description;
        $product->original_price = $request->original_price;
        $product->selling_price = $request->selling_price;
        $product->qty = $request->qty;
        $product->tax = $request->tax;
        $product->status = $request->status == TRUE ? '1':'0';
        $product->trending = $request->trending == TRUE ? '1':'0';
        $product->meta_title = $request->meta_title;
        $product->meta_keywords = $request->meta_keywords;
        $product->meta_description = $request->meta_description;
        $product->save();
        return redirect('/products')->with('status','Product Updated Successfully');
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if($product->image)
        {
            $path = "assets/uploads/product/".$product->image;

            if(File::exists($path))
            {
                File::delete($path);
            }
        }
        $product->delete();
        return redirect('/products')->with('status','Product Deleted Successfully');
    }
}
