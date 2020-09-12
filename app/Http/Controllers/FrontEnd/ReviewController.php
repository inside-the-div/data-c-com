<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Auth;
use App\Order;
use App\Product;
use App\Review;

class ReviewController extends Controller
{
    public function store(Request $r){
    	

    	$order_code 	= $r->order_id;
    	$product_id 	= $r->product_id;
    	$customer_id 	= Auth::user()->id;

    	$customer_name  = $r->name;
    	$rating  		= (int)$r->rating;
    	$comment 		= $r->comment;
    	$details 		= $r->details;


    	$orders = Order::where('order_code','=',$order_code)->where('customer_id','=',$customer_id)->get();

    	$order_count = $orders->count();

		
    	$review_store = 0;
    	$valid_order_customer = 0;

    	if($order_count > 0){

    		$order = $orders[0];

    		$products_ids = DB::table('order_products')->where('order_id', $order->id)->where('product_id','=',$product_id)->get();
    		$product_count = $products_ids->count();


    		if($product_count > 0){


    			$review = new Review;


				$review->user_id 	= $customer_id;
		        $review->order_code = $order_code;
				$review->product_id = $product_id;
				$review->active 	= 0;

		        $review->name 		= $customer_name;
		        $review->comment 	= $comment;
				$review->star 		= $rating;
				$review->details 	= $details;

				$review->save();
    					

    			$valid_order_customer = 1;
    			$review_store = 1;
    		}
    	}

    	




    	// remove cache
    	Cache::forget('all-reviews');



    	return response()->json([
    		'valid_order_customer' => $valid_order_customer,
    		'review_store' => $review_store
    	]);



    	

    	


    }
}
