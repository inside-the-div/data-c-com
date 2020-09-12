@extends('admin.layouts.master')


@section('title')
<title>Single New Order</title>
@endsection

@section('custom-css')
	<style>
		h1{

		}
	</style>
@endsection


@section('content')

	
	<div class="row">
		<div class="col-12 col-lg-6">
			<div class="card p-3">
				<h1 class="font-pt font-25 text-center">{{$brand->name}}</h1>
				<hr>
				<div class="row">
					<div class="col-12 col-lg-8">
						<dl class="row">
						  <dt class="col-sm-4 font-18 font-pt">Name:</dt>
						  <dd class="col-sm-8 font-18 font-pt">{{$brand->name}}</dd>

						  <dt class="col-sm-4 font-18 font-pt">Total Products:</dt>
						  <dd class="col-sm-8 font-18 font-pt">
						    {{$brand->products->count()}}
						  </dd>

						  <dt class="col-sm-4 font-18 font-pt">Added By:</dt>
						  <dd class="col-sm-8 font-18 font-pt">
						  	<a href="">{{$brand->user->name}}</a>
						  </dd>
						</dl>
						<hr class="my-1">
						<h3 class="font-pt font-20">SEO Factors</h3>
						<hr class="my-1">
						<p class="font-pt font-16"><b>Description: </b>{{$brand->description}}</p>
						<p class="font-pt font-16"><b>Tag: </b>{{$brand->tag}}</p>
					</div>
					<div class="col-12 col-lg-4">
						<img class="img-fluid" src="{{Storage::url($brand->image)}}" alt="">
					</div>
				</div>
			</div>
		</div>

		   <div class="col-12 col-lg-6">

		    
		     <div class="card p-3 rounded-0 table-responsive">

		     <table class="table table-striped table-white display " id="dataTable">
		       <thead>
		         <tr>
		           <th scope="col">No</th>
		           <th scope="col">Name</th>
		           <th scope="col">Image</th>
		           <th scope="col">Code</th>
		           <th scope="col">Stock</th>
		         </tr>
		       </thead>
		      <tbody>
				@php 
					$i= 0;
				@endphp
				@foreach($brand->products as $product)
					@php 
						$i++;
					@endphp
		         <tr   

		            @if($product->stock < 1) title="Out Of Stock" style="background: #ff000029;" 
		            @elseif($product->stock < 10) title="Low Stock" style="background: #93521463;" @endif

		          >
		           <th class="font-pt font-18" >{{$i}}</th>
		           <td class="font-pt font-18">{{$product->name}}</td>
		           <td class="font-pt font-18"><img width="40px" class="" src="{{Storage::url($product->image)}}" alt=""></td>
		           <td><a href="" class="text-light font-pt font-18">{{$product->code}}</a></td>

		           <td 
		              @if($product->stock < 1) style="background: #ff00008f;" 
		              @elseif($product->stock < 10) style="background: #ff98006b;" @endif

		           >

		              <a href="" class="text-light font-pt font-18">{{$product->stock}}</a>

		           </td>
		         </tr>
		       @endforeach
		       </tbody> 

		     </table>
		     </div>
		   </div>




	</div>







@endsection