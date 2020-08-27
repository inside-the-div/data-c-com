<?php

use Illuminate\Database\Seeder;
use App\Ecommerce;
class EcommerceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$ecommerces = new Ecommerce;
        $ecommerces->product_prefix = "Data-P-";
        $ecommerces->order_prefix = "Data-O-";
        $ecommerces->invoice_prefix = "Data-I-";
        $ecommerces->shipping_cost_in_dhaka = 100;
        $ecommerces->shipping_cost_out_dhaka = 100;
        $ecommerces->save();
    }
}
