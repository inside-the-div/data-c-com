<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\User;
class CustomerController extends Controller
{
   public function index(){

      $customers = Cache::rememberForever('all-custommers',function() {
          return User::with('orders')->where('type','=','customer')->get();
      });

   	return view('admin.customer.index',compact('customers'));
   }

   public function show($id){

      $customer = User::find($id);


   	return view('admin.customer.show',compact('customer'));
   }

   public function add(){
   	return view('admin.customer.add');
   }

   public function edit($id){
   	return view('admin.customer.edit');
   }

   public function store(Request $r){
   	return back()->with('success','customer Cteaed')->route('admin.index');
   }

   public function delete(Request $r){
   	return back()->with('success','customer Deleted')->route('admin.index');
   }



   public function download(){

      
      $filename = 'Data_Customers_'.date("l_d_m_Y").'.csv';       
      header("Content-type: text/csv");       
      header("Content-Disposition: attachment; filename=$filename");       
      $output = fopen("php://output", "w");

      $header = ['Name','Email','Phone','Total Order','Registration Date'];
      fputcsv($output, $header);
      $header = ['','','','',''];
      fputcsv($output, $header); 


       $customers = User::with('orders')->where('type','=','customer')->orderBy('id','DESC')->get();

       foreach ($customers as  $customer) {
           
           $customer = [
                'name'         =>$customer->name,
                'email'        =>$customer->email,
                'phone'        =>$customer->phone,
                'total_order'  =>$customer->orders->count(),
                'Date'         =>$customer->created_at->format('d-m-Y')
           ];

          fputcsv($output, $customer);
       }

       fclose($output);
   }



   public function delete_all_customer_cache(){
       Cache::forget('all-custommers');
   }



  
}
