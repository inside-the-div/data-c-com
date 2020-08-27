<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Category;
use App\Product;
use Auth;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   

        // dd(Route::getRoutes());

        // $permission_str = Auth::user()->permissions;
        // $permissions_array =  explode(",",$permission_str);

        // Session::put('permissions',$permissions_array);

        // $permissions = Session::get('permissions');

        // if(!in_array("all", $permissions)){
        //     dd($permissions);
        // }else{
        //     dd("ok");
        // }

        
        
        $confirm_orders = Order::where('status','=','Confirm')->count();
        $pending_orders = Order::where('status','=','Pending')->count();
        $complete_orders = Order::where('status','=','Complete')->count();
        $total_order = $complete_orders+$pending_orders+$confirm_orders;

        $order_data = [
            'confirm'  => $confirm_orders,
            'pending'  => $pending_orders,
            'complete' => $complete_orders,
            'total'    => $total_order
        ];

        $categories = Category::all()->count();
        $customer =   User::where('type','=','customer')->count();



        // products data =============
        


        $out_of_stock_products = Product::where('stock','<',1)->get();
        $low_stock_products = Product::where('stock','<',10)->where('stock','>',1)->get();

        $total_products = Product::all()->count();
        $total_out_of_stock_products = $out_of_stock_products->count();
        $total_low_stock_products = $low_stock_products->count();


        $products_data = array(
            'total_products' => $total_products,
            'total_out_of_stock_products' => $total_out_of_stock_products,
            'total_low_stock_products' => $total_low_stock_products
        );



        
        return view('admin.dashboard',compact('order_data','customer','categories','products_data','low_stock_products','out_of_stock_products'));
    }
}
