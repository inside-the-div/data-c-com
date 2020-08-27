@extends('admin.layouts.master')



@section('title')
<title>Single New Order</title>
@endsection


@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12 text-right pb-3">
      <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

       <a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="About This Option" href=""><i class="fa fa-info-circle" aria-hidden="true"></i></a>
  </div>
</div>

<div class="row">
	<div class="col-12 col-lg-4 mb-2">
		<div class="card p-3">
			<h1 class="text-center font-20 font-pt">Personal Information</h1>
			<hr>

			<div class="row">
				<div class="col-12 col-lg-4">
					<img src="" alt="" class="img-fluid">
				</div>
				<div class="col-12 col-lg-6">
					<ul class="font-pt font-16">
						<li><b>Name: </b>Nasir Khan</li>
						<li><b>Email: </b>Nasir Khan</li>
						<li><b>Phone: </b>Nasir Khan</li>
						<li><b>Address: </b>Nasir Khan</li>
					</ul>
				</div>
			</div>
			<hr class="mb-2">
			<h1 class="text-center font-20 font-pt">Orders Information</h1>
			<hr>
	
			<ul class="font-pt font-16">
				<li><b>Total: </b><span id="show_total_order"></span></li>
				<li><b>Completed: </b><span id="show_total_completed_order"></span></li>
				<li><b>Confirm: </b><span id="show_total_confirm_order"></span></li>
				<li><b>Pending: </b><span id="show_total_pending_order"></span></li>
				<li><b>Purchase Quantity: </b><span id="show_purchase_quantity"></span></li>
				<li><b>Purchase Cost: </b><span id="show_purchase_cost"></span> Tk</li>
			</ul>

			<hr class="mb-2">
			<h1 class="text-center font-20 font-pt">Reviews Information</h1>
			<hr>
			
			<ul class="font-pt font-16">
				<li><b>Total: </b><span id="show_total_review"></span></li>
				<li><b>Active: </b><span id="show_total_active_review"></span></li>
				<li><b>Pending: </b><span id="show_total_pending_review"></span></li>
				
			</ul>
			
		</div>
	</div>

	<div class="col-12 col-lg-4 mb-2" style="max-height: 600px; overflow-y: scroll;">
		<div class="card p-3">
			<h1 class="text-center font-20 font-pt">All Orders</h1>
			<hr>

			<table class="table table-bordered">
			  <thead>
			    <tr align="center">
			      <th scope="col">No</th>
			      <th scope="col">Code</th>
			      <th scope="col">Status</th>
			      <th scope="col">Cost</th>
			      <th scope="col">Date</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@php
			  		$i=0;

			  		$total_completed_order = 0;
			  		$total_confirm_order = 0;
			  		$total_pending_order = 0;
			  		$purchase_quantity = 0;
			  		$purchase_cost = 0;
			  	@endphp
			  	@foreach($customer->orders as $order)
			  	@php
			  		$i++;
			  	

					if($order->status == 'confirm'){
						$total_confirm_order = 1;

						$purchase_quantity += $order->total_quantity;
						
					}else if($order->status == 'pending'){
						$total_pending_order++;
					}


					if($order->process == 100){
						$total_completed_order++;
					}

					if($order->payment == 'confirm'){
						$purchase_cost += $order->total_cost;
					}
				
				@endphp

			    <tr align="center">
			      <th scope="row">{{$i}}</th>
			      <td><a target="_blank" href="{{route('admin.order.show',['id' => $order->id])}}">{{$order->order_code}}</a></td>
			      <td>{{$order->status}}</td>
			      <td>{{$order->total_cost}} Tk</td>
			      <td>{{$order->created_at->format('d-m-Y')}}</td>
			    </tr>
			    @endforeach
			  </tbody>
			</table>

			<input type="hidden" id="total_order" value="{{$i}}">
			<input type="hidden" id="total_confirm_order" value="{{$total_confirm_order}}">
			<input type="hidden" id="total_pending_order" value="{{$total_pending_order}}">
			<input type="hidden" id="total_completed_order" value="{{$total_completed_order}}">
			<input type="hidden" id="purchase_quantity" value="{{$purchase_quantity}}">
			<input type="hidden" id="purchase_cost" value="{{$purchase_cost}}">

		</div>
	</div>


	<div class="col-12 col-lg-4 mb-2" style="max-height: 600px; overflow-y: scroll;">
		<div class="card p-3">
			<h1 class="text-center font-20 font-pt">All Reviews</h1>
			<hr>

			<ol>
				
				@php
					$total_review = 0;
					$total_active_review = 0;
					$total_pending_review = 0;
				@endphp



			  @foreach($customer->reviews as $review)

				@php
					$total_review++;

					if($review->active == 1){
						$total_active_review++;
					}else{
						$total_pending_review++;
					}
				@endphp



			    <li class="p-2  mb-1 @if($review->active == 1) bg-success  @else bg-warning text-dark @endif">
			      <a href="">
			      	<b>Name: </b>{{$review->user->name}} <br>
			      	<b>Comment: </b>{{$review->comment}} <br>
			      	<b>Star: </b>{{$review->star}}
			      </a>
			  </li>
			  @endforeach
			</ol>

			<input type="hidden" id="total_review" value="{{$total_review}}">
			<input type="hidden" id="total_active_review" value="{{$total_active_review}}">
			<input type="hidden" id="total_pending_review" value="{{$total_pending_review}}">

		</div>
	</div>



</div>







@endsection


@section('footer-section')


<script>
  $(document).ready(function(){

  	$("#show_total_order").html($("#total_order").val());
  	$("#show_total_confirm_order").html($("#total_confirm_order").val());
  	$("#show_total_pending_order").html($("#total_pending_order").val());
  	$("#show_total_completed_order").html($("#total_completed_order").val());
  	$("#show_purchase_quantity").html($("#purchase_quantity").val());
  	$("#show_purchase_cost").html($("#purchase_cost").val());



  	$("#show_total_review").html($("#total_review").val());
  	$("#show_total_active_review").html($("#total_active_review").val());
  	$("#show_total_pending_review").html($("#total_pending_review").val());

  })

</script>

@endsection