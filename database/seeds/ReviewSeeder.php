<?php

use Illuminate\Database\Seeder;
use App\Review;
class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=100;$i++){

        	for($j=0;$j<rand(3,5); $j++){
        		$review = new Review;

        		$review->user_id = rand(2,11);
                
        		$review->product_id = $i;
        		$review->active = rand(0,1);
        		

                $review->name = "Nasir Khan";
                $review->comment = "Outstanding";
                $review->star = rand(3,5);
               
        		$review->details = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur rem neque excepturi id asperiores incidunt!";

        		$review->save();
        	}
        }
    }
}
