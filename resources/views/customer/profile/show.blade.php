@extends('customer.layouts.master')

@section('title')
<title>{{Auth::user()->name}}</title>
@endsection



@section('content')
	
	<div class="row pb-3">
	  <div class="col-12 ">
	    <div class="text-right">
	    <a data-toggle="tooltip" data-placement="top" title="Edit Profile" href="{{route('customer.profile.edit')}}" class="btn btn-info"><i class="fa fa-edit" aria-hidden="true"></i></a>
	    <a data-toggle="tooltip" data-placement="top" title="Back" href="{{ url()->previous() }}" class="btn btn-primary"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>

	    </div>
	  </div>
	</div>

	
	<div class="row">
		<div class="col-12 col-lg-6">
			<div class="card p-3">
				<h1 class="font-pt font-25 text-center">Information</h1>
				<hr>

				<div class="row">
					<div class="col-12 col-lg-3">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste aut corporis ut non, distinctio consectetur voluptates veritatis. Quaerat, autem rerum.
					</div>
					<div class="col-12 col-lg-9">
						<ul>
							<li><b>Designation:</b> {{Auth::user()->designation}}</li>
							<li><b>Name:</b> {{Auth::user()->name}}</li>
							<li><b>Email:</b> {{Auth::user()->email}}</li>
							<li><b>Phone:</b> {{Auth::user()->phone}}</li>
							<li><b>Website:</b> {{Auth::user()->website}}</li>
							<li><b>Address:</b> {{Auth::user()->address}}</li>
						</ul>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-12">
						<h2 class="font-pt font-18 text-center">About</h2>
						<hr>
						<p>{{Auth::user()->about}}</p>
					</div>
				</div>
			</div>
		</div>
		
	</div>

@endsection


















