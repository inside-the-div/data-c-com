<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Carbon\Carbon;
class ReportController extends Controller
{
    public function index(){
    	


    	$start  = Carbon::today();
    	$end    = Carbon::today();
    	$orders = Order::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();




    	return view('admin.report.index',compact('orders'));
    }   

    public function orders(Request $r){
    	

    	Carbon::setWeekStartsAt(Carbon::SATURDAY);
    	Carbon::setWeekEndsAt(Carbon::FRIDAY);

    	$type = $r->type;
    	



    	if($type == 'this-week'){
    			
    		$week_start = Carbon::now()->startOfWeek();
    		$week_end   = Carbon::now()->endOfWeek();

    		$orders = Order::whereBetween('created_at', [$week_start,$week_end])->get();

    	}else if($type =='last-week'){

    	
    		$last_week_start = Carbon::today()->subWeek()->addDays(-7);
    		$last_week_end   = Carbon::today()->subWeek();

    		$orders = Order::whereBetween('created_at', [$last_week_start,$last_week_end])->get();


    	}else if($type =='today'){

    		$start  = Carbon::today();
    		$end    = Carbon::today();
    		$orders = Order::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();

    	}else if($type == 'yesterday'){
    		
    		$start = Carbon::yesterday();
    		$end   = Carbon::yesterday();
    		$orders = Order::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();


    	}else if($type == 'this-month'){

    		$this_month = Carbon::now()->format('m');
    		$this_year  = Carbon::now()->format('Y');

    		$orders = Order::whereMonth('created_at',$this_month)->whereYear('created_at',$this_year)->get();


    	}else if($type == 'last-month'){

    		$last_month = Carbon::now()->addMonths(-1)->format('m');
    		$this_year  = Carbon::now()->format('Y');

    		$orders = Order::whereMonth('created_at',$last_month)->whereYear('created_at',$this_year)->get();

    	}else if($type == 'this-year'){

    		$this_year  = Carbon::now()->format('Y');
    		$orders = Order::whereYear('created_at',$this_year)->get();
    		

    		
    	}else if($type == 'last-year'){
    		$last_year = Carbon::now()->addYears(-1)->format('Y');

    		$orders = Order::whereYear('created_at',$last_year)->get();
    	}
    	else{

    		// $from = $r->from;
    		// $to = $r->to;

    		$start = $r->from;
    		$end   = $r->to;
    	
    		$orders = Order::whereDate('created_at', '>=', date($start))->whereDate('created_at', '<=', date($end))->get();
    	}

    
    	return response()->json([
    		'success' => 'success',
    		'orders'  => $orders,
    		'type'    => $type
    	]);	
    	
    
    }
}
