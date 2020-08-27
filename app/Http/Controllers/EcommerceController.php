<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ecommerce;
class EcommerceController extends Controller
{
    public function update(Request $r){

    	$ecommerces = Ecommerce::find(1);
    	$r->validate([
    		'shipping_cost_in_dhaka' => 'required',
    		'shipping_cost_out_dhaka' => 'required'
    	]);

    	$ecommerces->shipping_cost_in_dhaka = $r->shipping_cost_in_dhaka;
    	$ecommerces->shipping_cost_out_dhaka = $r->shipping_cost_out_dhaka;

    	$ecommerces->save();

    	return back()->with('success','Ecommerce Settings Update Success!');
    }
}
