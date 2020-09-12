@extends('public.layouts.master')

@section('seo')
@endsection

@section('title')
Confirm Your Order
@endsection

@section('header')
	<style>
		.alert-heading{
			font-size: 25px;
		}
		h2{
			font-size: 18px;
		}
	</style>
@endsection


@section('content')
	<div class="container">
		<div class="row">
			<div class="col-12 my-2">

				<div class="alert alert-success" role="alert">
				  <h1 s class="alert-heading"><i class="fa fa-check-circle"></i> Thank You <b>Nasir Khan</b>, successfully your order submitted.</h1>
				  <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
				</div>
				
			</div>
		</div>
			<div class="row py-5">
				<div class="col-12 col-lg-4 mb-2">
					<div class="card p-3">
						<h2 class="text-center">Personal Information</h2>
						@if($return_customer == 1)
							<ul>
								<li><b>Name: </b>  {{$customer['name']}}</li>
								<li><b>Email: </b> {{$customer['email']}}</li>
								<li><b>Phone: </b> {{$billing['phone']}}</li>
							</ul>
						@else
							<p><b>{{$customer['name']}}</b> we just create an account for you, check your email ({{$customer['email']}}) to get your password. </p>

							<ul>
								<li><b>Name: </b>  {{$customer['name']}}</li>
								<li><b>Email: </b> {{$customer['email']}}</li>
								<li><b>Phone: </b> {{$billing['phone']}}</li>
							</ul>
						@endif

						
						<a class="text-right" href="{{route('login')}}">Update Information</a>
					</div>
				</div>
				<div class="col-12 col-lg-4 mb-2">
					<div class="card p-3">
						<h2 class="text-center">Billing Information</h2>
						<ul>
							<li><b>Address: </b> {{$billing['address']}}</li>
							<li><b>Phone: </b> {{$billing['phone']}}</li>
							<li><b>City: </b> {{$billing['city']}}</li>
							<li><b>Post Code: </b>{{$billing['post_code']}}</li>
						</ul>
						<a class="text-right" href="{{route('login')}}">Check Information</a>
					</div>
				</div>
				<div class="col-12 col-lg-4 mb-2">
					<div class="card p-3">
						<h2 class="text-center">Order Information</h2>
						<ul>
							<li><b>Order Code: </b> {{$order['order_code']}}</li>
							<li><b>Total Products: </b> {{$order['total_product']}}</li>
							<li><b>Total Quantity: </b> {{$order['total_quantity']}}</li>
							<li><b>Subtoal Cost: </b> {{$order['sub_total_cost']}}</li>
							<li><b>Shipping Cost: </b> {{$shipping['shipping_cost']}}</li>
							<li><b>Grand Total: </b> {{$order['total_cost']}}</li>
							<li><b>Payment Method: </b> {{$billing['billing_method']}}</li>
						</ul>
						<a class="text-right" href="{{route('login')}}">Check Information</a>
					</div>
				</div>
	
		</div>
	</div>
@endsection


@section('footer')

	
@endsection


