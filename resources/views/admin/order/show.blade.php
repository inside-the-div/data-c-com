@extends('admin.layouts.master')



@section('title')
<title>Order | {{$billing->name}}</title>
@endsection


@section('content')
	
	<div class="row">

		<div class="col-12 col-lg-5 mb-3">
			<div class="row">
				<div class="col-12">
					<div class="card p-3">
						<h2 class="font-20 font-pt">Update Order</h2>
						<hr>
						<form method="POST" action="{{route('admin.order.update')}}">
							@csrf
							<label for="admin_note"><b>Order Note*</b></label>
							<textarea class="form-control" name="admin_note" id="admin_note" cols="30" rows="3">{{$order->admin_note}}</textarea>

							<div class="row mt-2">
								<div class="col-12 col-lg-6 mb-2">
									<label for="payment_status"><b>Payment Status:</b></label>
									<select class="form-control" name="payment_status" id="payment_status">
										
										<option value="{{$order->payment}}">{{$order->payment}}</option>
										<option value="Pending">Pending</option>
										<option value="Confirm">Confirm</option>
										<option value="Complete">Complete</option>
									</select>
								</div>

								<div class="col-12 col-lg-6 mb-2">
									<label for="order_status"><b>Order Status:</b></label>
									<select class="form-control" name="order_status" id="order_status">
										<option value="{{$order->payment}}">{{$order->payment}}</option>
										<option value="cancel">cancel</option>
										<option value="Processing">Processing</option>
										<option value="On The Way">On The Way</option>
										<option value="Delivered">Delivered</option>
									</select>
								</div>
								

								<div class="col-12 col-lg-6 mb-2">
									<label for="payment_cost" class="mt-2"><b>Total Payment:</b></label>
									<input value="{{$order->payment_cost}}" type="number" id="payment_cost" step="any" class="form-control" name="payment_cost">
								</div>


								<div class="col-12 col-lg-6 mb-2">
									<label for="order_processing_percentage" class="mt-2"><b>Order Processing Percentage(%):</b></label>
									<input value="{{$order->process}}" type="number" id="order_processing_percentage" step="any" class="form-control" name="order_processing_percentage">
								</div>
					
							</div>

							<input type="hidden" name="id" value="{{$order->id}}">
							<input type="submit" name="submit" class="btn_1 form-control mt-2"  value="Update">
							
						</form>
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
				           <td><a target="_blank" href="{{route('admin.product.show',['slug' => $product->slug])}}" class="text-light font-pt font-18">{{$product->code}}</a></td>
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