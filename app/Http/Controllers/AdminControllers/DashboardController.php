<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function users(){
        $users = User::all();
        return view('admin.user.index',compact('users'));
    }

    public function viewuser($id){
        $users = User::find($id);
        return view('admin.user.view',compact('users'));
    }
}
