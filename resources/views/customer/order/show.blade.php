@extends('customer.layouts.master')



@section('title')
<title>Order | {{$billing->name}}</title>
@endsection


@section('content')
	<div class="row pb-3">
	  <div class="col-12 ">
	    <div class="text-right">
	    <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

	    </div>
	  </div>
	</div>


	<div class="row">

		<div class="col-12 col-lg-5 mb-3">
			<div class="row">
				<div class="col-12">
					<div class="card p-3">
						<h2 class="font-20 font-pt">Admin Note</h2>
						<hr>
						
							{{$order->admin_note}}

					</div>
				</div>

				<div class="col-12 mt-2">
					<div class="card p-3">
						<h2 class="font-20 font-pt">Order Details</h2>
						<hr>
						
						<div class="row">
							<div class="col-12 col-lg-6">
								<ul class="group-list">
									<li class="font-pt font-16 mb-1"><b>Order Code: </b>{{$order->order_code}}</li>
									<li class="font-pt font-16 mb-1"><b>Total Products: </b>{{$order->total_product}}</li>
									<li class="font-pt font-16 mb-1"><b>Total Quantity: </b>{{$order->total_quantity}}</li>
									<li class="font-pt font-16 mb-1"><b class="">Shipping Cost: </b>{{$shipping->shipping_cost}} Tk</li>
									<li class="font-pt font-16 mb-1"><b>Total Cost (without shipping): </b>{{$order->sub_total_cost}} Tk</li>
									<li class="font-pt font-16 mb-1"><b>Total Cost: </b>{{$order->total_cost}} Tk</li>
									<li class="font-pt font-16"><b>Total Payment: </b>{{$order->payment_cost}} Tk</li>

								</ul>
							</div>

							<div class="col-12 col-lg-6">
								<ul class="group-list">
									<li class="font-pt font-16 mb-1"><b class="">Payment Status: </b>{{$order->payment}}</li>
									<li class="font-pt font-16 mb-1 "><b class="">Order Status: </b>{{$order->status}}</li>
									<li class="font-pt font-16 mb-1 "><b class="">Order Process: </b>{{$order->process}} %</li>
									<li class="font-pt font-16 "><b>Emergency phone: </b>{{$order->emergency_phone}} </li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<div class="col-12 mt-2">
					<div class="card p-3">
						<h2 class="font-20 font-pt">Billing Details</h2>
						<hr>

						<ul class="group-list">
							<li class="font-pt font-16 mb-1"><b>Name: </b>{{$billing->first_name}} {{$billing->last_name}}</li>
							<li class="font-pt font-16 mb-1"><b>Phone: </b>{{$billing->phone}}</li>
							<li class="font-pt font-16 mb-1"><b>Email: </b>{{$billing->email}}</li>
							<li class="font-pt font-16 mb-1"><b>City: </b>{{$billing->city}}</li>
							<li class="font-pt font-16 mb-1"><b class="">Bill Pay Mathod: </b>{{$billing->billing_method}}</li>
							<li class="font-pt font-16"><b>Address: </b> {{$billing->address}}</li>
						</ul>
					</div>
				</div>

				<div class="col-12 mt-2">
					<div class="card p-3">
						<h2 class="font-20 font-pt">Shipping Details</h2>
						<hr>
						<ul class="group-list">
							<li class="font-pt font-16 mb-1"><b>Name: </b>{{$shipping->first_name}} {{$shipping->last_name}}</li>
							<li class="font-pt font-16 mb-1"><b>Phone: </b>{{$shipping->phone}}</li>
							<li class="font-pt font-16 mb-1"><b>Email: </b>{{$shipping->email}}</li>
							<li class="font-pt font-16 mb-1"><b>City: </b>{{$shipping->city}}</li>
							<li class="font-pt font-16 mb-1"><b class="">Shipping Cost: </b>{{$shipping->shipping_cost}} Tk</li>
							<li class="font-pt font-16"><b>Address: </b> {{$shipping->address}}</li>

						</ul>
					</div>
				</div>
			</div>
		</div>


		<div class="col-12  col-lg-7">
			<div class="card p-3">
				<h2 class="font-20 font-pt">Products of This Order ({{$order->total_product}})</h2>
				<hr>

				     <table class="table table-striped table-dark display ">
				       <thead>
				         <tr align="center">
				           
				           <th scope="col">Name</th>
				           <th scope="col">Code</th>
				           <th scope="col">Image</th>
				           <th scope="col">Price</th>
				           <th scope="col">Quantity</th>
				           <th scope="col">Subtotal</th>
				           
				         </tr>
				       </thead>
				      <tbody>
						@php 
							$i= -1;
							$total_quantity = 0;
							$grand_total = 0;
						@endphp
						@foreach($products as $product)
							@php 
								$i++;

								$total_quantity += $products_qty_array[$i];

								$sub_total = ($products_qty_array[$i] * $product->price);
								$grand_total += $sub_total;
							@endphp
				        <tr align="center"> 
				           
				           
				           <td><a target="_blank" href="{{route('website.single_product',['slug' => $product->slug])}}" class="text-light font-pt font-18">{{$product->name}}</a></td>
				           <td>{{$product->code}}</td>
				           <td class="font-pt font-18"><img width="40px" class="" src="{{URL::asset('/assets/img/products')}}/{{$product->image}}" alt=""></td>
				           <td class="font-pt font-18">৳ {{$product->price}}</td>
				           <td class="font-pt font-18">{{$products_qty_array[$i]}}</td>
				           <td class="font-pt font-18">৳ {{$sub_total}}</td>
				        </tr>

				          


				          

				         

				      
				        
				       @endforeach

				       <tr align="center">
				       	<td colspan="4" align="right">Grand</td>
				       	<td>{{$total_quantity}}</td>
				       	<td>৳ {{$grand_total}}</td>
				       </tr>
				       </tbody> 

				     </table>
			</div>
		</div>


	</div>








@endsection