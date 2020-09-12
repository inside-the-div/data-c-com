@extends('admin.layouts.master')



@section('content')
	<form action="{{route('admin.coupon.update')}}" method="POST">
		@csrf
		<input type="hidden" name="id" value="{{$coupon->id}}">
		<div class="row">
			<div class="col-12 col-lg-4">
				<div class="card p-3">
					<h1 class="font-pt font-25">Add New Coupon</h1>
					<hr>

					<label for="code"><b>Code*</b></label>
					<input value="{{$coupon->code}}" required type="text" name="code" id="code" class="form-control mb-2">

					<div class="row mb-2">
						<div class="col-12 col-lg-6">
							<label for="start_time"><b>Start Time *</b></label>
							<input  value="{{$coupon->start_time}}" required type="date" class="form-control" name="start_time" id="start_time">
						</div>
						<div class="col-12 col-lg-6">
							<label for="end_time"><b>End Time *</b></label>
							<input  value="{{$coupon->end_time}}" required type="date" class="form-control" name="end_time" id="end_time">
						</div>
					</div>

					<fieldset class="border p-3 mb-3">
					    <label class="font-16"><b>Type*</b></label>

						<?php 
							// row php for coupon type
							$types = ['Selected Products','Order','Return Customer','All Customer'];
							for($i=0; $i<4; $i++){
								if($types[$i] == $coupon->type){
									echo '
										<div class="custom-control custom-radio my-1 mr-sm-2">
										  <input checked value="'.$types[$i].'"  required name="coupon_type" type="radio" class="custom-control-input" id="type-'.$i.'">
										  <label class="custom-control-label" for="type-'.$i.'">'.$types[$i].'</label>
										</div>
									';
								}else{
									echo '
										<div class="custom-control custom-radio my-1 mr-sm-2">
										  <input value="'.$types[$i].'"  required name="coupon_type" type="radio" class="custom-control-input" id="type-'.$i.'">
										  <label class="custom-control-label" for="type-'.$i.'">'.$types[$i].'</label>
										</div>
									';
								}
							}

						?>		
					   

					   
					    
					</fieldset>

					<div class="row mb-2">
						<div class="col-12 col-lg-8">
							<label for="discount"><b>Discount*</b></label>
							<input required style="height: 40px;"  value="{{$coupon->discount}}" type="number" step="any" class="form-control" name="discount" id="discount">
						</div>

						<div class="col-12 col-lg-4">
							<label for="discount_type"><b>Discount Type*</b></label>
							<select style="height: 40px;"   required name="discount_type" id="discount_type" class="form-control">
								<option value="{{$coupon->discount_type}}">{{$coupon->discount_type}}</option>
								<option value="Tk">Tk</option>
								<option value="Percentage">Percentage</option>
							</select>
						</div>


					</div>




					<label for="description"><b>Description</b></label>
					<textarea class="form-control" name="description" id="description" cols="30" rows="3">{{$coupon->description}}</textarea>
					
					<input type="submit" name="submit" value="Update" class="mt-3">
				</div>
			</div>

			<div  class="col-12 col-lg-8 table-responsive" >
				<div class="card p-3" id="selected_products_area">
					<h2 class="font-25 font-pt">Select Products <span id="total_selected_products" data-selectproduct="{{$products->count()}}" class="badge">{{$products->count()}}</span></h2>
					
					<hr>


					<div class="table-overflow" style="max-height: 800px; overflow: scroll;">
						<table class="table table-bordered custom-data-table">
						  <thead>
						    <tr align="center">
						      <th>Select</th>
						      <th>Name</th>
						      <th>Code</th>
						      <th>Stock</th>
						      <th>Price</th>
						      <th>Discount</th>
						      <th>Image</th>
						    </tr>
						  </thead>
						  <tbody>
							
						  	@foreach($all_products as $product)
						    <tr>

							 @if(in_array($product->id,$products_id_arra))
							      <th>
							      	<div class="custom-control custom-checkbox my-1 mr-sm-2">
							      	  <input checked value="{{$product->id}}"   name="selected_products[]" type="checkbox" class="custom-control-input" id="product-{{$product->id}}">
							      	  <label class="custom-control-label" for="product-{{$product->id}}"></label>
							      	</div>
							      </th>
						      @else
								 
								 <th>
								 	<div class="custom-control custom-checkbox my-1 mr-sm-2">
								 	  <input  value="{{$product->id}}"   name="selected_products[]" type="checkbox" class="custom-control-input" id="product-{{$product->id}}">
								 	  <label class="custom-control-label" for="product-{{$product->id}}"></label>
								 	</div>
								 </th>

						      @endif



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

				<div id="min_cost_area" class="card p-3">
					<label for="min_cost"><b><b>Minimum Cost*</b></b></label>
					<input type="number" step="any" class="form-control" name="min_cost" id="min_cost">
				</div>
			</div> 

			
		</div>
	</form>
@endsection







@section('footer-section')

	<script>

		
		
		$(document).ready(function(){


			var selected_products = $("input[name=coupon_type]").eq(0).prop('checked');

			if(selected_products != true){
				$("#selected_products_area").hide();
			}

			var order = $("input[name=coupon_type]").eq(1).prop('checked');
			if(order != true){
				$("#min_cost_area").hide();
			}

			  
			$("input[name=coupon_type]").click(function(){

				coupon_type = $(this).val();
				if(coupon_type == 'Selected Products'){
					$("#selected_products_area").fadeIn('slow');
				}else{
					$("#selected_products_area").fadeOut('slow');
				}

				if(coupon_type == "Order"){
					$("#min_cost_area").fadeIn('slow');
					$("#min_cost").attr('required',true);
					$("#min_cost").focus();
				}else{
					$("#min_cost_area").fadeOut('slow');
					$("#min_cost").removeAttr('required');
				}
				
			})

			$("input[type=checkbox]").click(function(){
				var val = $(this).prop('checked');
				var total = Number($("#total_selected_products").attr("data-selectproduct"));
				if(val == true){
					total++;
				}else{
					total--;
				}

				$("#total_selected_products").html(total);
				$("#total_selected_products").attr("data-selectproduct",total);
				
			})




		

			$("input[type=submit]").click(function(){

				// var coupon_type  = $("input[name=coupon_type]").prop('checked');
				
				var total = Number($("#total_selected_products").attr("data-selectproduct"));

				var selected_products = $("input[name=coupon_type]").eq(0).prop('checked');
				if(selected_products && total <= 0){
					toastr.error("Please Select Products");
					return false;
				}
				
			})


		})
	</script>
	  

@endsection