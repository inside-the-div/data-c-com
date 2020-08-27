@extends('admin.layouts.master')

@section('title')
<title>{{$user->name}}</title>
@endsection

@section('custom-css')
	
	<style>
		.permission-title h3{
			font-size: 20px;
			font-weight: bold;
		}
		.title-border{
			border-bottom: 1px solid rgba(0,0,0,0.125);
		}
	</style>
	
@endsection



@section('content')
<!-- page title area  -->
<div class="row">
  <div class="col-12">
      <h1 class="font-pt font-25">Create User</h1>
  </div>
</div>




<form action="{{route('admin.user.update')}}" method="post" id="user_add_form">

	<input type="hidden" name="id" value="{{$user->id}}">
<!-- website info area start  -->
	<div class="row mt-20">
		<div class="col-12 col-lg-6 offset-lg-3 mb-3">
		  <div class="card p-3 rounded-0">
			@csrf

			<label for="title" class="mb-2"><b>Name*</b></label>
			<input value="{{$user->name}}" required  type="text" class="form-control rounded-0 mb-2" name="name">


			<label for="title" class="mb-2"><b>Designation*</b></label>
			<input value="{{$user->designation}}" required  type="text" class="form-control rounded-0 mb-2" name="designation">

			<label for="description" class="mb-2"><b>Description*</b></label>
			<textarea required  maxlength="400"  id="description" cols="30" rows="3" name="description" class="form-control mb-2">{{$user->permission_description}}</textarea>
			<span class="d-block mb-2"><b>Note:</b> A short Description about Designation <b>Max 400 Characters</b>.</span>

			<input @if(in_array('admin.product.edit',$permissions)) checked @endif type="submit" value="Add" class="btn btn-primary rounded-0">
		  </div>
		</div>

		<div class="col-12">
			<h3 class="text-center font-pt font-25">Permissions</h3>
			<hr>
		</div>


		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border" >
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.product.edit',$permissions)) checked @endif type="checkbox"  id="dashboard" name="permission[]" value="admin.home,admin.dashboard" checked >
		   			  <label for="dashboard">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Dashboard</h3>
		   		</div>
		   	</div>
		   </div>
{{-- 
			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input name="permission[]" value="total order" type="checkbox" class="custom-control-input" id="total-order">
				        <label class="custom-control-label font-18 font-pt" for="total-order">Total Order</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input" id="customControlAutosizing" value="admin.info">
				        <label class="custom-control-label font-18 font-pt" for="customControlAutosizing">info of store</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input" id="customControlAutosizing" value="admin.info">
				        <label class="custom-control-label font-18 font-pt" for="customControlAutosizing">info of store</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input" id="customControlAutosizing" value="admin.info">
				        <label class="custom-control-label font-18 font-pt" for="customControlAutosizing">info of store</label>
				     </div>
				</div>

			</div> --}}


		  </div>
		</div>
	
		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border" >
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.products',$permissions)) checked @endif type="checkbox" name="permission[]" id="products"  value="admin.products">
		   			  <label for="products">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Products</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input product-permission" id="product-show" value="admin.product.show">
				        <label class="custom-control-label font-18 font-pt" for="product-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.store',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input product-permission" id="product-store" value="admin.product.store">
				        <label class="custom-control-label font-18 font-pt" for="product-store">Add</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input product-permission" id="product-edit" value="admin.product.edit">
				        <label class="custom-control-label font-18 font-pt" for="product-edit">Edit</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input product-permission" id="product-delete" value="admin.product.delete">
				        <label class="custom-control-label font-18 font-pt" for="product-delete">Delete</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border" >
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.reviews',$permissions)) checked @endif type="checkbox" id="reviews" name="permission[]" value="admin.reviews">
		   			  <label for="reviews">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Review</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.review.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input review-permission" id="review-show" value="admin.review.show">
				        <label class="custom-control-label font-18 font-pt" for="review-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.review.active',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input review-permission" id="review-active" value="admin.review.active">
				        <label class="custom-control-label font-18 font-pt" for="review-active">Active</label>
				     </div>
				</div>

