@extends('public.layouts.master')

@section('seo')

@endsection

@section('title')
{{$product->name}}
@endsection

@section('header')
<style>
	.bg-added{
		background: #00cc00 !important;
		    color: #fff !important;
	}
</style>
@endsection


@section('content')

<main>
	<div class="container margin_30">
		
		<div class="row">
			<div class="col-md-6">
				<div class="all">
					<div class="slider">
						<div class="owl-carousel owl-theme main">
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item-box"></div>
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item-box"></div>
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item-box"></div>
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item-box"></div>
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item-box"></div>
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item-box"></div>
			
						</div>
						<div class="left nonl"><i class="ti-angle-left"></i></div>
						<div class="right"><i class="ti-angle-right"></i></div>
					</div>
					<div class="slider-two">
						<div class="owl-carousel owl-theme thumbs">
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item active"></div>
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item "></div>
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item "></div>
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item "></div>
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item "></div>
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item "></div>
							<div style="background-image: url('{{URL::asset('assets/img/products')}}/{{$product->image}}');" class="item "></div>
					
						</div>
						<div class="left-t nonl-t"></div>
						<div class="right-t"></div>
					</div>
				</div>
			</div>
			<div class="col-md-6">

				<!-- /page_header -->
				<div class="prod_info">
					<h1>{{$product->name}}</h1>
					<span class="rating">
						@for($star=1;$star<=$product->rating;$star++)
						<i style="color: #ff9800;" class="fa fa-star" aria-hidden="true"></i>
						@endfor

						@for($star=1;$star<=(5 - $product->rating);$star++)
						<i style="" class="fa fa-star" aria-hidden="true"></i>
						@endfor
					</span>
					<p><small>Code:</small> {{$product->code}}<br>
						{!! $product->attributes !!}
					</p>
					<div class="prod_options">

						<div class="row">
							<label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Quantity</strong></label>
							<div class="col-xl-4 col-lg-5 col-md-6 col-6">
								<div class="numbers-row">
									<input min="1" type="text" value="1" id="quantity_1" class="qty2" name="quantity_1">
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-5 col-md-6">
							<div class="price_main"><span class="new_price">৳ {{$product->price}}</span></div>
						</div>
						<div class="col-lg-4 col-md-6">
							<div class="btn_add_to_cart_area">
								<a href="#"

									 class="tooltip-1 btn_1 add-to-cart-single-btn"

									 data-id="{{$product->id}}" 
									 data-price="{{$product->price}}"
									 data-name="{{$product->name}}"
									 data-image="{{$product->image}}"
									 data-code="{{$product->code}}"
									 data-slug="{{$product->slug}}"
									 >Add to Cart</a></div>
						</div>
					</div>
				</div>
				<!-- /prod_info -->
				
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->

	<div class="tabs_product">
		<div class="container">
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Description</a>
				</li>
				<li class="nav-item">
					<a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Reviews ({{$total_reviews}})</a>
				</li>
			</ul>
		</div>
	</div>
	<!-- /tabs_product -->
	<div class="tab_content_wrapper">
		<div class="container">
			<div class="tab-content" role="tablist">
				<div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
					
					<div id="collapse-A"  >
						<div class="card-body">
							<div class="row justify-content-between">
								<div class="col-lg-12">
									<h3>Details</h3>
									<p>{{$product->description}}</p>
								</div>
								
							</div>
						</div>
					</div>
				</div>
				<!-- /TAB A -->
				<div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
		
					<div id="collapse-B" >
						<div class="card-body">
							<div class="row justify-content-between">
								
								@foreach($reviews as $review)

									@if($review->active == 1)
										<div class="col-lg-6">
											<div class="review_content">
												<div class="clearfix add_bottom_10">
													<h4>{{$review->name}}</h4>
													<h6>{{$review->comment}}</h6>
													<span class="ratings">
														@for($star=1;$star<=$review->star;$star++)
														<i style="color: #ff9800;" class="fa fa-star" aria-hidden="true"></i>
														@endfor
													</span>
													<em>{{$review->created_at}}</em>
												</div>
												<p>{{$review->details}}</p>
											</div>
										</div>
									@endif

								@endforeach


								<div class="col-lg-6">
									<div class="review_content">
										
										
											                            		
										<div class="row">
											<div class="col-12 col-lg-6">
												<label for="name">Name</label>
												<input id="name" type="text" name="name" class="form-control">
											</div>
											<div class="col-12 col-lg-6">
												<label for="order_id">Order ID</label>
												<input id="order_id" type="text" name="order_id" class="form-control">
											</div>
										</div>

										<div class="row my-3">
											<div class="col-12 col-lg-6">
												<label for="comment">Comment</label>
												<select name="comment" id="comment" class="form-control">
													<option value=""></option>
													<option value="Commpletely satisfied">Commpletely satisfied</option>
													<option value="Outstanding">Outstanding</option>
													<option value="Excellent">Excellent</option>
													<option value="Always the best">Always the best</option>
													<option value="Average">Average</option>
												</select>
											</div>
											<div class="col-12 col-lg-6">
												<label for="rating">Rating</label>
												<select name="rating" id="rating" class="form-control">
													<option value=""></option>
													<option value="1">1 Star</option>
													<option value="2">2 Star</option>
													<option value="3">3 Star</option>
													<option value="4">4 Star</option>
													<option value="5">5 Star</option>
												</select>
											</div>
										</div>


	                            		
	                            		<label for="details">Details</label>
	                            		<textarea name="details" class="form-control" id="details" cols="30" rows="3" maxlength="200"></textarea>
										
										<p id="review-message" class="mt-2">
											
										</p>
										<a href="#"  data-id="{{$product->id}}"   id="review-submit" class="btn_1 full-width mt-3">Submit</a>
	                            		{{-- <input class="btn_1 full-width mt-3" type="submit" value="Submit"> --}}
		                            	
									</div>
								</div>
	
							</div>
							<!-- /row -->

							
							
						</div>
						<!-- /card-body -->
					</div>
				</div>
				<!-- /tab B -->
			</div>
			<!-- /tab-content -->
		</div>
		<!-- /container -->
	</div>
	<!-- /tab_content_wrapper -->

	<div class="container margin_60_35">
		<div class="main_title">
			<h2>Related</h2>
			<span>Products</span>
			<p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p>
		</div>


		<div class="row small-gutters">
			<?php $i=0;?>
			@foreach($releted_products as $product)
			<?php 
				$i++;
				if($i==9){
					break;
				}
			?>
			<div class="col-6 col-md-4 col-xl-3">
				<div class="grid_item single-product">
					<figure>
					
						<a href="{{route('website.single_product',['slug' => $product->slug])}}">
							<img class="img-fluid lazy" src="'{{URL::asset('assets/img/products')}}/{{$product->image}}'" data-src="{{URL::asset('assets/img/products/')}}/{{$product->image}}" alt="">
							<img class="img-fluid lazy" src="'{{URL::asset('assets/img/products')}}/{{$product->image}}'" data-src="{{URL::asset('assets/img/products/')}}/{{$product->image}}" alt="">
						</a>
						
					</figure>
					<div class="rating">

						@for($star=1;$star<=$product->rating;$star++)
						<i style="color: #ff9800;" class="fa fa-star" aria-hidden="true"></i>
						@endfor

						@for($star=1;$star<=(5 - $product->rating);$star++)
						<i style="" class="fa fa-star" aria-hidden="true"></i>
						@endfor
						
						
					</div>
					<a href="{{route('website.single_product',['slug' => $product->slug])}}">
						<h3 class="text-capitalize">{{$product->name}}</h3>
					</a>
					<div class="price_box">
						<span class="new_price">৳ {{$product->price}}</span>
						{{-- <span class="old_price">$60.00</span> --}}
					</div>
					
				</div>
				<!-- /grid_item -->
			</div>
			@endforeach
			<!-- /col -->
		</div>
		<!-- /row -->
		
	</div>
	<!-- /container -->

	

