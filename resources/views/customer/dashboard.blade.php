@extends('customer.layouts.master')



@section('title')
<title>{{Auth::user()->name}}</title>
@endsection


@section('content')
<!-- page title area  -->

<div class="row">

	<div class="col-12 col-lx-3 col-lg-3 mb-5">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Total Orders</h3>
			<span class="number">{{$data['total_order']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-5">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Complete Order</h3>
			<span class="number">{{$data['complete_order']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-5">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Pending Order</h3>
			<span class="number">{{$data['pending_order']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-5">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Confirm Orders</h3>
			<span class="number">{{$data['confirm_order']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-5">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Total Reviews</h3>
			<span class="number">{{$data['total_reviews']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-5">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Pending Reviews</h3>
			<span class="number">{{$data['pending_review']}}</span>
		</div>
	</div>

	<div class="col-12 col-lx-3 col-lg-3 mb-5">
		<div class="dashboard-card rounded-0 d-color-1">
			<h3 class="card-title font-pt">Confirm Reviews</h3>
			<span class="number">{{$data['confirm_review']}}</span>
		</div>
	</div>

</div>











@endsection