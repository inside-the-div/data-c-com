@extends('admin.layouts.master')

@section('title')
<title>All Customers</title>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right py-3">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

     <form class="d-inline" action="{{route('admin.customer.download')}}" method="POST">
       @csrf
       <button data-toggle="tooltip" data-placement="top" title="Donwload Category Data" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></button>
     </form>

      <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
  </div>
</div>



 <div class="row mt-2">
   <div class="col-12">
     <div class="card p-3 rounded-0 table-responsive">

     <table class="table table-striped table-dark display " id="dataTable">
       <thead>
         <tr align="center">
           <th scope="col">No</th>
           <th scope="col">Name</th>
           <th scope="col">Email</th>
           <th scope="col">Phone</th>
           <th scope="col">Total Order</th>
           <th scope="col">Action</th>
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($customers as $customer)
			@php 
				$i++;
			@endphp
         <tr align="center">
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$customer->name}}</td>
           <td class="font-pt font-18">{{$customer->email}}</td>
          
           <td class="font-pt font-18">{{$customer->phone}}</td>
           <td class="font-pt font-18">{{$customer->orders->count()}}</td>
           

  
           
           <td class="font-pt font-18">
            <a data-toggle="tooltip" data-placement="top" title="Full Info." class="btn btn-info" href="{{route('admin.customer.show', ['id' => $customer->id])}}"><i class="fa fa-eye" aria-hidden="true"></i>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger" href=""><i class="fa fa-trash" aria-hidden="true"></i>
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