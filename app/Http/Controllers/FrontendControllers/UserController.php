<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(){
        $orders = Order::where('user_id',Auth::id())->paginate(7);
        return view('frontend.orders.index',compact('orders'));
    }

    public function view($id,$notify_id = "")
    {
        $orders = Order::where('id',$id)->where('user_id',Auth::id())->first();
        $invoice = Invoice::where('order_id',$orders->id)->where('user_id',Auth::id())->first();        
        Auth::user()->unreadNotifications->where('id',$notify_id)->markAsRead();
        return view('frontend.orders.view',compact('orders','invoice'));
    }

    public function profile()
    {
        $data['tab'] = 'profile';
        return view('frontend.profile',compact('data'));
    }

    public function updateprofile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required|alpha',
            'lname' => 'required|alpha',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:10',
        ],[
            'fname.required' => 'First Name is required',
            'lname.required' => 'Last Name is required',
            'email.required' => 'Email is required',
            'phone.required' => 'Phone number is required'
        ]);

        if (!$validator->fails())
        {
            $user = User::where('id',$id)->first();
            $user->name = $request->fname;
            $user->lname = $request->lname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->update();
            return redirect('/profile')->with('status','Profile Updated successfully');
        }
        else{
            $errors = $validator->errors();
            $data['tab'] = 'profile';
            return view('frontend.profile',compact('errors','data'));
        }
    }

    public function updateaddress(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'address1' => 'required',
            'address2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required',
        ],[
            'address1.required' => 'Shipping Address is required',
            'address2.required' => 'Shipping Address is required',
            'city.required' => 'City is required',
            'state.required' => 'State is required',
            'country.required' => 'Country Address is required',
            'pincode.required' => 'Pincode is required',
        ]);

        if (!$validator->fails())
        {
            $user = User::where('id',$id)->first();
            $user->address1 = $request->address1;
            $user->address2 = $request->address2;
            $user->city = $request->city;
            $user->state = $request->state;
            $user->country = $request->country;
            $user->pincode = $request->pincode;
            $user->update();
            return redirect('/profile')->with('status','Address Updated successfully');
        }
        else{
            $errors = $validator->errors();
            $data['tab'] = 'address';
            return view('frontend.profile',compact('errors','data'));
        }
    }

    public function download($file_name)
    {
        $file = Storage::disk('public')->get($file_name);
  
        return (new Response($file, 200))
              ->header('Content-Type', 'application/pdf');
    }
}
