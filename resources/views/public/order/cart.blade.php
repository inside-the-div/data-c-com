@extends('public.layouts.master')

@section('seo')
@endsection

@section('title')
@endsection

@section('header')
<link href="{{URL::asset('assets/front-end/css/cart.css')}}" rel="stylesheet">
@endsection


@section('content')
	<main class="bg_gray">
			<div class="container margin_30">
			<div class="page_header">

				<h1>Cart page</h1>
			</div>
			<!-- /page_header -->
			<table class="table table-striped cart-list">
								<thead>
									<tr>
										<th>
											Products
										</th>
										<th>
											Price
										</th>
										<th>
											Quantity
										</th>
										<th>
											Subtotal
										</th>
										<th>
											
										</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										$total = 0;
									?>
									@foreach(Session::get('cart-products') as $product)

										<?php 
											$sub_total = $product['quantity'] * $product['price'];

											$total += $sub_total;
										?>
									<tr id="delete-tr-{{$product['code']}}">
										<td>
											<div class="thumb_cart">
												<img src="{{URL::asset('assets/img/products')}}/{{$product['image']}}" data-src="{{URL::asset('assets/img/products')}}/{{$product['image']}}" class="lazy" alt="Image">
											</div>
											<span class="item_cart">{{$product['name']}}</span>
										</td>
										<td>
											<strong>৳ {{$product['price']}}</strong>
										</td>
										<td>
											<div class="numbers-row">
												<input type="text" value="{{$product['quantity']}}" id="quantity-{{$product['code']}}"  data-code="{{$product['code']}}"   class="qty2 product-inc-dec" name="quantity-{{$product['code']}}">

											</div>
										</td>
										<td>
											<strong>৳ {{$sub_total}}</strong>
										</td>
										<td class="options">
											<a class="delete_product" data-code="{{$product['code']}}" href="#"><i class="ti-trash"></i></a>
										</td>
									</tr>

									@endforeach
								

								</tbody>
							</table>

							<div class="row add_top_30 flex-sm-row-reverse cart_actions">
							<div class="col-sm-4 text-right">
								<div class="apply-coupon">
									<div class="form-group form-inline">
										<input type="text" name="coupon-code" value="" placeholder="Promo code" class="form-control"><button type="button" class="btn_1 outline">Apply Coupon</button>
									</div>
								</div>
							</div>
							
						</div>
						<!-- /cart_actions -->
		
			</div>
			<!-- /container -->
			
			<div class="box_cart">
				<div class="container">
				<div class="row justify-content-end">
					<div class="col-xl-4 col-lg-4 col-md-6">
				<ul>
					
				
					<li id="total_price">
						<span>Total</span> ৳ {{$total}}
					</li>
				</ul>
				<a href="{{route('website.cart.check_out')}}" class="btn_1 full-width cart">Proceed to Checkout</a>
						</div>
					</div>
				</div>
			</div>
			<!-- /box_cart -->
			
		</main>
		<!--/main-->
@endsection


@section('footer')

	<script>
		$(document).ready(function(){
			$(".delete_product").click(function(){
				var code = $(this).data('code');

				$("#delete-tr-"+code).hide();


				var total_cart_products = Number($("#total_cart_products").html());
				$("#total_cart_products").html((total_cart_products - 1));

				

				$.ajax({
				   type:'POST',
				   url:'/delete-cart-product',

				   data:{code:code},
				   success:function(data){
				      
				   		var products = data.products; // return all cart product

				   		var products_array = $.map(products, function(value, index) {
				   		    return [value];
				   		}); // making obj to array

				   		$total = 0;
				   		for(var i=0;i<products_array.length;i++){
				   			var product = products_array[i];
				   			var sub_total = Number(product.price) * Number(product.quantity);
				   			$total += sub_total;
				   		}

				   		$("#total_price").html(`<span>Total</span> ৳ `+$total); // set total price


				   		// update top cart
				   		mekeCart(products);

				   } // end success

				}) // end ajax call


			}) // end delete





			$(".dec").click(function(){
				var input = $(this).prev().prev('input');

				var quantity = input.val();
				var code = input.data('code');

				if(quantity<1){
					input.val(1)
					return false;
				}

				update_product_quantity(code,quantity)

				
			})

			$(".inc").click(function(){
				var input = $(this).prev('input');
				var quantity = input.val();
				var code = input.data('code');

				if(quantity<1){
					input.val(1)
					return false;
				}


				console.log($("#notification-product-updated").fadeIn())

				 setTimeout(function(){
				   $("#notification-product-updated").fadeOut();
				 }, 2000);


				update_product_quantity(code,quantity);
			})



		}) // end jquery 




		function update_product_quantity(code,quantity){
				
			


			


			$.ajax({
			   type:'POST',
			   url:'/update-cart',

			   data:{
			   	code:code,
			   	quantity:quantity
			   },
			   success:function(data){
			      	


			   		var products = data.products; // return all cart product

			   		var products_array = $.map(products, function(value, index) {
			   		    return [value];
			   		}); // making obj to array

			   		$total = 0;
			   		for(var i=0;i<products_array.length;i++){
			   			var product = products_array[i];
			   			var sub_total = Number(product.price) * Number(product.quantity);
			   			$total += sub_total;
			   		}

			   		$("#total_price").html(`<span>Total</span> ৳ `+$total); // set total price


			   		// update top cart
			   		mekeCart(products);

			   } // end success

			}) // end ajax call


		}





	</script>
@endsection