{{-- 				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.product.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input" id="customControlAutosizing">
				        <label class="custom-control-label font-18 font-pt" for="customControlAutosizing">Edit</label>
				     </div>
				</div> --}}
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.review.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input review-permission" id="review-delete" value="admin.review.delete">
				        <label class="custom-control-label font-18 font-pt" for="review-delete">Delete</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>


		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.brands',$permissions)) checked @endif type="checkbox" name="permission[]" id="brands"  value="admin.brands">
		   			  <label for="brands">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Brand</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.brand.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input brand-permission" id="brand-show" value="admin.brand.show">
				        <label class="custom-control-label font-18 font-pt" for="brand-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.brand.store',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input brand-permission" id="brand-add" value="admin.brand.store">
				        <label class="custom-control-label font-18 font-pt" for="brand-add">Add</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.brand.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input brand-permission" id="brand-edit" value="admin.brand.edit">
				        <label class="custom-control-label font-18 font-pt" for="brand-edit">Edit</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.brand.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input brand-permission" id="brand-delete" value="admin.brand.delete">
				        <label class="custom-control-label font-18 font-pt" for="brand-delete">Delete</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.categories',$permissions)) checked @endif type="checkbox" name="permission[]" id="categories"  value="admin.categories">
		   			  <label for="categories">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Category</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.category.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input category-permission" id="category-show" value="admin.category.show">
				        <label class="custom-control-label font-18 font-pt" for="category-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.category.store',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input category-permission" id="category-add" value="admin.category.store">
				        <label class="custom-control-label font-18 font-pt" for="category-add">Add</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.category.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input category-permission" id="category-edit" value="admin.category.edit">
				        <label class="custom-control-label font-18 font-pt" for="category-edit">Edit</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.category.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input category-permission" id="category-delete" value="admin.category.delete">
				        <label class="custom-control-label font-18 font-pt" for="category-delete">Delete</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.sliders',$permissions)) checked @endif type="checkbox" name="permission[]" id="sliders"  value="admin.sliders">
		   			  <label for="sliders">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Slider</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.slider.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input slider-permission" id="slider-show" value="admin.slider.show">
				        <label class="custom-control-label font-18 font-pt" for="slider-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.slider.store',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input slider-permission" id="slider-add"  value="admin.slider.store">
				        <label class="custom-control-label font-18 font-pt" for="slider-add">Add</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.slider.active',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input slider-permission" id="slider-edit" value="admin.slider.active">
				        <label class="custom-control-label font-18 font-pt" for="slider-edit">Active</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.slider.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input slider-permission" id="slider-delete" value="admin.slider.delete">
				        <label class="custom-control-label font-18 font-pt" for="slider-delete">Delete</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>


		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.faqs',$permissions)) checked @endif type="checkbox"  id="faqs" name="permission[]" value="admin.faqs">
		   			  <label for="faqs">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Faq</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.faq.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input faq-permission" id="faq-show" value="admin.faq.show">
				        <label class="custom-control-label font-18 font-pt" for="faq-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.faq.store',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input faq-permission" id="faq-add" value="admin.faq.store">
				        <label class="custom-control-label font-18 font-pt" for="faq-add">Add</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.faq.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input faq-permission" id="faq-edit" value="admin.faq.edit">
				        <label class="custom-control-label font-18 font-pt" for="faq-edit">Edit</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.faq.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input faq-permission" id="faq-delete" value="admin.faq.delete">
				        <label class="custom-control-label font-18 font-pt" for="faq-delete">Delete</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>		

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.coupons',$permissions)) checked @endif type="checkbox" name="permission[]" id="coupons"  value="admin.coupons">
		   			  <label for="coupons">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Coupons</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.coupon.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input coupon-permission" id="coupon-show" value="admin.coupon.show">
				        <label class="custom-control-label font-18 font-pt" for="coupon-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.coupon.store',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input coupon-permission" id="coupon-store" value="admin.coupon.store">
				        <label class="custom-control-label font-18 font-pt" for="coupon-store">Add</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.coupon.edit',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input coupon-permission" id="coupon-edit" value="admin.coupon.edit">
				        <label class="custom-control-label font-18 font-pt" for="coupon-edit">Edit</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.coupon.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input coupon-permission" id="coupon-delete" value="admin.coupon.delete">
				        <label class="custom-control-label font-18 font-pt" for="coupon-delete">Delete</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.orders',$permissions)) checked @endif type="checkbox" name="permission[]" id="orders" name="permission[]" value="admin.orders">
		   			  <label for="orders">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Order</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.order.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input order-permission" id="order-show" value="admin.order.show">
				        <label class="custom-control-label font-18 font-pt" for="order-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.order.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input order-permission" id="order-edit" value="admin.order.update">
				        <label class="custom-control-label font-18 font-pt" for="order-edit">Update</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.order.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input order-permission" id="order-delete" value="admin.order.delete">
				        <label class="custom-control-label font-18 font-pt" for="order-delete">Delete</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.order.invoice',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input order-permission" id="order-invoice" value="admin.order.invoice
				        ">
				        <label class="custom-control-label font-18 font-pt" for="order-invoice">Invoice</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.customers',$permissions)) checked @endif type="checkbox" name="permission[]" id="customers"  value="admin.customers">
		   			  <label for="customers">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Customer</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.customer.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input customer-permission" id="user-show" value="admin.customer.show">
				        <label class="custom-control-label font-18 font-pt" for="user-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.customer.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input customer-permission" id="user-delete" value="admin.customer.delete">
				        <label class="custom-control-label font-18 font-pt" for="user-delete">Delete</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.customer.download',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input customer-permission" id="user-download" value="admin.customer.download">
				        <label class="custom-control-label font-18 font-pt" for="user-download">Download</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>



		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.reports',$permissions)) checked @endif type="checkbox" name="permission[]" id="reports"  value="admin.reports">
		   			  <label for="reports">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Report</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.report.order',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input report-permission" id="order-report" value="admin.report.order">
				        <label class="custom-control-label font-18 font-pt" for="order-report">Order</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.report.sell',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input report-permission" id="sells-report" value="admin.report.sell">
				        <label class="custom-control-label font-18 font-pt" for="sells-report">Sells</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.report.customer',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input report-permission" id="customer-report" value="admin.report.customer">
				        <label class="custom-control-label font-18 font-pt" for="customer-report">Customers</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.report.product',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input report-permission" id="product-repost" value="admin.report.product">
				        <label class="custom-control-label font-18 font-pt" for="product-repost">Products</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.pages',$permissions)) checked @endif type="checkbox" name="permission[]" id="pages"  value="admin.pages">
		   			  <label for="pages">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Pages</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.about.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input page-permission" id="about" value="admin.about.update">
				        <label class="custom-control-label font-18 font-pt" for="about">About</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.privacy.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input page-permission" id="privacy" value="admin.privacy.update">
				        <label class="custom-control-label font-18 font-pt" for="privacy">Privacy</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.condition.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input page-permission" id="condition" value="admin.condition.update">
				        <label class="custom-control-label font-18 font-pt" for="condition">Terms And Condition</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.contact.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input page-permission" id="contact" value="admin.contact.update">
				        <label class="custom-control-label font-18 font-pt" for="contact">Contact</label>
				     </div>
				</div>

			</div>


		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.emails',$permissions)) checked @endif type="checkbox" name="permission[]" id="emails"  value="admin.emails">
		   			  <label for="emails">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Email</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.email.show',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input email-permission" id="email-show" value="admin.email.show">
				        <label class="custom-control-label font-18 font-pt" for="email-show">Show</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.email.send',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input email-permission" id="email-send" value="admin.email.send">
				        <label class="custom-control-label font-18 font-pt" for="email-send">Send</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.email.delete',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input email-permission" id="email-delete" value="admin.email.delete">
				        <label class="custom-control-label font-18 font-pt" for="email-delete">Delete</label>
				     </div>
				</div>
			</div>
		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.banner',$permissions)) checked @endif type="checkbox" name="permission[]" id="banners" value="admin.banner">
		   			  <label for="banners">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Banner</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.banner.update',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input banner-permission" id="banner-update" value="admin.banner.update">
				        <label class="custom-control-label font-18 font-pt" for="banner-update">Update</label>
				     </div>
				</div>

			</div>
		  </div>
		</div>


		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.data',$permissions)) checked @endif type="checkbox" name="permission[]" id="datas"  value="admin.data">
		   			  <label for="datas">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Data</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.data.sells',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input data-permission" id="data-sells" value="admin.data.sells,admin.data.sells.download">
				        <label class="custom-control-label font-18 font-pt" for="data-sells">Sells</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.data.products',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input data-permission" id="data-products" value="admin.data.products,admin.data.products.download">
				        <label class="custom-control-label font-18 font-pt" for="data-products">Products</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.data.orders',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input data-permission" id="data-order" value="admin.data.orders,admin.data.orders.download">
				        <label class="custom-control-label font-18 font-pt" for="data-order">Order</label>
				     </div>
				</div>
			</div>

		  </div>
		</div>

		<div class="col-12 col-lg-4 mb-2">
		  <div class="card p-3 rounded-0">

		   <div class="permission-title title-border">
		   	<div class="row">
		   		<div class="col-12 col-lg-6">
		   			<div class="toggleCheck chk3 d-inline">
		   			  <input @if(in_array('admin.settings',$permissions)) checked @endif type="checkbox" name="permission[]" id="settings"  value="admin.settings">
		   			  <label for="settings">
		   			    <div class="toggleCheck_switch" data-checked="Yes" data-unchecked="No"></div>
		   			  </label>
		   			</div>
		   		</div>
		   		<div class="col-12 col-lg-6">
		   			<h3>Settings</h3>
		   		</div>
		   	</div>
		   </div>

			<div class="row mt-3">
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.settings.website',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input setting-permission" id="website-sttings" value="admin.settings.website">
				        <label class="custom-control-label font-18 font-pt" for="website-sttings">Website Settings</label>
				     </div>
				</div>
				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.settings.ecommerce',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input setting-permission" id="ecommerce-settings" value="admin.settings.ecommerce" >
				        <label class="custom-control-label font-18 font-pt" for="ecommerce-settings">E-Commerce Settings</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.ecommerce.payment',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input setting-permission" id="ecpmmerce-payment" value="admin.ecommerce.payment">
				        <label class="custom-control-label font-18 font-pt" for="ecpmmerce-payment">Payment Settings</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.settings.homepage',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input setting-permission" id="home-page-settings" value="admin.settings.homepage">
				        <label class="custom-control-label font-18 font-pt" for="home-page-settings">Home Page Settings</label>
				     </div>
				</div>

				<div class="col-6 mb-2">
					<div class="custom-control custom-checkbox mr-sm-2">
				        <input @if(in_array('admin.settings.email',$permissions)) checked @endif type="checkbox" name="permission[]" class="custom-control-input setting-permission" id="email-settings" value="admin.settings.email">
				        <label class="custom-control-label font-18 font-pt" for="email-settings">Email Settings</label>
				     </div>
				</div>
			</div>
		  </div>
		</div>
	</div>
  </form>
