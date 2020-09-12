<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Order;
use App\Product;
use App\User;

use App\ShippingDetail;
use App\BillingDetail;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<50;$i++){


        

            $customer_id = rand(2,11);
            $order_code  = "DoDo-O-N-".$i;

            $total_product = rand(1,8);

            $product_id_array = array();
            $product_quantity_array = array();
            $product_price_array = array();

            $sub_total_cost = 0;
            $total_cost = 0;
            $total_quantity = 0;

            for($j=0;$j<$total_product;$j++){
                $product_id = rand(1,75);
                $this_product_quantity = rand(1,5);

                array_push($product_id_array, $product_id);
                array_push($product_quantity_array, $this_product_quantity);

                $total_quantity += $this_product_quantity;


                $product = Product::find($product_id);

                array_push($product_price_array, $product->price);
                $sub_total_cost += ($this_product_quantity * $product->price);

            }

            $shipping_cost = 60;
            $total_cost = $sub_total_cost + $shipping_cost;


            $emergency_phone = "0163701792".$i;

            $status_index = rand(1,3);

            if($status_index == 1){
                $status       = "pending";
                $payment      = "pending";
                $payment_cost = 0;
                $process      = 0;
                $admin_note   = "pending";
            }else{
                $status       = "confirm";
                $payment      = "confirm";
                $payment_cost = $total_cost;
                $process      = rand(1,100);
                $admin_note   = "confirm";
            }

            $order = new Order;
            
            $order->customer_id        = $customer_id;
            $order->order_code         = $order_code;
            $order->total_cost         = $total_cost;
            $order->sub_total_cost     = $sub_total_cost;
            $order->total_product      = $total_product;
            $order->total_quantity     = $total_quantity;
            $order->emergency_phone    = $emergency_phone;

            $order->status         = $status;
            $order->payment        = $payment;
            $order->payment_cost   = $payment_cost;
            $order->process        = $process;
            $order->admin_note     = $admin_note;
            $order->seen           = rand(0,1);
            
            
            $order->save();

            $order_id = $order->id;


            for($k = 0; $k<sizeof($product_id_array); $k++){
                $values = array(
                    'order_id'           => $order_id,
                    'product_id'         => $product_id_array[$k],
                    'product_quantity'   => $product_quantity_array[$k],
                    'product_price'      => $product_price_array[$k],
                    'date'               => $order->created_at,
                );
                DB::table('order_products')->insert($values);
            }





            $customer = User::find($customer_id);


            $billing = new BillingDetail;
            $billing->order_id         = $order_id;
            $billing->billing_method   = 'hand cash';
            $billing->name             = $customer->name;
            
            $billing->phone    = $customer->phone;
            $billing->email    = $customer->email;
            $billing->address  = "this is address";
            $billing->city     = "Dhaka";
            $billing->save();


            $shipping = new ShippingDetail;
            $shipping->order_id        = $order_id;
            $shipping->shipping_cost   = $shipping_cost;
            $shipping->name            = $customer->name;;
       
            $shipping->phone   = $customer->phone;
            $shipping->email   = $customer->email;
            $shipping->address = "this is address";
            $shipping->city    = "Dhaka";
            $shipping->save();



        }
        
    }
}
