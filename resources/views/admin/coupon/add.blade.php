@extends('admin.layouts.master')



@section('content')
	<form action="{{route('admin.coupon.store')}}" method="POST">
		@csrf
		<div class="row">
			<div class="col-12 col-lg-4">
				<div class="card p-3">
					<h1 class="font-pt font-25">Add New Coupon</h1>
					<hr>

					<label for="code"><b>Code*</b></label>
					<input required type="text" name="code" id="code" class="form-control mb-2">

					<div class="row mb-2">
						<div class="col-12 col-lg-6">
							<label for="start_time"><b>Start Time *</b></label>
							<input required type="date" class="form-control" name="start_time" id="start_time">
						</div>
						<div class="col-12 col-lg-6">
							<label for="end_time"><b>End Time *</b></label>
							<input required type="date" class="form-control" name="end_time" id="end_time">
						</div>
					</div>

					<fieldset class="border p-3 mb-3">
					    <label class="font-16"><b>Type*</b></label>

					    <div class="custom-control custom-radio my-1 mr-sm-2">
					      <input value="Selected Products"  required name="coupon_type" type="radio" class="custom-control-input" id="type-1">
					      <label class="custom-control-label" for="type-1">Selected Products</label>
					    </div>

					    <div class="custom-control custom-radio my-1 mr-sm-2">
					      <input value="Order" required name="coupon_type" type="radio" class="custom-control-input" id="type-2">
					      <label class="custom-control-label" for="type-2">Order</label>
					    </div>

					    <div class="custom-control custom-radio my-1 mr-sm-2">
					      <input value="Return Customer" required name="coupon_type" type="radio" class="custom-control-input" id="type-3">
					      <label  class="custom-control-label" for="type-3">Return Customer</label>
					    </div>

					    <div class="custom-control custom-radio my-1 mr-sm-2">
					      <input value="All Customer" required name="coupon_type" type="radio" class="custom-control-input" id="type-4">
					      <label class="custom-control-label" for="type-4">All Customer</label>
					    </div>

					    
					</fieldset>

					<div class="row mb-2">
						<div class="col-12 col-lg-8">
							<label for="discount"><b>Discount*</b></label>
							<input required style="height: 40px;" type="number" step="any" class="form-control" name="discount" id="discount">
						</div>

						<div class="col-12 col-lg-4">
							<label for="discount_type"><b>Discount Type*</b></label>
							<select style="height: 40px;" required name="discount_type" id="discount_type" class="form-control">
								<option value=""></option>
								<option value="Tk">Tk</option>
								<option value="Percentage">Percentage</option>
							</select>
						</div>


					</div>




					<label for="description"><b>Description</b></label>
					<textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
					
					<input type="submit" name="submit" value="Add" class="mt-3">
				</div>
			</div>

			<div  class="col-12 col-lg-8 table-responsive" >
				<div class="card p-3" id="selected_products_area">
					<h2 class="font-25 font-pt">Select Products <span id="total_selected_products" data-selectproduct="0" class="badge">0</span></h2>
					
					<hr>


					<div class="table-overflow " style="max-height: 800px; overflow: scroll;">
						<table class="table table-bordered custom-data-table">
						  <thead>
						    <tr>
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
							
						  	@foreach($products as $product)
						    <tr>
						      <th>
						      	<div class="custom-control custom-checkbox my-1 mr-sm-2">
						      	  <input  value="{{$product->id}}"   name="selected_products[]" type="checkbox" class="custom-control-input" id="product-{{$product->id}}">
						      	  <label class="custom-control-label" for="product-{{$product->id}}"></label>
						      	</div>
						      </th>
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

		$("#selected_products_area").hide();
		$("#min_cost_area").hide();
		$(document).ready(function(){
			  
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