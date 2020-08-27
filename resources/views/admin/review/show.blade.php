@extends('admin.layouts.master')



@section('title')
<title>Single New Order</title>
@endsection


@section('content')



<div class="row">
	<div class="col-12 col-lg-4">
		<div class="card p-3">
			<h4 class="text-center">Review</h4>
			<hr>
			<p class="font-pt font-17">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam officia doloribus possimus aliquam rem, praesentium omnis quo explicabo dolore assumenda sed expedita vel sequi debitis, reiciendis ipsam optio, aperiam eaque?
			</p>
			<p class="mt-2 font-17">
				<b>Star:</b> 
				<i class="fa fa-star font-16 star-color" aria-hidden="true"></i>
				<i class="fa fa-star font-16 star-color" aria-hidden="true"></i>
				<i class="fa fa-star font-16 star-color" aria-hidden="true"></i>
				<i class="fa fa-star font-16 star-color" aria-hidden="true"></i>
				<i class="fa fa-star font-16 star-color" aria-hidden="true"></i>

				&nbsp;&nbsp;&nbsp;
				
				<b>Date:</b>
				date

			</p>
		</div>
	</div>
	<div class="col-12 col-lg-4">
		<div class="card p-3">
			<h4 class="text-center">Products</h4>
			<hr>
			<dl class="row mb-2">
			  <dt class="col-sm-3">Name:</dt>
			  <dd class="col-sm-9">----------</dd>
			  <dt class="col-sm-3">Current Stock:</dt>
			  <dd class="col-sm-9">----------</dd>
			  <dt class="col-sm-3">Current Price:</dt>
			  <dd class="col-sm-9">----------</dd>
			  <dt class="col-sm-3">Total Review:</dt>
			  <dd class="col-sm-9">----------</dd>
			  <dt class="col-sm-3">Total Star:</dt>
			  <dd class="col-sm-9">----------</dd>
			</dl>
			<img src="" class="img-fluid" alt="">
		</div>
	</div>

	<div class="col-12 col-lg-4">
		<div class="card p-3">
			<h4 class="text-center">Reviewer | Customer</h4>
			<hr>
			<dl class="row mb-2">
			  <dt class="col-sm-3">Name:</dt>
			  <dd class="col-sm-9">----------</dd>
			  <dt class="col-sm-3">Phone Number:</dt>
			  <dd class="col-sm-9">----------</dd>
			  <dt class="col-sm-3">Total Order:</dt>
			  <dd class="col-sm-9">----------</dd>
			  <dt class="col-sm-3">Total Review:</dt>
			  <dd class="col-sm-9">----------</dd>
			  <dt class="col-sm-3">Total Star:</dt>
			  <dd class="col-sm-9">----------</dd>
			</dl>
			<img src="" class="img-fluid" alt="">
		</div>
	</div>

</div>





@endsection