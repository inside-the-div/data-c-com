@extends('admin.layouts.master')

@section('title')
<title>All Orders</title>
@endsection


@section('content')
  <div class="row py-3">
    <div class="col-12 ">
      <div class="text-right">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>


     <form class="d-inline" action="{{route('admin.order.download')}}" method="POST">
       @csrf
       <button data-toggle="tooltip" data-placement="top" title="Donwload Category Data" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></button>
     </form>

      <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>


      </div>
    </div>
  </div>


 <div class="row mt-2">
   <div class="col-12">
     <div class="card p-3 rounded-0 table-responsive">

     <table class="table table-striped table-dark display " id="dataTable">
       <thead>
         <tr align="center">
           <th scope="col">No</th>
           <th scope="col">Id</th>
           <th scope="col">Date</th>
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
         <tr align="center">
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$order->order_code}}</td>
           <td class="font-pt font-18">{{$order->created_at->format('Y-m-d')}}</td>
           <td class="font-pt font-18">{{$order->status}}</td>
          
            <td class="font-pt font-18">{{$order->payment}}</td>
           <td class="font-pt font-18">
            <a data-toggle="tooltip" data-placement="top" title="View" class="btn btn-info" href="{{route('admin.order.show', ['id' => $order->id])}}">
              <i class="fa fa-eye" aria-hidden="true"></i>
            </a>

            <a  data-toggle="tooltip" data-placement="top" title="Invoice" class="btn btn-primary" href="{{route('admin.order.invoice', ['id' => $order->id])}}">
              <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
            </a>

          
            <a  data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger delete-order" href="#" data-id="{{$order->id}}">
              <i class="fa fa-trash" aria-hidden="true"></i>
            </a>


          </td>
         </tr>
       @endforeach
       </tbody> 

       <tr>
       	
       </tr>
     </table>
     </div>
   </div>
 </div>
 <!-- website info area end -->

@endsection





@section('footer-section')

<script>
  

  $(document).ready(function(){
    // delete order // main function form ajax-delete.js
    $(".delete-order").click(function(){
      var id = $(this).data('id');
      var is_delete = delete_data(this,id,'/admin/order/delete');
    })
    // end delete code





  
  })// end jquery
</script>
@endsection