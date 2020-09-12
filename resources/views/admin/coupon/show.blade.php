@extends('admin.layouts.master')



@section('content')
	<div class="row">
		<div class="col-12 col-lg-4">
			<div class="card p-3">
				<h2 class="text-center font-pt font-25">Coupon Details</h2>
				<hr>
				<h3 class="font-pt font-20 mb-2"><b>Code:</b> {{$coupon->code}}</h3>
				<h3 class="font-pt font-20 mb-2"><b>Start Time:</b> {{$coupon->start_time}}</h3>
				<h3 class="font-pt font-20 mb-2"><b>End Time:</b> {{$coupon->end_time}}</h3>
				<h3 class="font-pt font-20 mb-2"><b>Apply on:</b> {{$coupon->type}}</h3>
				<h3 class="font-pt font-20 mb-2"><b>Discount:</b> {{$coupon->discount}}</h3>
				<h3 class="font-pt font-20 mb-2"><b>Unit:</b> {{$coupon->discount_type}}</h3>
				<h3 class="font-pt font-20 mb-2"><b>Description:</b> {{$coupon->description}}</h3>
			</div>
		</div>
		<div  class="col-12 col-lg-8 table-responsive" >
			
			@if($coupon->type == "Selected Products")

			<div class="card p-3" id="selected_products_area">
				<h2 class="font-25 font-pt text-center">Total Select Products:<span id="total_selected_products"  class="badge">{{$products->count()}}</span></h2>
				
				<hr>


				<div class="table-overflow" style="max-height: 800px; overflow: scroll;">
					<table class="table table-bordered custom-data-table">
					  <thead>
					    <tr align="center">
					      <th>Name</th>
					      <th>Code</th>
					      <th>Stock</th>
					      <th>Price</th>
					      <th>Discount</th>
					      <th>Image</th>
					    </tr>
					  </thead>
					  <tbody>
						
					  	@foreach($products as $product)
					    <tr>
					      <td>{{$product->name}}</td>
					      <td>{{$product->code}}</td>
					      <td>{{$product->stock}}</td>
					      <td>{{$product->price}}</td>
					      <td>{{$product->discount}}</td>
					      <td><img width="40px;" src="{{URL::asset('/assets/img/products/')}}/{{$product->image}}" alt=""></td>
					    </tr>
					    @endforeach

			

					  </tbody>
					</table>
				</div>
				
			</div>

			@elseif($coupon->type == "Order")

			<div id="min_cost_area" class="card p-3">
				
				<h3 class="font-pt font-20 mb-2"><b>Minimum Cost of an Order:</b> {{$coupon->min_cost}}</h3>
				
			</div>

			@endif
		</div> 
	</div>
@endsection






