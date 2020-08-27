@extends('customer.layouts.master')



@section('title')
<title>Your All Orders</title>
@endsection


@section('content')
<!-- page title area  -->

<div class="row pb-3">
  <div class="col-12 ">
    <div class="text-right">
   
    <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

    </div>
  </div>
</div>

 <div class="row mt-2">
   <div class="col-12">
     <div class="card p-3 rounded-0 table-responsive">

     <table class="table table-striped table-dark display " id="dataTable">
       <thead>
         <tr>
           <th scope="col">No</th>
           <th scope="col">Order Id</th>
           <th scope="col">Date</th>
           <th scope="col">Process</th>
           <th scope="col">Status</th>
           <th scope="col">Payment</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($orders as $order)
			@php 
				$i++;
			@endphp
         <tr>
           <td class="font-pt" >{{$i}}</td>
           <td class="font-pt">{{$order->order_code}}</td>
           <td class="font-pt">{{$order->created_at->format('Y-m-d')}}</td>
           <td class="font-pt">
             <div class="progress">
               <div class="progress-bar bg-success" role="progressbar" style="width: {{$order->process}}%" aria-valuenow="{{$order->process}}" aria-valuemin="0" aria-valuemax="100"></div>
             </div>
           </td>
           <td class="font-pt">{{$order->status}}</td>
          

            <td class="font-pt">{{$order->payment}}</td>
           <td class="font-pt">
            <a data-toggle="tooltip" data-placement="top" title="Details" class=" btn btn-info " href="{{route('customer.order.single', ['id' => $order->id])}}">
             <i class="fa fa-eye" aria-hidden="true"></i>
           </a>

           <a  data-toggle="tooltip" data-placement="top" title="Invoice" class="btn btn-primary" href="{{route('admin.order.invoice', ['id' => $order->id])}}">
             <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
           </a>

         </td>
         </tr>
       @endforeach
       </tbody> 


     </table>
     </div>
   </div>
 </div>
 <!-- website info area end -->

@endsection