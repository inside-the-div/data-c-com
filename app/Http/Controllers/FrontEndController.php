<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;
use App\Order;
use App\ShippingDetail;
use App\BillingDetail;
use App\User;
use App\Banner;
use App\Settings;
use Session;
use Illuminate\Support\Facades\Cache;
use Mail;
class FrontEndController extends Controller
{
    
	public function home(){


		
		
		$categories =  Cache::rememberForever('CacheCategories', function () {
		    return Category::all();
		});

		if(!isset($_GET['page'])){
			$page = 1;
		}else{
			$page = $_GET['page'];
		}
		 
		$products = Cache::rememberForever('products_page'. $page,  function() {
		    return Product::paginate(20);
		});


		// if(!Session::has('banner')){
		// 	$banner = Banner::find(1);
		// 	Session::put('banner','1');
		// 	Session::put('banner_url',$banner->image);
		// 	Session::put('banner_text',$banner->text);
		// }


		return view('website.home',compact('products','categories','banner'));
	}

	public function products(){
		
		if(!isset($_GET['page'])){
			$page = 1;
		}else{
			$page = $_GET['page'];
		}
		 
		$products = Cache::rememberForever('all_products_page'. $page,  function() {
		    return Product::paginate(35);
		});


		return view('website.product.products',compact('products'));
	}


	public function single_product($slug){
		$product = Product::where('slug','=',$slug)->first();
		return view('website.product.single',compact('product'));
	}


	public function category($slug){
		$category = Category::where('slug','=',$slug)->first();
		return view('website.category.index',compact('category'));
	}



	public function store_order(Request $r){


		// customer info 
		$customer_name = $r->billing_f_name." ".$r->billing_l_name;
		$customer_email = $r->billing_email;
		$customer_password = $r->billing_phone;
		$customer_un_hash_pass = $customer_password;

		//shipping_info
		$shipping_first_name = $r->shipping_f_name;
		$shipping_last_name = $r->shipping_l_name;
		$shipping_cost = $r->shipping_cost;
		$shipping_address = $r->shipping_address;
		$shipping_city = $r->shipping_city;
		$shipping_email = $r->shipping_email;
		$shipping_phone = $r->shipping_phone;

		//billing
		$billing_first_name = $r->billing_f_name;
		$billing_last_name = $r->billing_l_name;
		$billing_address = $r->billing_address;
		$billing_city = $r->billing_city;
		$billing_email = $r->billing_email;
		$billing_phone = $r->billing_phone;
		

		// order 

		
		$total_products = $r->total_products;
		$total_quantity = $r->total_quantity;
		$total_cost = $r->total_cost;
		$sub_total = $r->sub_total;
		$emergency_contact_number = $r->emergency_contact_number;
		$customer_order_note = $r->customer_order_note;
		

		$code = substr(md5(time()), 0, 5);
		$last_2 = substr($emergency_contact_number, 9, 2);
		$code = "BC-".$code."-".$last_2;
		$order_code = $code;




		$customer = User::where('email','=',$customer_email)->first();

		if($customer){
			
			//dd("user already ace id is = ".$customer->id);
		}else{
			$customer =  User::create([
			    'name' => $customer_name,
			    'email' => $customer_email,
			    'un_hash_password' => $customer_un_hash_pass,
			    'password' => Hash::make($customer_password)
			]);
			//dd("user create hoyce user id is = ".$customer->id);
		}
		$customer_id = $customer->id;

		




		$order = new Order;
		$customer_id = $customer_id;
		$order->customer_id = $customer_id;
		$order->order_code = $order_code;
		$order->total_cost = $total_cost;
		$order->sub_total_cost = $sub_total;
		$order->total_product = $total_products;
		$order->total_quantity = $total_quantity;
		$order->emergency_phone = $emergency_contact_number;
		$order->customer_note = $customer_order_note;
		$order->save();

		$order_id = $order->id;




		
		$billing = new BillingDetail;
		$billing->order_id = $order_id;
		$billing->billing_method = 'hand cash';
		$billing->first_name = $billing_first_name;
		$billing->last_name = $billing_last_name;
		$billing->phone = $billing_phone;
		$billing->email = $billing_email;
		$billing->address = $billing_address;
		$billing->city =$billing_city;
		$billing->save();


		$shipping = new ShippingDetail;
		$shipping->order_id = $order_id;
		$shipping->shipping_cost = $shipping_cost;
		$shipping->first_name = $shipping_first_name;
		$shipping->last_name = $shipping_last_name;
		$shipping->phone = $shipping_phone;
		$shipping->email = $shipping_email;
		$shipping->address = $shipping_address;
		$shipping->city =$shipping_city;
		$shipping->save();



		// $order_product 
		$product_id_arr = $r->product_id_arr;
		$product_qty_arr = $r->product_qty_arr;

		
		for($i = 0; $i<sizeof($product_id_arr); $i++){
			$values = array(
				'order_id' => $order_id,
				'product_id' => $product_id_arr[$i],
				'product_quantity' => $product_qty_arr[$i]
			);
			DB::table('order_products')->insert($values);
		}
		
		

		// delete cart value
		 Session::forget('products');
         $input = [
         	'name' => $customer_name,
         	'email' => $customer_email,
         	'raw_password' =>$customer->un_hash_password
         ];
         Mail::send('email.order', $input, function($mail) use($input){
         	$mail->from('bantechai@gmail.com','Banate Chai')
         		 ->to($input['email'],$input['name'])
         		 ->subject('Order From BanateChai');
         });


		$success = 'Your order is complete. We will contact with you very soon.';
		return view('website.order.submit',compact('customer','success'));
	}




	public function privacy_policy(){
		return view('website.pages.privacy');
	}


	public function contact(){
		return view('website.pages.contact');
	}

	public function about(){
		return view('website.pages.about');
	}


	public function condition(){
		return view('website.pages.condition');
	}


	public function search(Request $r){
		$keyword = $r->keyword;

		$products = Product::where('name', 'LIKE', '%' . $keyword . '%')->get();
	
		return view('public.product.search',compact('products','keyword'));
	}
	



}
