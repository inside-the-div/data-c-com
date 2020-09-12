@extends('admin.layouts.master')



@section('title')
<title>Single New Order</title>
@endsection


@section('content')
<!-- page title area  -->
	<div class="row">

	  <div class="col-12 ">
	  	<div class="text-right">
	  		<a  href="{{ URL::previous() }}" class="btn_1 font-20 font-pt mx-2"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Back </a>
	  	</div>
	  </div>
	</div>


	<div class="row">
		<div class="col-12 col-lg-6 offset-lg-3">
			<div class="card p-3">
				<div class="accordion" id="accordionExample">
				  <div class="card">
				    <div class="card-header" id="headingOne">
				      <h2 class="mb-0">
				        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          {{$faq->question}}
				        </button>
				      </h2>
				    </div>

				    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				      <div class="card-body">
				        {{$faq->ans}}
				      </div>
				    </div>
				  </div>
	
				</div>
			</div>
		</div>
	</div>





@endsection