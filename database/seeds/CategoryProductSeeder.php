<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<=100;$i++){
        	 DB::table('category_product')->insert([
        	    'product_id' => $i,
        	    'category_id'=> rand(1,5)
        	]);
        }
    }
}