</main>
<!-- /main -->
@endsection


@section('footer')
	<script>
		$(document).ready(function(){






			


			 // quantity control
			 $(".dec").click(function(){
			 	var quantity = $("#quantity_1").val();

			 	if(quantity < 1){
			 		$("#quantity_1").val(1)
			 	}
			 }) // end


			 $("#review-submit").click(function(e){
			 

			 	var product_id  = $(this).data('id');

			 	var order_id 	= $("#order_id").val();
			 	var name 		= $("#name").val();
			 	var comment 	= $("#comment").val();
			 	var rating 		= $("#rating").val();
			 	var details 	= $("#details").val();


			 	if(order_id  == ''){
			 		$("#order_id").focus();
			 		return false;
			 	}else if(name == ''){
					$("#name").focus();
					return false;
			 	}else if(comment == ''){
					$("#comment").focus();
					return false;
			 	}else if(rating == ''){
					$("#rating").focus();
					return false;
			 	}else if(details == ''){
					$("#details").focus();
					return false;
			 	}


			 	var review = {
			 		product_id:product_id,
			 		order_id:order_id,
			 		name:name,
			 		comment:comment,
			 		rating:rating,
			 		details:details
			 	};

			 	






			 	$.ajax({

			 	   type:'POST',
			 	   url:'/review-submit',
			 	   data:review,
			 	   success:function(data){
			 	   	

			 	   	if(data.valid_order_customer == '1' && data.review_store == '1'){
			 	   		$("#review-message").html(`
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
							  Your review will show after admin approval.
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>
			 	   		`);


						$("#order_id").val("");
						$("#name").val("");
						$("#comment").val("");
						$("#rating").val("");
						$("#details").val("");


			 	   	}else{
	   		 	   		$("#review-message").html(`
	   						<div class="alert alert-warning alert-dismissible fade show" role="alert">
	   						  Only valid customers can review.
	   						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	   						    <span aria-hidden="true">&times;</span>
	   						  </button>
	   						</div>
	   		 	   		`);
			 	   	}
			 	   
			 	  }, // end success

			 	  statusCode:{
			 	    401: function() {
			 	      window.location.href = "/login";
			 	    },
			 	   
			 	  }

			 	 
			 	});

			 	e.preventDefault();
			 })










		})
	</script>
@endsection