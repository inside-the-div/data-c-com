@extends('public.layouts.master')

@section('seo')
@endsection

@section('title')
Contact Us | {{Session::get('title')}}
@endsection


@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="card mt-2 p-5 text-justify">
						<h1 class="text-center m-0">Contact Us</h1>
						<hr class="my-2 ">



						<div class="row my-4">
							<div class="col-12 col-lg-7">
								
								
								<div class="row">
									<div class="col-12">
										<label for="name"><b>Name:</b></label>
										<input maxlength="200" type="text" class="form-control mb-2" id="name" placeholder="Your Full Name">
									</div>
								</div>
								<div class="row mb-2">
									<div class="col-12 col-lg-8">
										<label for="email"><b>Email:</b></label>
										<input maxlength="100" type="text" class="form-control" id="email" placeholder="Your Full Name">
									</div>
									<div class="col-12 col-lg-4">
										<label for="phone"><b>Phone:</b></label>
										<input maxlength="15" type="text" class="form-control" id="phone" placeholder="Your Full Name">
									</div>
								</div>


								<div class="row mb-2">
									<div class="col-12">
										<label for="subject"><b>Subject*</b></label>
										<input maxlength="150" type="text" class="form-control" id="subject" placeholder="Subject">
									</div>
								</div>

								<div class="row mb-2">
									<div class="col-12">
										<label for="message"><b>Message*</b></label>
										<textarea maxlength="500" name="" id="message" cols="30" rows="3"class="form-control" placeholder="Your Message"></textarea>
									</div>
								</div>

								
								

								<button id="send_btn" class="btn_1 full-width mt-3">
									<span id="loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
									Send
							    </button>

								
							</div>

							<div class="col-12 col-lg-5">
								
									<h2 style="font-size: 20px;" class="text-center">DoDo Online Shop</h2>
									<hr class="my-2">

									<address>
										<p class="mb-2"><b>Address: </b> Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
										<p class="mb-2"><b>Phone: </b> {{Session::get('phone')}}</p>
										<p class="mb-2"><b>Email: </b> {{Session::get('email')}}</p>
										<p class="m-0"><b>Whats App: </b> {{Session::get('phone')}}</p>
									</address>

									
								
							</div>
						</div>



						<div>
							<iframe src="{{Session::get('location')}}" width="100%" height="550" frameborder="0" style="border:2px solid #004dda; border-radius: 20px;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
@endsection


@section('footer')

	
	<script>

	  $("#loader").hide();

	  $(document).ready(function() {
	  	$("#send_btn").click(function(){

	  		$("#loader").show();

	  		var name = $("#name").val();
	  		var email = $("#email").val();
	  		var phone = $("#phone").val();
	  		var subject = $("#subject").val();
	  		var message = $("#message").val();



	  		$.ajax({
	  		   type:'POST',
	  		   url:'/contact/email/send',
	  		   data:{
	  		   	name:name,
	  		   	email:email,
	  		   	phone:phone,
	  		   	subject:subject,
	  		   	message:message
	  		   },
	  		   success:function(data){
	  		   	console.log(data);
	  		   	$("#loader").hide();


	  		   	var name = $("#name").val("");
	  		   	var email = $("#email").val("");
	  		   	var phone = $("#phone").val("");
	  		   	var subject = $("#subject").val("");
	  		   	var message = $("#message").val("");


	  		  } // end success
	  		
	  		});



	  	})
	  });

	</script>


@endsection