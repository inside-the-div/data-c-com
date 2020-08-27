@extends('admin.layouts.master')



@section('title')
<title>Dashboard</title>
@endsection


@section('content')

	<div class="row">
		<div class="col-12 py-3">
			<div class="text-right">


      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>


			<form class="d-inline" action="{{route('admin.data.sells.download')}}" method="POST">
				@csrf
				<button data-toggle="tooltip" data-placement="top" title="Donwload Sells Data" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i></button>
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
           <th scope="col">Name</th>
           <th scope="col">Image</th>
           <th scope="col">Stock</th>
           <th scope="col">Total Order</th>
           <th scope="col">Total Sell</th>
           <th scope="col">Date</th>
         </tr>
       </thead>
      <tbody>
		@php 
			$i= 0;
		@endphp
		@foreach($products_data as $product)
			@php 
				$i++;
			@endphp
         <tr align="center">
           <th class="font-pt font-18" >{{$i}}</th>
           <td class="font-pt font-18">{{$product['name']}}</td>
           <td class="font-pt font-18"><img width="40px" class="" src="{{URL::asset('/assets/img/products')}}/{{$product['image']}} " alt=""></td>
           <td class="font-pt font-18">{{$product['stock']}}</td>
           <td class="font-pt font-18">{{$product['total_order']}}</td>
           <td class="font-pt font-18">{{$product['total_sell']}}</td>
           <td class="font-pt font-18">{{$product['date']->format('d-m-Y')}}</td>
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