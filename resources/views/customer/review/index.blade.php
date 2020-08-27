@extends('customer.layouts.master')

@section('title')
<title>{{Auth::user()->name}}</title>
@endsection



@section('content')
	
	<div class="row pb-3">
	  <div class="col-12 ">
	    <div class="text-right">
	   
	    <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

	    </div>
	  </div>
	</div>

	<div class="row" >
		<div class="col-12 col-lg-6" style="max-height: 700px; overflow-y: scroll;">
			<div class="card p-3">
				<h1 class="font-pt font-25">Approved ({{$confirm_review}})</h1>
				<hr>

				<ol>
				  @foreach($reviews as $review)
				  	@if($review->active == 1)
				    <li class="p-2  mb-1  bg-info text-dark ">
				      <b>Name: </b>{{$review->user->name}} <br>
				      <b>Comment: </b>{{$review->comment}} <br>
				      <b>Details: </b>{{$review->details}} <br>
				      <b>Star: </b>{{$review->star}}<br>
				      
				      <b>Product:<a target="_blank" class="text-dark"  href="{{route('website.single_product',['slug' => $review->product->slug])}}">{{$review->product->name}}</a></b> 
				  	</li>
				  	@endif
				  @endforeach
				</ol>

			</div>
		</div>
		<div class="col-12 col-lg-6" style="max-height: 700px; overflow-y: scroll;">
			<div class="card p-3">
				<h1 class="font-pt font-25">Disapproved ({{$pending_review}})</h1>
				<hr>
				<ol>
				  @foreach($reviews as $review)
				  	@if($review->active == 0)
				    <li class="p-2  mb-1  bg-warning text-dark ">
				      <b>Name: </b>{{$review->user->name}} <br>
				      <b>Comment: </b>{{$review->comment}} <br>
				      <b>Details: </b>{{$review->details}} <br>
				      <b>Star: </b>{{$review->star}}  <br>

				      <b>Product: <a target="_blank" class="text-dark" href="{{route('website.single_product',['slug' => $review->product->slug])}}">{{$review->product->name}}</a></b>
				  	</li>
				  	@endif
				  @endforeach
				</ol>
			</div>
		</div>
	</div>

	
	

@endsection


















