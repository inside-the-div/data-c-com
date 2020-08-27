@extends('customer.layouts.master')

@section('title')
<title>{{Auth::user()->name}}</title>
@endsection



@section('content')


	<div class="row ">
		<div class="col-12 col-xl-10 offset-xl-1 ">
		{{-- <form action="" method="post" enctype="multipart/form-data"> --}}

		    <div class="card rounded-0 p-3">
		    	<nav>
		    	  <div class="nav nav-tabs" id="nav-tab" role="tablist">
		    	    <a class="nav-item nav-link font-pt font-17 active" id="nav-website-settings-tab" data-toggle="tab" href="#nav-website-settings" role="tab" aria-controls="nav-website-settings" aria-selected="true">Information</a>
		    	    <a class="nav-item nav-link font-pt font-17" id="nav-ecommerce-tab" data-toggle="tab" href="#nav-ecommerce" role="tab" aria-controls="nav-ecommerce" aria-selected="false">Password</a>
		    	    
		    	  </div>
		    	</nav>
		    	<div class="tab-content" id="nav-tabContent">
		    	  <div class="tab-pane fade show active" id="nav-website-settings" role="tabpanel" aria-labelledby="nav-home-tab">

		    	  	<h3 class="font-20 font-pt my-3 text-center font-weight-bold">Update Your Information</h3>
		    	  	<hr>
		    	  	<form action="{{route('customer.profile.update')}}" method="POST" enctype="multipart/form-data">
	  					@csrf
	  					<label for="name"><b>Name*</b></label>
	  					<input required class="form-control" name="name" type="text" value="{{Auth::user()->name}}">

	  					<label for="image" class="mt-2"><b>Profile Picture*</b></label>
	  					<input  class="form-control" name="image" type="file" value="">


	  					<label for="phone" class="mt-2"><b>Phone*</b></label>
	  					<input required class="form-control" name="phone" type="text" value="{{Auth::user()->phone}}">

	  					<label for="website" class="mt-2"><b>Website*</b></label>
	  					<input required class="form-control" name="website" type="text" value="{{Auth::user()->website}}">

	  					<label for="phone" class="mt-2"><b>Address*</b></label>
	  					<textarea required name="address" id="" class="form-control" cols="30" rows="4">{{Auth::user()->address}}</textarea>

	  					<label for="phone" class="mt-2"><b>About*</b></label>
	  					<textarea  required  name="about" id="" class="form-control mb-2" cols="30" rows="6">{{Auth::user()->about}}</textarea>
	  					
	  					<input type="hidden" name="id" value="{{Auth::user()->id}}">
	  					<input type="submit" name="submit" value="Update" class="form-control btn_1">
	  				</form>
		    	  </div> {{-- // end website settings --}}


		    	  <div class="tab-pane fade" id="nav-ecommerce" role="tabpanel" aria-labelledby="nav-ecommerce-tab">
		    	  	<h3 class="font-20 font-pt my-3 text-center font-weight-bold">Change Password</h3>
		    	  	<hr>
		    	  	<form action="{{route('customer.profile.password_change')}}" method="post">
		    	  		@csrf
						<input type="hidden" name="id" value="{{Auth::user()->id}}">
		    	  		<div class="row">
		    	  			<div class="col-12 col-lg-6 mb-2 offset-lg-3">
		    	  				<label for="old_password mt-2"><b>Old Password*</b></label>
		    	  				<input required  type="password" name="old_password" id="old_password" class="form-control " >
		    	  			</div>
		    	  			<div class="col-12 col-lg-6 mb-2 offset-lg-3">
		    	  				<label for="new_password mt-2"><b>New Password*</b></label>
		    	  				<input required  type="password" name="new_password" id="new_password" class="form-control " >
		    	  			</div>
		    	  			<div class="col-12 col-lg-6 mb-2 offset-lg-3">
		    	  				<label for="confirm_new_password mt-2"><b>Confirm Password*</b></label>
		    	  				<input required  type="password" name="confirm_new_password" id="confirm_new_password" class="form-control " >
		    	  			</div>
		    	  		</div>
						<input type="submit" class="btn_1 mt-2 form-control" value="Update">
		    	  	</form>
		    	  </div> {{-- // end ecommerce settings --}}

		    	</div> {{-- end tab pan --}}
		   		{{-- <label for="heading" class="mt-2"><b>About*</b></label>
		   		<textarea class="form-control rounded-0"  id="about_content" name="heading" rows="4">{{$settings->heading}}</textarea> --}}
				
		    </div>
	    {{-- </form> --}}
	  	</div>
	</div>

@endsection


