@endsection



@section('footer-section')
	<script>
		$(document).ready(function(){


			$("#products").click(function(){
				all_seletce_unselect("product-permission",'products');
			})
			$("#reviews").click(function(){
				all_seletce_unselect("review-permission",'reviews');
			})
			$("#brands").click(function(){
				all_seletce_unselect("brand-permission",'brands');
			})
			$("#categories").click(function(){
				all_seletce_unselect("category-permission",'categories');
			})
			$("#sliders").click(function(){
				all_seletce_unselect("slider-permission",'sliders');
			})
			$("#faqs").click(function(){
				all_seletce_unselect("faq-permission",'faqs');
			})
			$("#coupons").click(function(){
				all_seletce_unselect("coupon-permission",'coupons');
			})
			$("#orders").click(function(){
				all_seletce_unselect("order-permission",'orders');
			})
			$("#customers").click(function(){
				all_seletce_unselect("customer-permission",'customers');
			})
			$("#reports").click(function(){
				all_seletce_unselect("report-permission",'reports');
			})
			$("#pages").click(function(){
				all_seletce_unselect("page-permission",'pages');
			})
			$("#emails").click(function(){
				all_seletce_unselect("email-permission",'emails');
			})
			$("#banners").click(function(){
				all_seletce_unselect("banner-permission",'banners');
			})
			$("#datas").click(function(){
				all_seletce_unselect("data-permission",'datas');
			})
			$("#settings").click(function(){
				all_seletce_unselect("setting-permission",'settings');
			})


















			$(".product-permission").click(function(){
				premissionCheckedUnchecked("product-permission","products");
			})
			$(".review-permission").click(function(){
				premissionCheckedUnchecked("review-permission","reviews");
			})

			$(".brand-permission").click(function(){
				premissionCheckedUnchecked("brand-permission","brands");
			})			

			$(".category-permission").click(function(){
				premissionCheckedUnchecked("category-permission","categories");
			})

			$(".slider-permission").click(function(){
				premissionCheckedUnchecked("slider-permission","sliders");
			})

			$(".faq-permission").click(function(){
				premissionCheckedUnchecked("faq-permission","faqs");
			})

			$(".coupon-permission").click(function(){
				premissionCheckedUnchecked("coupon-permission","coupons");
			})


			$(".order-permission").click(function(){
				premissionCheckedUnchecked("order-permission","orders");
			})

			$(".customer-permission").click(function(){
				premissionCheckedUnchecked("customer-permission","customers");
			})

			$(".report-permission").click(function(){
				premissionCheckedUnchecked("report-permission","reports");
			})

			$(".page-permission").click(function(){
				premissionCheckedUnchecked("page-permission","pages");
			})

			$(".email-permission").click(function(){
				premissionCheckedUnchecked("email-permission","emails");
			})

			$(".banner-permission").click(function(){
				premissionCheckedUnchecked("banner-permission","banners");
			})


			$(".data-permission").click(function(){
				premissionCheckedUnchecked("data-permission","datas");
			})

			$(".setting-permission").click(function(){
				premissionCheckedUnchecked("setting-permission","settings");
			})

		})



		// doc 

		function premissionCheckedUnchecked(all_premission,main_premission){
			var all = $("."+all_premission);
			for(var i=0; i< all.length; i++){
				if($(all[i]).prop('checked') == true){
					$("#"+main_premission).prop('checked',true);
					break;
				}else{
					$("#"+main_premission).prop('checked',false);
				}
			}
		}



		function all_seletce_unselect(all_premission,main_premission){

			if($("#"+main_premission).prop('checked') == true){
				$("."+all_premission).prop('checked',true);
			}else{
				$("."+all_premission).prop('checked',false);
			}
		}



		
	</script>
@endsection