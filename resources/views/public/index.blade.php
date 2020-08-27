@extends('public.layouts.master')

@section('seo')
@endsection

@section('title')
@endsection

@section('header')
<style>
	.bg-added{
		background: #00cc00 !important;
		    color: #fff !important;
	}
</style>
@endsection

{{-- main content --}}
@section('content')
	<div class="container margin_60_35">

		<div class="main_title text-left">
			<h2 class="section_title" style="font-size: 25px;">Categories</h2>
		</div>

		<div class="row small-gutters">

			@foreach($categories as $category)
			<div class="col-4 col-md-3 col-lg-2 single-category">
				<a href="{{route('website.single_category',['slug' => $category->slug ])}}">
					<div  class="card" >
						<img class="img-fluid" src="{{URL::asset('/assets/img/category')}}/{{$category->image}}" alt="">
						<div class="category-details">
							<div class="text-center">
								<p class="name">{{$category->name}}</p> 
								<p class="total">{{$category->products->count()}} Products</p> 
							</div>
						</div>
						
					</div>
				</a>
				
			</div>
			@endforeach
		</div>





		<div class="main_title text-left mt-5">
			<h2 class="section_title" style="font-size: 25px;">Our Products</h2>
		</div>
		<div class="row small-gutters">
			@foreach($products as $product)
			<div class="col-6 col-md-4 col-xl-3">
				<div class="grid_item single-product">
					<figure>
						@if($product->tag_line == 'hot')
						<span class="ribbon hot">Hot</span>
						@elseif($product->tag_line == 'new')

						<span class="ribbon new">New</span>

						@elseif($product->tag_line == 'off')
						<span class="ribbon off">-{{$product->discount}}%</span>
						@endif
						
						<a href="{{route('website.single_product',['slug' => $product->slug])}}">
							<img class="img-fluid lazy" src="{{URL::asset('assets/img/products')}}/{{$product->image}}" data-src="{{URL::asset('assets/img/products/')}}/{{$product->image}}" alt="">
							<img class="img-fluid lazy" src="{{URL::asset('assets/img/products')}}/{{$product->image}}" data-src="{{URL::asset('assets/img/products/')}}/{{$product->image}}" alt="">
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
					<ul>
						<li><a href="#" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Add to favorites"><i class="ti-heart"></i><span>Add to favorites</span></a></li>
						<li class="add-to-cart-btn  
							@if(array_key_exists($product->code,Session::get('cart-products')))
								already-added-btns
							@endif
						" 

							@if(array_key_exists($product->code,Session::get('cart-products')))
								data-added="1"
							@else
								data-added="0"
							@endif
							
							data-id="{{$product->id}}" 
							data-price="{{$product->price}}"
							data-name="{{$product->name}}"
							data-quantity="1"
							data-image="{{$product->image}}"
							data-code="{{$product->code}}"
							data-slug="{{$product->slug}}"

						>
							<a 
								class="tooltip-1 add-to-cart-a
									
									@if(array_key_exists($product->code,Session::get('cart-products')))
										bg-added
									@endif
			
								" 

								data-toggle="tooltip" data-placement="left" title="
								@if(array_key_exists($product->code,Session::get('cart-products')))
									Already Added
								@else
									Add to cart
								@endif
								">
								<i class="ti-shopping-cart"></i>
								<span>
									

									@if(array_key_exists($product->code,Session::get('cart-products')))
										Already Added
									@else
										Add to cart
									@endif

								</span>
							</a>
						</li>
					</ul>
				</div>
				<!-- /grid_item -->
			</div>
			@endforeach
			<!-- /col -->
		</div>
		<!-- /row -->

		<div class="">
			{{ $products->links() }}
		</div>

	</div>
@endsection
{{-- end main content --}}

@section('footer')
	<script>
		$(document).ready(function(){
			$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			})
		})
	</script>
@endsection
