<?php

namespace App\Http\Controllers\FrontEnd;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Review;
class ProductController extends Controller
{
    // single product start
    	public function single_product($slug){



    		$product = Cache::rememberForever('product-'.$slug, function () use($slug) {
    		    return Product::where('slug','=',$slug)->where('active','=',1)->first();
    		});





    	
/*
    # fetching reviews for this product from all review
    # cache value will setup in admin panel
    # for this we do not need store review again

*/
            $reviews = array();
            $all_reviews = Cache::rememberForever('all-reviews',function() {
                return Review::with('product','user')->orderBy('created_at','DESC')->get();
            });

            $total_reviews = 0;
            $limited_reviews = 0;

            foreach ($all_reviews  as  $review) {
                if($review->product_id == $product->id && $review->active == 1){

                    $limited_reviews++;
            
                    if($limited_reviews <= 20){
                       array_push($reviews,$review);
                    }

                    $total_reviews++;


                }
            }
// end


            $category = $product->categories[0];
            $slug = $category->slug;

            $releted_products = Cache::rememberForever('category-'.$slug.'-product-page-1', function () use($category){
                return $category->products()->where('active','=',1)->orderBy('id','DESC')->simplePaginate(20);
            });


    		
    
    		return view('public.product.single',compact('product','reviews','releted_products','total_reviews'));
    	}
    // end single product
}
