@extends('admin.layouts.master')


@section('title')
<title>Website Settings</title>
@endsection





@section('content')


	<div class="row ">
		<div class="col-12 col-xl-6 offset-xl-3 ">
		{{-- <form action="" method="post" enctype="multipart/form-data"> --}}

		    <div class="card rounded-0 p-3">
		    	<nav>
		    	  <div class="nav nav-tabs" id="nav-tab" role="tablist">

		    	    <a class="nav-item nav-link font-pt font-17 active" id="nav-website-settings-tab" data-toggle="tab" href="#nav-website-settings" role="tab" aria-controls="nav-website-settings" aria-selected="true">Website Settings</a>

		    	    <a class="nav-item nav-link font-pt font-17" id="nav-seo-settings-tab" data-toggle="tab" href="#nav-seo-settings" role="tab" aria-controls="nav-seo-settings" aria-selected="true">SEO</a>

		    	    <a class="nav-item nav-link font-pt font-17" id="nav-social-tab" data-toggle="tab" href="#nav-social-settings" role="tab" aria-controls="nav-social-settings" aria-selected="true">Social Media</a>


		    	    <a class="nav-item nav-link font-pt font-17" id="nav-ecommerce-tab" data-toggle="tab" href="#nav-ecommerce" role="tab" aria-controls="nav-ecommerce" aria-selected="false">E-Commerce Settings</a>
		    	    
		    	  </div>
		    	</nav>
		    	<div class="tab-content" id="nav-tabContent">
		    	  <div class="tab-pane fade show active" id="nav-website-settings" role="tabpanel" aria-labelledby="nav-home-tab">

		    	  	<h3 class="font-20 font-pt my-3 text-center font-weight-bold">Update Webste Settings</h3>
		    	  	<hr>
		    	  	<form action="{{route('admin.settings.update')}}" method="post" enctype="multipart/form-data">
		    	  		@csrf
						<div class="row">
							<div class="col-12 col-lg-6">
								<label for="logo" class="mt-2"><b>Logo*</b></label>
								<input type="file" name="logo" id="logo" class="form-control rounded-0" style="height: 50px;">
							</div>
								
							<div class="col-12 col-lg-6">
								<label for="fev_icon" class="mt-2"><b>Fev-Icon*</b></label>
								<input type="file" name="fev_icon" id="fev_icon" class="form-control rounded-0" style="height: 50px;">
							</div>
						</div>


				      
						<div class="row">
							<div class="col-12 col-lg-6">
								<label for="email" class="mt-2"><b>Email*</b></label>
								<input type="email" name="email" id="email" class="form-control rounded-0" value="{{$settings->email}}">
							</div>
							<div class="col-12 col-lg-6">
								<label for="phone" class="mt-2"><b>Phone*</b></label>
								<input type="text" name="phone" id="phone" class="form-control rounded-0" value="{{$settings->phone}}">
							</div>
							<div class="col-12 col-lg-12">
								<label for="address" class="mt-2"><b>Address*</b></label>
								<input type="text" name="address" id="address" class="form-control rounded-0" value="{{$settings->address}}">
							</div>


							<div class="col-12 col-lg-12">
								<label for="location" class="mt-2"><b>Location*</b></label>
								
								<textarea name="location" id="location" cols="30" rows="3" class="form-control rounded-0">{{$settings->location}}</textarea>
							</div>


							<div class="col-12 col-lg-12">
								<label for="copyright" class="mt-2"><b>Copyright*</b></label>
								<input type="text" name="copyright" id="copyright" class="form-control rounded-0" value="{{$settings->copyright}}">
							</div>
						</div>


						<input type="submit" class="btn_1 mt-2 form-control" value="Update">

		    	  	</form>
		    	  </div> {{-- // end website settings --}}




    	      	  <div class="tab-pane fade" id="nav-seo-settings" role="tabpanel" aria-labelledby="nav-seo-settings">
    	      	  	<h3 class="font-20 font-pt my-3 text-center font-weight-bold">Website SEO || Home Page</h3>
    	      	  	<hr>
    	      	  	<form action="{{route('admin.settings.seo.update')}}" method="post">
    	      	  		@csrf
						
						<div class="row">

							<div class="col-12">
								<label for="title"><b>Title*</b></label>
								<input type="text" name="title" id="title" class="form-control rounded-0" value="{{$settings->title}}">
							</div>


							<div class="col-12 col-lg-12">
								<label for="tag" class="mt-2"><b>Tag*</b></label>
								<textarea class="form-control rounded-0"  id="tag" name="tag" rows="5">{{$settings->tag}}</textarea>
							</div>
							<div class="col-12 col-lg-12">
								<label for="description" class="mt-2"><b>Description*</b></label>
								<textarea class="form-control rounded-0"  id="description" name="description"  rows="5">{{$settings->description}}</textarea>
							</div>
						</div>
    	      	  		
    	  				<input type="submit" class="btn_1 mt-2 form-control" value="Update">
    	      	  	</form>
    	      	  </div> {{-- // end ecommerce settings --}}



      	      	  <div class="tab-pane fade" id="nav-social-settings" role="tabpanel" aria-labelledby="nav-social-settings">
      	      	  	<h3 class="font-20 font-pt my-3 text-center font-weight-bold">Social Media Integration</h3>
      	      	  	<hr>
      	      	  	<form action="{{route('admin.settings.social_media.update')}}" method="post">
      	      	  		@csrf
  						
  						<div class="row">
  							<div class="col-12 col-lg-6">
  								<label for="facebook" class="mt-2"><b>Facebook</b></label>
  								<input type="text" name="facebook" id="facebook" class="form-control rounded-0" value="{{$settings->facebook}}">
  							</div>
  							<div class="col-12 col-lg-6">
  								<label for="youtube" class="mt-2"><b>Youtube</b></label>
  								<input type="text" name="youtube" id="youtube" class="form-control rounded-0" value="{{$settings->youtube}}">
  							</div>

  							<div class="col-12 col-lg-6">
  								<label for="linkedin" class="mt-2"><b>Linkedin</b></label>
  								<input type="text" name="linkedin" id="linkedin" class="form-control rounded-0" value="{{$settings->linkedin}}">
  							</div>
  							<div class="col-12 col-lg-6">
  								<label for="instagram" class="mt-2"><b>Instagram</b></label>
  								<input type="text" name="instagram" id="instagram" class="form-control rounded-0" value="{{$settings->instagram}}">
  							</div>

  							<div class="col-12 col-lg-12">
  								<label for="facebook_messenger" class="mt-2"><b>Facebook Messenger</b></label>
  								
  								<textarea name="facebook_messenger" id="facebook_messenger" cols="30" rows="3" class="form-control rounded-0">{{$settings->facebook_messenger}}</textarea>
  							</div>


  						</div>
      	      	  		
      	  				<input type="submit" class="btn_1 mt-2 form-control" value="Update">
      	      	  	</form>
      	      	  </div> {{-- // end ecommerce settings --}}


		    	  <div class="tab-pane fade" id="nav-ecommerce" role="tabpanel" aria-labelledby="nav-ecommerce-tab">
		    	  	<h3 class="font-20 font-pt my-3 text-center font-weight-bold">Update E-Commerce Settings</h3>
		    	  	<hr>
		    	  	<form action="{{route('admin.ecommerce.update')}}" method="post">
		    	  		@csrf

		    	  		<div class="row">
		    	  			<div class="col-12 col-lg-6">
		    	  				<label for="shipping_cost_in_dhaka mt-2">Shipping Cost(Inside Dhaka)*</label>
		    	  				<input step="any" type="number" name="shipping_cost_in_dhaka" id="shipping_cost_in_dhaka" class="form-control rounded-0" value="{{$ecommerce->shipping_cost_in_dhaka}}">
		    	  			</div>
		    	  			<div class="col-12 col-lg-6">
		    	  				<label for="shipping_cost_out_dhaka mt-2">Shipping Cost(Outside Dhaka)*</label>
		    	  				<input step="any" type="number" name="shipping_cost_out_dhaka" id="shipping_cost_out_dhaka" class="form-control rounded-0" value="{{$ecommerce->shipping_cost_out_dhaka}}">
		    	  			</div>
		    	  		</div>
						<input type="submit" class="btn_1 mt-2 form-control" value="Update">
		    	  	</form>
		    	  </div> {{-- // end ecommerce settings --}}

		    	</div> {{-- end tab pan --}}
		   		
				
		    </div>
	    {{-- </form> --}}
	  	</div>
	</div>

@endsection
@section('footer-section')
<script>


  $(document).ready(function() {
  	$('.html-editor').summernote({

  	 
  	  tabsize: 4,
  	  height: 400,
  	  toolbar: [
  	    
  	    ['font', ['bold', 'underline', 'clear']],
  	   
  	    ['para', ['ul', 'ol', 'paragraph']],
  	    
  	    ['fontsize', ['fontsize']],
  	   
  	  ]
  	});
  });

</script>
@endsection
