<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Order;
use App\ShippingDetail;
use App\BillingDetail;
use App\User;
use App\Banner;
use App\Settings;
use Session;
use Mail;

class OrderController extends Controller
{
   public function submit(Request $r){
   		// customer info 

   		$SHIPPING_COST = 60;

   		$customer_name 			= $r->name;
   		$customer_email 		= $r->email;
   		$customer_phone 		= $r->phone;
   		$customer_address		= $r->address;
   		$customer_note 			= $r->note;
   		$customer_city 			= $r->city;
   		$customer_post_code 	= $r->post_code;
   		$customer_un_hash_pass  = $customer_phone;

   		//shipping_info
   		$shipping_name 		= $customer_name;
   		$shipping_cost      = $SHIPPING_COST;
   		$shipping_address   = $customer_address;
   		$shipping_city 	    = $customer_city;
   		$shipping_email     = $customer_email;
   		$shipping_phone     = $customer_phone;
   		$shipping_post_code = $customer_post_code;

   		//billing
   		
   		$billing_name 		= $customer_name;
   		$billing_phone 		= $customer_phone;
   		$billing_address 	= $customer_address;
   		$billing_city 		= $customer_city;
   		$billing_email 		= $customer_email;
   		$billing_post_code  = $customer_post_code;
   		$billing_method 	= "Hand Cash";
   		



   		$products = Session::get('cart-products');


   		$total_product = 0;
   		$sub_total = 0;
   		$total_quantity = 0;

   		foreach ($products as $product) {
   			$total_product++;

   			$sub_total 	+= ( $product['price'] * $product['quantity'] ); 
   			$total_quantity += $product['quantity'];
   		}

   		$grand_toal = $sub_total + $SHIPPING_COST;


   		
   		$total_products 			= $total_product;
   		$total_quantity 			= $total_quantity;
   		$total_cost 				= $grand_toal;
   		$sub_total 					= $sub_total;
   		$emergency_contact_number   = $customer_phone;
   		$customer_order_note 		= $customer_note;
   		
   		$code = substr(md5(time()), 0, 5);
   		$last_2 = substr($emergency_contact_number, 9, 2);
   		$code = "BC-".$code."-".$last_2;
   		$order_code = $code;


   		$return_customer = 0;
   		
   		$customer = User::where('email','=',$customer_email)->first();



   		

   		if(!$customer){

   			$return_customer = 0;
   			
   			$customer =  User::create([
   			    'name' 					 => $customer_name,
   			    'email' 				 => $customer_email,
   			    'un_hash_password'  	 => $customer_un_hash_pass,
   			    'password' 				 => Hash::make($customer_phone),
   			    'permissions' 			 => 'all',
   			    'permission_description' => 'all'
   			]);

   		}else{
   			$return_customer  = 1;
   		}


 

   		$customer_id = $customer->id;

   		
   		$order = new Order;
   		
   		$order->customer_id 	= $customer_id;
   		$order->order_code 		= $order_code;
   		$order->total_cost 		= $total_cost;
   		$order->sub_total_cost  = $sub_total;
   		$order->total_product 	= $total_products;
   		$order->total_quantity  = $total_quantity;
   		$order->emergency_phone = $emergency_contact_number;
   		$order->customer_note   = $customer_note;
   		$order->save();

   		$order_id = $order->id;


   		

   		

   		

   		$billing = new BillingDetail;
   		$billing->order_id 		 = $order_id;
   		$billing->billing_method = $billing_method;
   		$billing->name 	         = $billing_name;
   		$billing->phone 	     = $billing_phone;
   		$billing->email 		 = $billing_email;
   		$billing->address 		 = $billing_address;
   		$billing->city 			 = $billing_city;
   		$billing->post_code      = $billing_post_code;
   		$billing->save();



   		


   		$shipping = new ShippingDetail;
   		$shipping->order_id      = $order_id;
   		$shipping->shipping_cost = $SHIPPING_COST;
   		$shipping->name 	     = $shipping_name;
   		$shipping->phone 		 = $shipping_phone;
   		$shipping->email 		 = $shipping_email;
   		$shipping->address 		 = $shipping_address;
   		$shipping->post_code 	 = $shipping_post_code;
   		$shipping->city 		 = $shipping_city;
   		$shipping->save();







   		foreach ($products as $product) {
   			$values = array(
   				'order_id' 			=> $order_id,
   				'product_id' 		=> $product['id'],
   				'product_quantity'  => $product['quantity'],
   				'date' 				=> $order->created_at
   			);
   		 DB::table('order_products')->insert($values);
   		}

 

   		Session::put('customer',$customer);
   		Session::put('return_customer',$return_customer);
   		Session::put('order',$order);
   		Session::put('billing',$billing);
   		Session::put('shipping',$shipping);


   		Session::forget('cart-products');

   		
         Cache::forget('all-orders');

   		return response()->json([
   			'customer' 		  => $customer,
   			'return_customer' => $return_customer,
   			'order' 		  => $order,
   			'billing'		  => $billing,
   			'shipping'        => $shipping
   		]);
   }


   public function confirm(){

   		if(!Session::has('customer')){
   			// return redirect('/');
   			dd("dd");
   		}

   		$customer 		 = Session::get('customer');
   		$return_customer = Session::get('return_customer');
   		$order 			 = Session::get('order');
   		$billing 		 = Session::get('billing');
   		$shipping 		 = Session::get('shipping');


   		Session::forget('customer');
   		Session::forget('return_customer');
   		Session::forget('order');
   		Session::forget('billing');
   		Session::forget('shipping');
   		

   		return view('public.order.confirm',compact('customer','return_customer','order','billing','shipping'));
   }
}
