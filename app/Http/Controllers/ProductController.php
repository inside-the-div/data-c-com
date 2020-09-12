<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;

use Auth;
use App\ProductImage;
class ProductController extends Controller
{
	public function index(Request $r){


		$products = Cache::rememberForever('all-products', function () {
		    return Product::orderBy('id','DESC')->get();
		});

		return view('admin.product.index',compact('products'));

	}

	public function show($slug){
		
		$product = Product::with('reviews','user')->where('slug','=',$slug)->first();
		return view('admin.product.show',compact('product'));
	}

	public function add(){

		$categories = Cache::rememberForever('all-categories',function() {
		    return Category::with('products')->orderBy('id','DESC')->get();
		});

		return view('admin.product.add',compact('categories'));
	}

	public function edit($id){
		$product 	= Product::find($id);
		
		$categories = Cache::rememberForever('all-categories',function() {
		    return Category::with('products')->orderBy('id','DESC')->get();
		});
		
		$cat_array = array();
		foreach($product->categories as $cat){
			array_push($cat_array,$cat->name);
		}
		return view('admin.product.edit',compact('product','categories','cat_array'));
	}

	public function store(Request $r){

		$currentuserid = Auth::user()->id;

		$r->validate([
		    'name' => 'required|unique:products',
		    'category' => 'required',
		    'price' => 'required',
		    'stock' => 'required',
		    'attr_p' => 'required',
		    'description' => 'required',
		    'base_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

		]);

		$code = substr(md5(time()), 0, 5);
		$last_2 = rand(1,100);
		$code = "DA-E-P-".$code."-".$last_2;
		


		// upload base image 
		// $this_base_img = $r->base_image->store('public/images');

		$this_base_img = time().'.'.$r->base_image->getClientOriginalExtension();
		$r->base_image->move(public_path('/assets/img/products'), $this_base_img);
		
		$slug = strtolower($r->name);
		$slug = str_replace(' ','-',$slug);

		$product = new Product;

		$product->name = $r->name;
		$product->code = $code;
		$product->view = 1;
		$product->slug = $slug;
		$product->price = $r->price;
		$product->stock = $r->stock;
		$product->attributes = $r->attr_p;
		$product->description = $r->description;
		$product->active = $r->active;
		$product->available = $r->available;
		$product->user_id = $currentuserid;
		

		$product->image = $this_base_img;
		$product->save();
		$product->categories()->sync($r->category);

	

		Cache::flush(); // clear cache

		return redirect()->route('admin.products')->with('success','product Stored'); 

	} // end store

	public function delete(Request $r){
		
		$product = Product::find($r->id);
		$slug = $product->slug;

		$img_array = $product->images;


		
		//delete base image
		$path = public_path('/assets/img/products');
		if (File::exists($path.'/'.$product->image)){
		    File::delete($path.'/'.$product->image);
		}


		$product->delete();
		DB::table('category_product')->where('product_id',$r->id)->delete();
		
		

		Cache::flush(); // clear cache


		return response()->json([
			'message' => 'Success'
		]);

	} // end delete function 



	public function update(Request $r){



	
		$r->validate([
		    'name' => 'required|unique:products,name,'.$r->product_id,
		    'category' => 'required',
		    'price' => 'required',
		    'stock' => 'required',
		    'attr_p' => 'required',
			'description' => 'required',
			'product_id' => 'required'
			
		]);

		$currentuserid = Auth::user()->id;
		$product = Product::find($r->product_id);


		$slug = strtolower($r->name);
		$slug = str_replace(' ','-',$slug);

		$product->name = $r->name;
		$product->slug = $slug;
		$product->price = $r->price;
		$product->stock = $r->stock;
		$product->attributes = $r->attr_p;
		$product->description = $r->description;
		$product->active = $r->active;
		$product->available = $r->available;
		$product->user_id = $currentuserid;
		

		DB::table('category_product')->where('product_id',$r->product_id)->delete(); // delete old category form db 
		$product->categories()->sync($r->category); // store new category to db


		// base imgag code start 
		if ($r->hasFile('base_image')) {
		    $r->validate([
		        'base_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
		    ]);


			//delete old base image 
			$path = public_path('/assets/img/products');
			if (File::exists($path.'/'.$product->image)){
			    File::delete($path.'/'.$product->image);
			}

			//store new base image
			$this_base_img = time().'.'.$r->base_image->getClientOriginalExtension();
			$r->base_image->move(public_path('/assets/img/products'), $this_base_img);


			$product->image = $this_base_img;
			
		} // end base image code


		$product->save();


		Cache::flush(); // clear cache

		return back()->with('success','Success');
		
	} // end update function 


	

	public function active_deactivated(Request $r){

		$product = Product::find($r->id);

		Cache::flush(); // clear cache

		$product->active = !$product->active;
		$product->save();

		return response()->json([
			'message' => "Success"
		]);
	}



	public function home_show_hide(Request $r){
		
		$product = Product::find($r->id);

		Cache::flush(); // clear cache


		$product->home_show = !$product->home_show;
		$product->save();

		return response()->json([
			'message' => "Success"
		]);


	}



	public function download(){


		$filename = 'Data_Products_'.date("l_d_m_Y").'.csv';       
		header("Content-type: text/csv");       
		header("Content-Disposition: attachment; filename=$filename");       
		$output = fopen("php://output", "w");

		$header = ['Name','Code','Total Reviews','Rating','Tag','Stock','Price','Discount','Shipping Cost','Available','active','Date'];
		fputcsv($output, $header);
		$header = ['','','','','','','','','','','',''];
		fputcsv($output, $header); 


	    $products = Product::orderBy('created_at','DESC')->get();

	    foreach ($products as  $product) {
	       	$review = $product->reviews->count();
	        $this_product = [
	           
	            'name'  		 =>$product->name,
	            'code'  		 =>$product->code,
	            'total_review'	 =>$review,
	            'rating'    	 =>$product->rating,
	            'tag_line'  	 =>$product->tag_line,
	            'stock'  		 =>$product->stock,
	            'price'  		 =>$product->price,
	            'discount' 		 =>$product->discount,
	            'shipping_cost'  =>$product->shipping_cost,
	            'available'  	 =>$product->available,
	            'active'  		 =>$product->active,
	            'Date'  		 =>$product->created_at->format('d-m-Y')
	        ];
	       
	        fputcsv($output, $this_product); 
	    }
	         
	    fclose($output); 
	} // end download










    
}
