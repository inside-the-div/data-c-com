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
        $ecommerces->product_prefix = "DoDO-P-";
        $ecommerces->order_prefix = "DoDO-O-";
        $ecommerces->invoice_prefix = "DoDO-I-";
        $ecommerces->shipping_cost_in_dhaka = 100;
        $ecommerces->shipping_cost_out_dhaka = 100;
        $ecommerces->save();
    }
}
