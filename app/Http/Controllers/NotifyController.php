<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifyController extends Controller
{
    //
    public function index(){
        $notifications = Notification::where('staff_id',Auth::guard('staff')->user()->id)->where('seen','!=',1)->get();
        return response()->json($notifications);
    }

    public function clear(){
        $notifications = Notification::where('staff_id',Auth::guard('staff')->user()->id)->get();
        foreach($notifications as $notify){
            $notify->seen = 1;
            $notify->save();
        }
        return response()->json(['msg' => 'thành công']);
    }
}
