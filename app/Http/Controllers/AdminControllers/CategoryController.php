<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('admin.category.index',compact('category'));
    }

    public function add()
    {
        return view('admin.category.add');
    }

    public function insert(Request $request){
        $category = new Category();

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category',$filename);
            $category->image = $filename;
        }

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->status = $request->status == TRUE ? '1':'0';
        $category->popular = $request->popular == TRUE ? '1':'0';
        $category->meta_title = $request->meta_title;
        $category->meta_descrip = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();
        return redirect('/dashboard')->with('status','Category Added Successfully');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    public function update(Request $request,$id)
    {
        $category = Category::find($id);
        if($request->hasFile('image'))
        {
            $path = "assets/uploads/category/".$category->image;

            if(File::exists($path))
            {
                File::delete($path);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category',$filename);
            $category->image = $filename;
        }

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->description = $request->description;
        $category->status = $request->status == TRUE ? '1':'0';
        $category->popular = $request->popular == TRUE ? '1':'0';
        $category->meta_title = $request->meta_title;
        $category->meta_descrip = $request->meta_description;
        $category->meta_keywords = $request->meta_keywords;
        $category->save();
        return redirect('/dashboard')->with('status','Category Updated Successfully');
    }

    public function delete($id)
    {
        $category = Category::find($id);

        if($category->image)
        {
            $path = "assets/uploads/category/".$category->image;

            if(File::exists($path))
            {
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('/categories')->with('status','Category Deleted Successfully');
    }
}
