<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class DataController extends Controller
{
    public function sells(){


    	$products = Product::all();

    	$products_data =  array();

    	foreach ($products as  $product) {
    	    $qty = 0;
    	    foreach ($product->sells as  $sell) {
    	        $qty  += $sell->product_quantity;
    	    }
    	    $total_order =  $product->sells->count();

    	    $this_product = [
    	        'id' => $product->id,
    	        'slug' => $product->slug,
    	        'image' => $product->image,
    	        'name'  => $product->name,
                'stock'  =>$product->stock,
                'date'  =>$product->created_at,
    	        'total_order' => $total_order,
    	        'total_sell'  =>$qty
    	    ];

    	    $products_data[] = $this_product;
    	}

    	//dd($products_data);

    	return view('admin.data.sells',compact('products_data'));
    }


    public function sells_download(){
    	$products = Product::all();

    	$products_data =  array();

    	foreach ($products as  $product) {
    	    $qty = 0;
    	    foreach ($product->sells as  $sell) {
    	        $qty  += $sell->product_quantity;
    	    }
    	    $total_order =  $product->sells->count();

    	    $this_product = [
    	       
    	        'name'  => $product->name,
                'stock'  =>$product->stock,
    	        'total_order' => $total_order,
    	        'total_sell'  =>$qty,
                'Date'  =>$product->created_at->format('d-m-Y'),
    	    ];

    	    $products_data[] = $this_product;
    	}


        //dd($products_data);


    	 $filename = 'Data_Sells_'.date("l_d_m_Y").'.csv';       
    	 header("Content-type: text/csv");       
    	 header("Content-Disposition: attachment; filename=$filename");       
    	 $output = fopen("php://output", "w");

    	 $header = ['Name','Stock','Total Order','Total Sell','Date'];
    	 fputcsv($output, $header);
    	 $header = ['','','','',''];
    	 fputcsv($output, $header);  

    	 foreach($products_data as $product)       
    	 {  

    	      fputcsv($output, $product);  
    	 }       
    	 fclose($output);       
    	


    }
}
