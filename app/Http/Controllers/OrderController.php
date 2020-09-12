<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Product;
use App\User;

use App\ShippingDetail;
use App\BillingDetail;

class OrderController extends Controller
{
    public function index(){

        $orders = Cache::rememberForever('all-orders', function () {
            return Order::orderBy('id','DESC')->get();
        });

        return view('admin.order.index',compact('orders'));
    }

    public function show($id){


        $order = Order::find($id);
        $shipping = $order->shipping;
        $billing = $order->billing;

        $products_ids = DB::table('order_products')->where('order_id', $order->id)->get();


        // $products_id_array =  [];
        // $products_qty_array =  [];
        // foreach ($products_ids as $p) {
        //     array_push($products_id_array, $p->product_id);
        //     array_push($products_qty_array, $p->product_quantity);
        // }

       
        // $products = Product::whereIn('id',$products_id_array)->get();




        $products =  [];

        foreach ($products_ids as $p) {


        

            $product = Product::find($p->product_id);

            $temp_product =  array(

                'id'        => $product->id, 
                'slug'      => $product->slug, 
                'name'      => $product->name, 
                'code'      => $product->name, 
                'image'     => $product->image, 
                'price'     => $p->product_price, 
                'date'      => $p->date, 
                'quantity'  => $p->product_quantity
            );

            array_push($products, $temp_product);

        }




        
         
        return view('admin.order.show',compact('order','shipping','billing','products','products_qty_array'));
    }


    public function invoice($id){


        $order = Order::find($id);
        $customer = User::find($order->customer_id);
        $shipping = $order->shipping;
        $billing = $order->billing;

        $products_ids = DB::table('order_products')->where('order_id', $order->id)->get();


        $products_id_array =  [];
        $products_qty_array =  [];
        foreach ($products_ids as $p) {
            array_push($products_id_array, $p->product_id);
            array_push($products_qty_array, $p->product_quantity);
        }

        $products = Product::whereIn('id',$products_id_array)->get();
         
        return view('admin.order.invoice',compact('order','shipping','billing','products','products_qty_array','customer'));
    }



    public function add(){
    	return view('admin.order.add');
    }

    public function update(Request $r){
        
        $order = Order::find($r->id);





       
       if($r->order_status == "confirm"){
           $products_data =  DB::table('order_products')->where('order_id','=',$order->id)->get();

           foreach ($products_data as $product_data) {
               $product = Product::find($product_data->product_id);
               $product->stock = ($product->stock) - ($product_data->product_quantity);
               $product->save();
           }

       }



        $order->payment = $r->payment_status;
        $order->admin_note = $r->admin_note;
        $order->status = $r->order_status;
        $order->process = $r->order_processing_percentage;
        $order->payment_cost = $r->payment_cost;

        $order->save();

    	return back()->with('success','Order Update Success');
    }



    public function store(Request $r){
    	return back()->with('success','Order Stored')->route('admin.index');
    }

    public function delete(Request $r){

        $id = $r->id;
        
        Order::find($id)->delete();
        BillingDetail::where('order_id','=',$id)->delete();
        ShippingDetail::where('order_id','=',$id)->delete();
        DB::table('order_products')->where('order_id', $id)->delete();
        
    	// return back()->with('success','Order Deleted');

        return response()->json([
            'message' => 'Success'
        ]);
    }


    public function active(Request $r){
    	return back()->with('success','Order Activated');
    }
    public function deactivated(){
    	return back()->with('success','Order Deactivated');
    }

    public function seen(Request $r){
        $order = Order::find($r->id);

        $order->seen = 1;

        $order->save();
        return response()->json([
            'message' => 'Success'
        ]);
    }





    public function download(){


        $filename = 'Data_Products_'.date("l_d_m_Y").'.csv';       
        header("Content-type: text/csv");       
        header("Content-Disposition: attachment; filename=$filename");       
        $output = fopen("php://output", "w");

        $header = [
            'Code',
            'Total Cost',
            'Sub Total Cost',
            'Total Product',
            'Total Quantity',
            'Status',
            'Payment',
            'Payment Cost',
            'Process',
            'Date'
        ];
        fputcsv($output, $header);
        $header = ['','','','','','','','',''];
        fputcsv($output, $header); 


        $orders = Order::orderBy('created_at','DESC')->get();

        foreach ($orders as  $order) {
           
            $this_order = [
               
                'code'              =>$order->order_code,
                'total_cost'        =>$order->total_cost.'Tk',
                'sub_total_cost'    =>$order->sub_total_cost.'Tk',
                'total_product'     =>$order->total_product,
                'total_quantity'    =>$order->total_quantity,
                'status'            =>$order->status,
                'payment'           =>$order->payment,
                'payment_cost'      =>$order->payment_cost.'Tk',
                'process'           =>$order->process."%",
                'Date'              =>$order->created_at->format('d-m-Y')
            ];
           
            fputcsv($output, $this_order); 
        }
             
        fclose($output); 
    } // end download




}
