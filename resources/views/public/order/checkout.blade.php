@extends('public.layouts.master')

@section('seo')
@endsection

@section('title')
@endsection

@section('header')
<link href="{{URL::asset('assets/front-end/css/checkout.css')}}" rel="stylesheet">
@endsection


@section('content')
	<main class="bg_gray">


		<div class="container margin_30">
		
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="step first">
						<h3>1. User Info and Billing address</h3>
						<ul class="nav nav-tabs" id="tab_checkout" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_1" role="tab" aria-controls="tab_1" aria-selected="true">Shipping Details</a>
							</li>
							<li class="nav-item">
								@auth
								<a class="nav-link" id="profile-tab"  href="{{route('login')}}" >{{Auth::user()->name}}</a>
								@else
								<a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_2" role="tab" aria-controls="tab_2" aria-selected="false">Login</a>
								@endauth
							</li>
						</ul>
						<div class="tab-content checkout">
							<div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="tab_1">
								
									<div class="row no-gutters">
										<div class="col-12 form-group pr-1">
											@auth
											<input id="order_name" type="text" value="{{Auth::user()->name}}" name="shipping_name" class="form-control" placeholder="Name">
											@else
											<input id="order_name" type="text" value="" name="shipping_name" class="form-control" placeholder="Name">
											@endauth
										</div>
									</div>
									<div class="form-group">
										
										@auth
										<input id="order_email" type="email" class="form-control" name="email" placeholder="Email" value="{{Auth::user()->email}}">
										@else
										<input id="order_email" type="email" class="form-control" name="email" placeholder="Email" value="">
										@endauth
									</div>
									
									
								
									<!-- /row -->
									<div class="form-group">
										<input id="order_address" type="text" class="form-control" placeholder="Full Address">
									</div>
									<div class="row no-gutters">
										<div class="col-6 form-group pr-1">
											<input id="order_city" type="text" class="form-control" placeholder="City">
										</div>
										<div class="col-6 form-group pl-1">
											<input id="order_post_code" type="text" class="form-control" placeholder="Postal code">
										</div>
									</div>
									<!-- /row -->

									
									<div class="form-group">
										@auth
										<input id="order_phone" type="text" class="form-control" placeholder="Telephone" name="shipping_phone" value="{{Auth::user()->phone}}">
										@else
										<input id="order_phone" type="text" class="form-control" placeholder="Telephone" name="shipping_phone" value="">
										@endauth
										
									</div>

									<div class="form-group">
										<textarea name="customer_note" id="order_note" cols="30" rows="3" class="form-control" placeholder="Short Note"></textarea>
										
									</div>
									
								</form>

							</div>
							<!-- /tab_1 -->
							<div class="tab-pane fade" id="tab_2" role="tabpanel" aria-labelledby="tab_2">
								<form action="{{route('login')}}" method="POST">
									@csrf
									<input type="hidden" name="checkout" value="true">
									<div class="form-group">
										<input  id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

										@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

										@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="clearfix add_bottom_15">
										<div class="checkboxes float-left">
											{{-- <label class="container_check">Remember me
												<input type="checkbox">
												<span class="checkmark"></span>
											</label> --}}
										</div>
										<div class="float-right"><a id="" href="{{ route('password.request') }}">Lost Password?</a></div>
									</div>
									<div id="forgot_pw">
										<div class="form-group">
											<input type="email" class="form-control" name="email_forgot" id="email_forgot" placeholder="Type your email">
										</div>
										<p>A new password will be sent shortly.</p>
										<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
									</div>
									<hr>
									<input type="submit" class="btn_1 full-width" value="Login">
								</form>
							</div>
							<!-- /tab_2 -->
						</div>
					</div>
					<!-- /step -->
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="step middle payments">
						<h3>2. Payment and Shipping</h3>
						<ul>
							<li>
								<label class="container_radio">Credit Card<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
									<input type="radio" name="payment" checked>
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_radio">Paypal<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
									<input type="radio" name="payment">
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_radio">Cash on delivery<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
									<input type="radio" name="payment">
									<span class="checkmark"></span>
								</label>
							</li>
							<li>
								<label class="container_radio">Bank Transfer<a href="#0" class="info" data-toggle="modal" data-target="#payments_method"></a>
									<input type="radio" name="payment">
									<span class="checkmark"></span>
								</label>
							</li>
						</ul>





					</div>
					<!-- /step -->

				</div>
				<div class="col-lg-4 col-md-6">
					<div class="step last">
						<h3>3. Order Summary</h3>
						<div class="box_general summary">

							<ul>
								@php
								$total = 0;
								@endphp
								@foreach(Session('cart-products') as $product)
								@php
								$sub_total = $product['quantity'] * $product['price'];
								$total += $sub_total;
								@endphp
								<li class="clearfix"><em>{{$product['quantity']}} <b>x</b> {{$product['name']}}</em>  <span>৳ {{$sub_total}}</span></li>

								@endforeach
							</ul>

							@php
							$shipping_cost = 60;
							$grand_toal = $shipping_cost + $total;
							@endphp

							<input type="hidden" id="totla_cost" value="{{$total}}">
							<ul>
								<li class="clearfix"><em><strong>Subtotal</strong></em>  <span>৳ {{$total}} </span></li>
								<li class="clearfix"><em><strong>Shipping</strong></em> <span>৳ {{$shipping_cost}}</span></li>
							</ul>
							<div class="total clearfix">TOTAL <span>৳ {{$grand_toal}}</span></div>
							<div class="form-group">
								<label class="container_check">Register to the Newsletter.
									<input type="checkbox" checked>
									<span class="checkmark"></span>
								</label>
							</div>

							<a href="#" id="submit_order" class="btn_1 full-width">Confirm and Pay</a>
						</div>
						<!-- /box_general -->
					</div>
					<!-- /step -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</main>
	<!--/main-->
@endsection


@section('footer')

    <script>
    	// Other address Panel
		$('#other_addr input').on("change", function (){
	        if(this.checked)
	            $('#other_addr_c').fadeIn('fast');
	        else
	            $('#other_addr_c').fadeOut('fast');
	    });
	</script>



	<script>
		// ajax call setup header 
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});
		// end header setup 
		
		$(document).ready(function(){
			var total_cost 	= $("#totla_cost").val();

			if(total_cost == "0"){
				window.location.href = "/";
			}

			$("#submit_order").click(function(e){

				var name 		= $("#order_name").val();
				var email 		= $("#order_email").val();
				var phone 		= $("#order_phone").val();
				var address 	= $("#order_address").val();
				var city 		= $("#order_city").val();
				var post_code 	= $("#order_post_code").val();
				var note 		= $("#order_note").val();
				
				if(name == "" || email == "" || phone == "" || address == "" || city == "" || post_code == "" || note == ""){
					alert("Please Fill All the fields!");
					return false;
				}

				
				
				 if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))){
				    alert("You have entered an invalid email address!")
				    return false;
				  }
				    
				


				var order_data = {
					name:name,
					email:email,
					phone:phone,
					address:address,
					city:city,
					post_code:post_code,
					note:note
				};

				$.ajax({

				   type:'POST',
				   url:'/order-submit',
				   data:order_data,
				   success:function(data){

				   	// console.log(data);
					 window.location.href = "/confirm";
					
				  } //end success
				 
				}); // end ajax request

				e.preventDefault();
				
			})
		})
	</script>
@endsection


