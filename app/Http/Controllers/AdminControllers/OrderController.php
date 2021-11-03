<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Invoice;
use App\Notifications\OrderNotification\OrderDeliverNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PDF;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::where('status','0')->orderBy('id', 'desc')->get();
        return view('admin.order.index',compact('orders'));
    }

    public function view($id,$notify_id=""){
        $orders = Order::where('id',$id)->first();
        Auth::user()->unreadNotifications->where('id',$notify_id)->markAsRead();
        return view('admin.order.view',compact('orders'));
    }

    public function updateorder(Request $request, $id)
    {
        $orders = Order::find($id);
        
        if($request->order_status == 1)
        {
            $last_row = DB::table('invoices')->orderBy('id', 'DESC')->first();
            $invoice_no = $last_row ? $last_row->id : '999';

            $data = [
                'order' => $orders,
                'date' => date('d F,Y',strtotime("now")),
                'invoice' => $invoice_no + 1,
            ];

            $pdf = PDF::loadView('admin.invoice.index', $data);
            $file_name = 'invoice'.time().'.pdf';
            Storage::put('public/admin/invoice/'.$file_name, $pdf->output());
            
            $new_invoice = Invoice::create([
                'user_id' => $orders->user_id,
                'order_id' =>  $orders->id,
                'file_name' => $file_name,
            ]);

            $user = User::find($orders->user_id);
            $user->notify(new OrderDeliverNotification($user,$orders));
            
        }

        $orders->status = $request->order_status;
        $orders->update();

        return redirect('/orders')->with('status','Order Updated successfully');
    }

    public function orderhistory(){
        $orders = Order::where('status','1')->get();
        return view('admin.order.history',compact('orders'));
    }
}
