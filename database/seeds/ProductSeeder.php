<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\ProductImage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){




	    $description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea non error, perspiciatis deleniti adipisci natus a sit recusandae molestiae voluptates, illum ipsa nemo assumenda amet veniam quae minus fuga alias, accusantium, illo libero. Harum repudiandae est iusto quidem iste eum, ipsum, id, repellendus cum minus voluptates aperiam cupiditate vero, odio repellat cumque pariatur itaque maiores temporibus suscipit modi ea. Adipisci a ea nobis alias eveniet repudiandae, sequi velit, impedit repellendus eius veritatis, non natus nisi vel aliquam corporis, aut blanditiis dolore! Optio aspernatur ducimus excepturi inventore explicabo magnam suscipit, ex nobis quos doloribus fugit molestiae eligendi tenetur amet, eum veritatis!";


	    $attr = '
		    	<p><b>Color: </b></p>
				<ul>
					<li>Red</li>
					<li>Green</li>
					<li>Blue</li>
				</ul>

		    	<p><b>Size: </b></p>
				<ul>
					<li>XL</li>
					<li>M</li>
					<li>S</li>
					<li>XXL</li>
				</ul>
	    ';

	    $tag_line = ['new','hot','off'];



	    $slider_img_index = 0;

	
        $name = [
            'boy',
            'girl',
            'men',
            'women',
            'kids'
        ];


        for($i=0;$i<5;$i++){
            for($j=1;$j<=15;$j++){
                 $product = new Product;

            
                $discount = rand(0,35);
                 

                 $product->code              = "DoDo-P-".$i.'-'.$j;
                 $product->user_id           = 1;
                 $product->view              = 100;
                 $product->rating            = rand(2,5);
                 $product->name              = $name[$i].' T-Shirt-'.$j;
                 $product->slug              = str_replace(" ","-",strtolower($name[$i].' T-Shirt-'.$j));
                 $product->image             = $name[$i].' ('.$j.').jpg';
                 $product->price             = rand(1000,2500);
                 $product->stock             = rand(50,150);
                 $product->description       = $description;
                 $product->attributes        = $attr;
                 $product->discount          = $discount;
                 $product->shipping_cost     = rand(50,80);
                 $product->active            = 1;
                 $product->available         = 1;
                 
                 $product->home_show         = 1;

                 $product->save();



                  DB::table('category_product')->insert([
                     'product_id' => $product->id,
                     'category_id'=> ($i+1)
                 ]);


                     

            }
        }


    } // end function

}// end class
