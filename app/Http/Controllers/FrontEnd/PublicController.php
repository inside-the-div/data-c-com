<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Session;
class PublicController extends Controller{
   
// index method start
	public function index(Request $r){


		if($r->has('page')){
			$page = $r->page;
		}else{
			$page = 1;
		}

		$products = Cache::rememberForever('products-page-'.$page, function () {
		    return Product::where('home_show','=',1)->orderBy('id','DESC')->simplePaginate(20);
		});
		

		// set in admin
		$categories = Cache::rememberForever('all-categories', function () {
		    return Category::with('products')->get();
		});

		return view('public.index',compact('products','categories'));
	}
// index method end





// shop page start
	public function shop_page(Request $r){
		return view('public.page.shop');
	}
// end shop page



// check-out page start
	public function check_out(){
		return view('public.page.check-out');
	}
// end check-out page




// contact page start
	public function contact_page(){
		return view('public.page.contact');
	}
// end contact page

// send contct email 




} // end controller
