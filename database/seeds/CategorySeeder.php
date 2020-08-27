<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $category_list = [
            'boy',
            'girl',
            'men',
            'women',
            'kids',
            'men and women'
        ];

        for($i=0;$i<6;$i++){
        	$cat = new Category;

        	$cat->name = $category_list[$i];
        	$cat->slug = str_replace(" ","-",strtolower($category_list[$i]));
        	$cat->user_id = 1;
        	
        	$cat->save();
        }  
    }
}
