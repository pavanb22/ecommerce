<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use App\Models\Order;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];

        $order = [];
        foreach ($month as $key => $value) {
            $order[] = Order::where(\DB::raw("DATE_FORMAT(created_at, '%M')"),$value)->count();
        }

        $pending_order = Order::where('status','0')->count();
        $delivered_order = Order::where('status','1')->count();

    	return view('admin.index')->with('month',json_encode($month,JSON_NUMERIC_CHECK))->with('order',json_encode($order,JSON_NUMERIC_CHECK))->with('pending_count',json_encode($pending_order,JSON_NUMERIC_CHECK))->with('deliver_count',json_encode($delivered_order,JSON_NUMERIC_CHECK));
    }

    public function markallread()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
