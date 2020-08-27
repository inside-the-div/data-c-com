<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Category;

use Auth;
use App\ProductImage;
class ProductController extends Controller
{
	public function index(Request $r){


		$products = Product::orderBy('id','DESC')->get();

		return view('admin.product.index',compact('products'));

	}

	public function show($slug){
		
		$product = Product::with('images','reviews','user')->where('slug','=',$slug)->first();
		return view('admin.product.show',compact('product'));
	}

	public function add(){

		$categories = Category::with('products')->orderBy('id','DESC')->get();

		return view('admin.product.add',compact('categories'));
	}

	public function edit($id){
		$product 	= Product::find($id);
		
		$categories = Category::with('products')->orderBy('id','DESC')->get();
		
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
		$code = "Data-E-P-".$code."-".$last_2;
		


	

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

		
		if ($r->hasFile('more_image')) {

			for($i=0; $i< count($r->more_image); $i++){

				// $this_mor_img = $r->more_image[$i]->store('public/images');

				$this_mor_img = time().$i.'.'.$r->more_image[$i]->getClientOriginalExtension();
				$r->more_image[$i]->move(public_path('/assets/img/products'), $this_mor_img);

				$more_img = new ProductImage;
				
				$more_img->product_id = $product->id;
				$more_img->image = $this_mor_img;
				$more_img->save();
			}
		}


		

		return redirect()->route('admin.products')->with('success','product Stored'); 

	} // end store

	public function delete(Request $r){
		
		$product = Product::find($r->id);
		$slug = $product->slug;

		$img_array = $product->images;

		// delete slider image from store
		foreach ($img_array as $img) {
			$path = public_path('/assets/img/products');
			if (File::exists($path.'/'.$img->image)){
			    File::delete($path.'/'.$img->image);
			}
		}
		
		//delete base image
		$path = public_path('/assets/img/products');
		if (File::exists($path.'/'.$product->image)){
		    File::delete($path.'/'.$product->image);
		}


		$product->delete();
		DB::table('category_product')->where('product_id',$r->id)->delete();
		DB::table('product_images')->where('product_id',$r->id)->delete();
		

		Cache::flush(); // clear cache


		return response()->json([
			'message' => 'Success'
		]);

	} // end delete function 



	public function update(Request $r){



		// dd($r);

		if ($r->has('slider_image_delete_id_array')) {
   			// delete slider which xros
   			$id_array = $r->slider_image_delete_id_array;

   			for($j=0;$j<count($id_array);$j++){
   				$slider = ProductImage::find($id_array[$j]);
   				$delete_this_slider =  $slider->image;


   				$path = public_path('/assets/img/products');
   				if (File::exists($path.'/'.$delete_this_slider)){
   				    File::delete($path.'/'.$delete_this_slider);
   				}

   				$slider->delete();  //also delete form db
   			}
		}

	
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

		// get name and id array of old slider 
		$slider_img_name_array = $r->old_img_name_array;
		$slider_img_id_array = $r->old_img_id_array;

	
		for($i=1; $i<= $r->total_old_img; $i++){
			if ($r->hasFile('slider_'.$i)) {

				$r->validate([
					'slider_'.$i => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
				]);

				$delete_this_image = $slider_img_name_array[$i-1];
				$delete_this_more_img_record_form_db = $slider_img_id_array[$i-1];

				// $del = 0;
				// if(Storage::delete($delete_this_image)){
				// 	$del = 1;
				// } 

				// delete this image from folder
				$path = public_path('/assets/img/products');
				if (File::exists($path.'/'.$delete_this_image)){
				    File::delete($path.'/'.$delete_this_image);
				}


				ProductImage::find($delete_this_more_img_record_form_db)->delete(); // delete slider old slider image form db
				
				$str = 'slider_'.$i;

				$store_this_image = $r->$str; //get new slider
				dd("new slider =>> ".$store_this_image);

				// dd($str);
				// $new_slider = $store_this_image->store('public/images');// store new slider image 

				//store new slider
				$new_slider = time().$i.'.'.$store_this_image->getClientOriginalExtension();
				$store_this_image->move(public_path('/assets/img/products'), $new_slider);

				$new_slider_obj = new ProductImage; 
				$new_slider_obj->product_id = $r->product_id; 
				$new_slider_obj->image = $new_slider; 
				$new_slider_obj->save();

			}
		}

	
		// store and upload new image 
		if ($r->hasFile('more_image')) {

			$this->validate($r, [
				'more_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
			]);

			for($i=0; $i< count($r->more_image); $i++){

				$this_more_img = $r->more_image[$i];

				$new_slider = time().$i.'.'.$this_more_img->getClientOriginalExtension();
				$this_more_img->move(public_path('/assets/img/products'), $new_slider);


				$more_img = new ProductImage;
				$more_img->product_id = $r->product_id;
				$more_img->image = $new_slider;
				$more_img->save();

			}
		}

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
