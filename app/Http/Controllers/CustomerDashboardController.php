<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Product;
use App\Review;
use App\User;
class CustomerDashboardController extends Controller
{
    public function index(){

        $customer_id = Auth::user()->id;
        $orders = Order::where('customer_id','=',$customer_id)->get();

        $total_order = $orders->count();

        $pending_order = 0;
        $confirm_order = 0;

        $complete_order = 0;

        foreach ($orders as  $order) {


            if($order->status == 'confirm'){
                $confirm_order++;
            }else if($order->status == 'pending'){
                $pending_order++;
            }

            if($order->process == 100){
                $complete_order++;
            }
        }


        $reviews = Review::where('user_id','=',$customer_id)->get();
        $total_reviews = $reviews->count();


        $pending_review = 0;
        $confirm_review = 0;

        

        foreach ($reviews as  $review) {


            if($review->active == 1){
                $confirm_review++;
            }else if($review->active == 0){
                $pending_review++;
            }

            
        }


        $data = array(
            'total_order'       => $total_order,
            'pending_order'     => $pending_order,
            'confirm_order'     => $confirm_order,
            'complete_order'    => $complete_order,
            'total_reviews'     => $total_reviews,
            'pending_review'    => $pending_review,
            'confirm_review'    => $confirm_review
        );


    	return view('customer.dashboard',compact('data'));
    }
    public function order(){
    	$customer_id = Auth::user()->id;
    	$orders = Order::where('customer_id','=',$customer_id)->get();
    	return view('customer.order.index',compact('orders'));

    	//return "order view";
    }

    public function single($id){
        $customer_id = Auth::user()->id;

        $order = Order::where('id','=',$id)->where('customer_id','=',$customer_id)->findOrFail($id);
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
         
        return view('customer.order.show',compact('order','shipping','billing','products','products_qty_array'));
    }

    public function profile(){
    	return view('customer.profile.show');
    }

    public function profile_edit(){
        return view('customer.profile.edit');
    }




    public function user_profile_update(Request $r){
        $user = User::find($r->id);

        // dd($user);
        $user->name = $r->name;
        $user->phone = $r->phone;
        $user->website = $r->website;
        $user->about = $r->about;
        $user->address = $r->address;


        $old_profile = $user->image;


        if ($r->hasFile('image')){


            // dd($user);

            
            $r->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $del = 0;
            if(Storage::delete($old_profile)){
                $del = 1;
            }
            $new_image = $r->image->store('public/images/user');
            $user->image = $new_image;
        }


        $user->save();
        return back()->with('success','Profile Updated Success!');

    }



    public function password_change(Request $r){
        

        $user = User::find($r->id);



        $r->validate([
            'new_password' => 'required|min:8',
            'confirm_new_password' => 'required|min:8',
        ]);


        if($r->new_password != $r->confirm_new_password){
            return back()->withErrors(['password' => ['Please use same password']]);
        }

        

        if(!Hash::check($r->old_password, $user->password)){
            return back()->withErrors(['password' => ['Wrong password']]);
        }

        $user->password = Hash::make($r->new_password);
        $user->un_hash_password = $r->new_password;
        $user->save();

        return back()->with('success','Password Change Success!');



    }




    public function reviews(){

        $customer_id = Auth::user()->id;

        $reviews = Review::with('product')->where('user_id','=',$customer_id)->get();
        $total_reviews = $reviews->count();


        $pending_review = 0;
        $confirm_review = 0;

        

        foreach ($reviews as  $review) {


            if($review->active == 1){
                $confirm_review++;
            }else if($review->active == 0){
                $pending_review++;
            }

            
        }


        return view('customer.review.index',compact('pending_review','confirm_review','reviews'));
    }

}
