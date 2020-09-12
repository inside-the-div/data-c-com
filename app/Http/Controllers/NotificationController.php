<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
class NotificationController extends Controller
{
    public function order(){
    	$orders = Order::where('seen','=',0)->orderBy('id','DESC')->get();

    	$total_notification = $orders->count();

    	return response()->json([
    		'orders' => $orders,
    		'total_notification' => $total_notification
    	]);
    }
}
